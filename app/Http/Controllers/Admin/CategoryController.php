<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::with('parent')->orderBy('is_parent', 'DESC')->get();
        return view('pages.admin.categories.index', compact('category'));

    }
    public function getDataCategory()
    {
        // $artikel = Artikel::with('user')->get();
        // $total = Artikel::with('user')->get()->count();
        // $length = intval($_REQUEST['length']);
        $total                          = Category::get()->count();

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
                $query                         = Category::where(function($filter) use ($search) {
                                                $filter->orWhere('name', 'like', '%' . $search . '%');
                                                })
                                                ->take($length)
                                                ->skip($start)
                                                ->get();
            $no = $start + 1;
            foreach ($query as $cate) {
                $name = $cate->name ;
                $parent = $cate->parent->name ?? 'parent' ;
                $actions = "
                            <div class='col-12 row center'>
                                <button type='button' class='btn btn-success btn-sm btn-edit m-1' data-id=`$cate->id` onclick='btnEdit($cate->id)'><i class='fas fa-edit m-1'></i>".__('button.edit')."</button>
                                <a href='javascript:destroyCategories(`$cate->id`)' class='btn btn-danger btn-delete btn-sm m-1'><i class='fas fa-trash m-1'></i>".__('button.delete')."</a>
                            </div>
                ";

                $output['data'][] =
                    array(
                        $no,
                        $name,
                        $parent ,
                        $actions,
                    );
                $no++;
            }

                $rows                         = Category::
                                                where(function($filter) use ($search) {
                                                    $filter->orWhere('name', 'like', '%' . $search . '%');
                                                        })
                                                        ->get();
            $output['draw']                 = $draw;
            $output['recordsTotal']         = $output['recordsFiltered']      = $rows->count();
        }
        else{
                $query                         = Category::
                                                    take($length)
                                                    ->skip($start)
                                                    ->get();

            $no = $start + 1;
            foreach ($query as $cate) {
                $name = $cate->name ;
                $parent = $cate->parent->name ?? 'parent' ;
                $actions = "
                            <div class='col-12 row center'>
                            <button type='button' class='btn btn-success btn-sm btn-edit m-1' data-id=`$cate->id` onclick='btnEdit($cate->id)'><i class='fas fa-edit m-1'></i>".__('button.edit')."</button>
                            <a href='javascript:destroyCategories(`$cate->id`)' class='btn btn-danger btn-delete btn-sm m-1'><i class='fas fa-trash m-1'></i>".__('button.delete')."</a>
                            </div>
                ";

                $output['data'][] =
                    array(
                        $no,
                        $name,
                        $parent,
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
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['slug'] = Str::slug($request->name);
        $category = Category::create($data);

        if ($category) {
            return redirect('Admin/categories')->with('success', __("alert.yourAddCategoryIsSuccessfully"));
        } else {
            return redirect('Admin/categories')->with('error', __("alert.yourAddCategoryIsFailed"));
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
        $category = Category::findOrFail($id);
        $parent = Category::where('is_parent', '1')->get();
        return view('pages.admin.categories.update', compact('category', 'parent'));
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
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category = Category::find($id);
        $data['slug'] = Str::slug($request->name);
        $category->update($data);

        if ($category) {
            return redirect('Admin/categories')->with('success', __("alert.yourUpdateCategoryIsSuccessfully"));
        } else {
            return redirect('Admin/categories')->with('error', __("alert.yourUpdateCategoryIsFailed"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id     = $request->id;
        $category = Category::find($id);
        $post = Artikel::where('category_id', $id)->get()->count();
        if ($post>0) {
            return response()->json([
                'success'=> false,
                'data'=> $category,
            ]);
            // return redirect()->back()->with('error',__("alert.yourDeleteCategoryIsFailed" ));
        } else {
            $category->delete();
            return response()->json([
                'success'=> true,
                'data'=> $category,
            ]);
            // return redirect()->back()->with('Succes', __("alert.yourDeleteCategoryrIsSuccessfully"));
        }
    }
}
