<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Comment::orderBy('id','desc')->get();
        return view('pages/admin/comment/index',['data'=>$data]);
    }
    public function getDataComment()
    {
        $total                          = Comment::get()->count();

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
                $query                         = Comment::where(function($filter) use ($search) {
                                                $filter->orWhere('comment', 'like', '%' . $search . '%');
                                                })
                                                ->take($length)
                                                ->skip($start)
                                                ->get();
            $no = $start + 1;
            foreach ($query as $row) {
                $name = $row->name ;
                $email = $row->email;
                $comment = $row->comment ;
                $actions = "
                            <div class='col-12 row text-center'>
                                <a href='javascript:destroyComment(`$row->id`)' class='btn btn-danger btn-delete btn-sm m-1'><i class='fas fa-trash m-1'></i>".__('button.delete')."</a>
                            </div>
                ";

                $output['data'][] =
                    array(
                        $no,
                        $name,
                        $email,
                        $comment,
                        $actions,
                    );
                $no++;
            }

                $rows                         = Comment::
                                                where(function($filter) use ($search) {
                                                    $filter->orWhere('comment', 'like', '%' . $search . '%');
                                                        })
                                                        ->get();
            $output['draw']                 = $draw;
            $output['recordsTotal']         = $output['recordsFiltered']      = $rows->count();
        }
        else{
                $query                         = Comment::
                                                    take($length)
                                                    ->skip($start)
                                                    ->get();

            $no = $start + 1;
            foreach ($query as $row) {
                $name = $row->name ;
                $email = $row->email;
                $comment = $row->comment ;
                $actions = "
                            <div class='col-12 row text-center'>
                            <a href='javascript:destroyComment(`$row->id`)' class='btn btn-danger btn-delete btn-sm m-1'><i class='fas fa-trash m-1'></i>".__('button.delete')."</a>
                            </div>
                ";

                $output['data'][] =
                    array(
                        $no,
                        $name,
                        $email,
                        $comment,
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
            'name' => ['required'],
            'email' => ['required'],
            'comment' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $comment = Comment::create($data);
        return response()->json($comment);
        // $data['slug'] = Str::slug($request->comment);
        // $comment = Comment::create($data);

        // if ($comment) {
        //     return redirect('pages/public/show')->with('success', __("alert.yourAddCategoryIsSuccessfully"));
        // } else {
        //     return redirect('pages/public/show')->with('error', __("alert.yourAddCategoryIsFailed"));
        // }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Comment::where('id',$id)->delete();
        // return redirect('admin/comment', compact('comment'));
        $id     = $request->id;
        $comment = Comment::find($id);
        $comment->delete();
        if ($comment) {
            return redirect('Admin/comment')->with('success', __("alert.yourDeleteCommentIsSuccessfully"));
        } else {
            return redirect('Admin/comment')->with('error', __("alert.yourDeleteCommentIsFailed"));
        }
    }
}
