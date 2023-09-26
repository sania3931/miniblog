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
        $tags = Tag::findOrFail($id);
        $name = Tag::where('post_id')->get();
        return view('pages.admin.tag.edit', compact('tags', 'name'));
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
        $data['slug'] = Str::slug($request->name);
        $tags = Tag::update($data);

        if ($tags) {
            return redirect('Admin/categories')->with('success', __("alert.yourAddCategoryIsSuccessfully"));
        } else {
            return redirect('Admin/categories')->with('error', __("alert.yourAddCategoryIsFailed"));
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
