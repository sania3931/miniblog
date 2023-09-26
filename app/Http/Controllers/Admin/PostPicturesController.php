<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post_picture;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PostPicturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->role == 'Admin') {
                $post_picture = Post_picture::orderBy('id', 'DESC')->paginate(6);
            }else{
                $post_picture = Post_picture::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(6);
            }
            return view('pages.admin.post_pictures.image-list', compact('post_picture'));
        }
        return view('pages.admin.post_pictures.index');
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
        $validator = Validator::make($data,[
            'detail' => ['required', 'string', 'min:3', 'max:255'],
            'image.*' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    if($request->hasfile('image')) {
        $file= $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $newName = Str::slug($request->detail).md5(uniqid(rand(), true)).'.'.$ext;
        $file->move(public_path('images/'), $newName);
        $data['image'] = $newName;
    }
    $data['user_id'] = Auth::user()->id;
    $file = Post_picture::create($data);

    if ($file) {
        return redirect()->back()->with('success', __("alert.yourAddImageIsSuccessfully"));
    } else {
        return redirect()->back()->with('error', __("alert.yourAddImageIsFailed"));
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
    public function destroy($id)
    {
        $post_picture = Post_picture::find($id);
        $path = 'images/'.$post_picture->image;
        if (is_file($path)){
            unlink($path);
        }
        $post_picture->delete();
        // if ($post_picture) {
        //     return redirect()->back()->with('success', __("alert.yourDeleteImageIsSuccessfully"));
        // } else {
        //     return redirect()->back()->with('error', __("alert.yourDeleteUserIsFailed"));
        // }
    }
}
