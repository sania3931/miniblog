<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::select('id', 'content', 'facebook', 'twitter', 'instagram')->first();
        return view('pages.admin.about.index', compact('abouts'));
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
            'content' => ['required'],
            'facebook' => ['required'],
            'twitter' => ['required'],
            'instagram' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $abouts = About::create([
            'content' => $request->content,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
        ]);
        if ($abouts) {
            return redirect('Admin/about')->with('success', __("alert.yourAddDataIsSuccessfully"));
        } else {
            return redirect('Admin/about')->with('error', __("alert.yourAddDataIsFailed"));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function about($id)
    {
        $abouts = About::where('content', $id)->first();
        return view('pages.admin.about.show', compact('abouts'));
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
        $data = $request->all();
        $validator = Validator::make($data, [
            'content' => ['required'],
            'facebook' => ['required'],
            'twitter' => ['required'],
            'instagram' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // $abouts = About::find($id);
        // $data['slug'] = Str::slug($request->contet);
        // $abouts->update($data);
        // $data['slug'] = Str::slug($request->name);
        // $category = Category::create($data);
        // $request->validate([
        //     'content' => 'required',
        //     'facebook' => 'required',
        //     'twitter' => 'required',
        //     'instagram' => 'required',
        // ]);

        // $about->update([
        //     'content' => $request->content,
        //     'facebook' => $request->facebook,
        //     'instagram' => $request->instagram,
        //     'twitter' => $request->twitter,
        // ]);}
        $abouts = About::whereId($id)->update([
            'content' => $request->content,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
        ]);

        if ($abouts) {
            return redirect('Admin/about')->with('success', __("alert.yourAddCategoryIsSuccessfully"));
        } else {
            return redirect('Admin/about')->with('error', __("alert.yourAddCategoryIsFailed"));
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
        //
    }
}
