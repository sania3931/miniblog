<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Cache\TagSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Count;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('pages.admin.tag.index', compact('tags'));
    }

    public function getDataTag()
    {
        // $artikel = Artikel::with('user')->get();
        // $total = Artikel::with('user')->get()->count();
        // $length = intval($_REQUEST['length']);
        $total                          = Tag::get()->count();

        $length                         = intval($_REQUEST['length']);
        $length                         = $length < 0 ? $total : $length;
        $start                          = intval($_REQUEST['start']);
        $draw                           = intval($_REQUEST['draw']);

        $search                         = $_REQUEST['search']['value'];

        $output                         = array();
        $output['data']                 = array();

        $end                            = $start + $length;
        $end                            = $end > $total ? $total : $end;


        if($search != ''){
                $query                         = Tag::where(function($filter) use ($search) {
                                                $filter->orWhere('name', 'like', '%' . $search . '%');
                                                })
                                                ->take($length)
                                                ->skip($start)
                                                ->get();
            $no = $start + 1;
            foreach ($query as $row) {
                $name = $row->name ;
                $slug = $row->slug ;
                $actions = "
                            <div class='col-12 row center'>
                                <button type='button' class='btn btn-success btn-sm btn-edit' data-id=`$row->id` onclick='btnEdit($row->id)'><i class='fas fa-edit m-1'></i>".__('button.edit')."</button>
                            </div>
                ";

                $output['data'][] =
                    array(
                        $no,
                        $name,
                        $slug,
                        $actions,
                    );
                $no++;
            }

                $rows                         = Tag::
                                                where(function($filter) use ($search) {
                                                    $filter->orWhere('name', 'like', '%' . $search . '%');
                                                        })
                                                        ->get();
            $output['draw']                 = $draw;
            $output['recordsTotal']         = $output['recordsFiltered']      = $rows->count();
        }
        else{
                $query                         = Tag::
                                                    take($length)
                                                    ->skip($start)
                                                    ->get();

            $no = $start + 1;
            foreach ($query as $row) {
                $name = $row->name ;
                $slug = $row->slug ;
                $actions = "
                            <div class='col-12 row center'>
                            <button type='button' class='btn btn-success btn-sm btn-edit' data-id=`$row->id` onclick='btnEditTag($row->id)'><i class='fas fa-edit m-1'></i>".__('button.edit')."</button>
                            </div>
                ";

                $output['data'][] =
                    array(
                        $no,
                        $name,
                        $slug,
                        $actions,
                    );
                $no++;
            }
            $output['draw']             = $draw;
            $output['recordsTotal']     = $total;
            $output['recordsFiltered']  = $total;
        }

        return response()->json($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $tags = Tag::create($data);

        if ($tags) {
            return redirect('Admin/tag')->with('success', __("alert.yourAddCategoryIsSuccessfully"));
        } else {
            return redirect('Admin/tag')->with('error', __("alert.yourAddCategoryIsFailed"));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::findOrFail($id);
        $name = Tag::where('post_id', $id)->first();
        // $name = Tag::where('post_id')->get();
        return view('pages.admin.tag.update', compact('tags', 'name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tags = Tag::findOrFail($id);
        $tags->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name)
        ]);

        if ($tags) {
            return redirect('Admin/tag')->with('success', __("alert.yourUpdateTagIsSuccessfully"));
        } else {
            return redirect('Admin/tag')->with('error', __("alert.yourUpdateCategoryIsFailed"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tags = Tag::find($id);
        $tags->delete();
        return response()->json($tags);

        // if ($tags) {
        //     return redirect()->back()->with('success',  __("alert.yourDeleteTagIsSuccessfully"));
        // } else {
        //     return redirect()->back()->with('error',  __("alert.yourDeleteTagIsFailed"));
        // }
    }
}
