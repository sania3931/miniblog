<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Artikel;
use App\Models\Category;
use App\Models\Like;
use App\Models\Post_picture;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $artikel = Artikel::with('user')->get();
        if (app()->getlocale() == 'id') {
            $artikel = Artikel::where('title', '!=', null)->with('user')->get();
        }elseif (app()->getlocale()== 'en') {
            $artikel = Artikel::where('title_en', '!=', null)->with('user')->get();
        };
        return view('pages.admin.artikels.index', compact('artikel'));
    }
    public function indexGambar(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->role == 'Admin') {
                $post_picture = Post_picture::orderBy('id', 'DESC')->paginate(6);
            }else{
                $post_picture = Post_picture::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(6);
            }
            return view('pages.admin.artikels.image-list', compact('post_picture'));
        }
    }
    public function getDataArtikel()
    {
        // $artikel = Artikel::with('user')->get();
        // $total = Artikel::with('user')->get()->count();
        // $length = intval($_REQUEST['length']);
        if (Auth::user()->role == 'Admin') {
            $total                          = Artikel::with('user')->get()->count();
        } else {
            $total                          = Artikel::with('user')->where('user_id', Auth::user()->id)->get()->count();
        }

        $length                         = intval($_REQUEST['length']);
        $length                         = $length < 0 ? $total : $length;
        $start                          = intval($_REQUEST['start']);
        $draw                           = intval($_REQUEST['draw']);

        $search                         = $_REQUEST['search']["value"];

        $output                         = array();
        $output['data']                 = array();

        $end                            = $start + $length;
        $end                            = $end > $total ? $total : $end;

        if($search != ''){
            if (Auth::user()->role == 'Admin') {
                $query                         = Artikel::where(function($filter) use ($search) {
                                                $filter->orWhere('title', 'like', '%' . $search . '%');
                                                $filter->orWhere('content', 'like', '%' . $search . '%');
                                                $filter->orWhere('title_en', 'like', '%' . $search . '%');
                                                $filter->orWhere('content_en', 'like', '%' . $search . '%');
                                                })
                                                ->take($length)
                                                ->skip($start)
                                                ->with('user')
                                                ->get();
            } else {
                $query                         = Artikel::where('user_id', Auth::user()->id)->where(function($filter) use ($search) {
                    $filter->orWhere('title', 'like', '%' . $search . '%');
                    $filter->orWhere('content', 'like', '%' . $search . '%');
                    $filter->orWhere('title_en', 'like', '%' . $search . '%');
                    $filter->orWhere('content_en', 'like', '%' . $search . '%');
                    })
                    ->take($length)
                    ->skip($start)
                    ->with('user')
                    ->get();
            }

            $no = $start + 1;
            foreach ($query as $row) {
                if (app()->getlocale() == 'id') {
                    $slug = $row->slug ? $row->slug : $row->slug_en;
                }else {
                    $slug = $row->slug_en ? $row->slug_en : $row->slug;
                }

                if (app()->getLocale() == 'id'){
                    $judul = $row->title ?? $row->title_en;
                    $desc  = substr($row->content ?? $row->content_en , 0 , 100);
                }else{
                    $judul = $row->title_en ?? $row->title;
                    $desc  = substr($row->content_en ?? $row->content , 0 , 100);
                }
                if($row->status == 1){
                    $status = "<span class='badge badge-success'>".__('table.publish')."</span>";

                }else{
                    $status = "<span class='badge badge-info'>".__('table.draft')."</span>";
                }

                $actions = "
                            <div class='col-12 row center'>
                                <a href=".url(Auth::user()->role.'/artikels/'.$slug. '/edit')." class='btn btn-success m-1 btn-sm'><i class='fas fa-edit m-1'></i>".__('button.edit')."</a>
                                <a href='javascript:destroyArticle(`$row->id`)' class='btn btn-danger btn-delete btn-sm m-1'><i class='fas fa-trash m-1'></i>".__('button.delete')."</a>
                                <a href=".url(Auth::user()->role.'/artikels/'.$slug)." class='btn btn-info btn-sm m-1'><i class='fas fa-eye m-1'></i>".__('button.show')."</a>
                            </div>
                ";

                $output['data'][] =
                    array(
                        $no,
                        $judul,
                        $desc ,
                        $row->date,
                        $row->user->name,
                        $status,
                        $actions,
                    );
                $no++;
            }
            if (Auth::user()->role == 'Admin') {
                $rows                         = Artikel::
                                                where(function($filter) use ($search) {
                                                    $filter->where('title', 'like', '%' . $search . '%');
                                                    $filter->orWhere('content', 'like', '%' . $search . '%');
                                                    $filter->orWhere('title_en', 'like', '%' . $search . '%');
                                                    $filter->orWhere('content_en', 'like', '%' . $search . '%');
                                                        })
                                                        ->with('user')
                                                        ->get();
            } else {
                $rows                         = Artikel::
                                                where(function($filter) use ($search) {
                                                    $filter->where('title', 'like', '%' . $search . '%');
                                                    $filter->orWhere('content', 'like', '%' . $search . '%');
                                                    $filter->orWhere('title_en', 'like', '%' . $search . '%');
                                                    $filter->orWhere('content_en', 'like', '%' . $search . '%');
                                                        })
                                                        ->with('user')
                                                        ->get();
            }
            $output['draw']                 = $draw;
            $output['recordsTotal']         = $output['recordsFiltered']      = $rows->count();
        }
        else{
            if (Auth::user()->role == 'Admin') {
                $query                         = Artikel::
                                                    take($length)
                                                    ->skip($start)
                                                    ->with('user')
                                                    ->get();
            } else {
                $query                         = Artikel::where('user_id', Auth::user()->id)->
                take($length)
                ->skip($start)
                ->with('user')
                ->get();
            }
            $no = $start + 1;
            foreach ($query as $row) {
                if (app()->getlocale() == 'id') {
                    $slug = $row->slug ? $row->slug : $row->slug_en;
                }else {
                    $slug = $row->slug_en ? $row->slug_en : $row->slug;
                }

                if (app()->getLocale() == 'id'){
                    $judul = $row->title ?? $row->title_en;
                    $desc  = substr($row->content ?? $row->content_en , 0 , 100);
                }else{
                    $judul = $row->title_en ?? $row->title;
                    $desc  = substr($row->content_en ?? $row->content , 0 , 100);
                }
                if($row->status == 1){
                    $status = "<span class='badge badge-success'>".__('table.publish')."</span>";

                }else{
                    $status = "<span class='badge badge-info'>".__('table.draft')."</span>";
                }

                $actions = "
                            <div class='col-12 row center'>
                                <a href=".url(Auth::user()->role.'/artikels/'.$slug. '/edit')." class='btn btn-success m-1 btn-sm'><i class='fas fa-edit m-1'></i>".__('button.edit')."</a>
                                <a href='javascript:destroyArticle(`$row->id`)' class='btn btn-danger btn-delete btn-sm m-1'><i class='fas fa-trash m-1'></i>".__('button.delete')."</a>
                                <a href=".url(Auth::user()->role.'/artikels/'.$slug)." class='btn btn-info btn-sm m-1'><i class='fas fa-eye m-1'></i>".__('button.show')."</a>
                            </div>
                ";

                $output['data'][] =
                    array(
                        $no,
                        $judul,
                        $desc ,
                        $row->date,
                        $row->user->name,
                        $status,
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
        $category = Category::all();
        $post_picture = Post_picture::orderBy('id', 'DESC')->paginate(6);
        return view('pages.admin.artikels.create', compact('category', 'post_picture'));
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
            'category_id'   =>['required'],
            'featured_image'=>['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->hasfile('featured_image')) {
            $artikels= $request->file('featured_image');
            $ext = $artikels->getClientOriginalExtension();
            $newName = Str::slug($request->title).md5(uniqid(rand(), true)).'.'.$ext;
            $artikels->move(public_path('images/'), $newName);
        }
        $artikel = Artikel::create([
            'user_id'           => Auth::user()->id,
            'category_id'       => $request->category_id,
            'date'              => Carbon::now(),
            'title'             => $request->title,
            'title_en'             => $request->title_en,
            'slug'              => Str::slug($request->title),
            'slug_en'              => Str::slug($request->title_en),
            'featured_image'    => $newName,
            'content'           => $request->content,
            'content_en'           => $request->content_en,
            'status'            => $request->status,
        ]);
        if (isset($request->tags)) {
            $count = count($request->tags);
            for($i=0; $i < $count; $i++) {
                Tag::create([
                    'post_id' => $artikel->id,
                    'name' => $request->tags[$i],
                    'slug' => Str::slug($request->tags[$i]),
                ]);


            }
        }

        if ($artikel) {
            return redirect(Auth::user()->role.'/artikels')->with('success', __("alert.yourPostIsSuccessfully"));
        } else {
            return redirect(Auth::user()->role.'/artikels')->with('error', __("alert.yourPostIsFailed"));
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
        $artikel = Artikel::where('slug', $id)->orWhere('slug_en' , $id)->first();
        if (Auth::user()->role == 'Admin') {
            $related_post = Artikel::whereHas('category', function($q) use($artikel){
                $q->where('id', $artikel->category_id);
            })
            ->inRandomOrder()
            ->take(3)
            ->get();
        } else {
            $related_post = Artikel::whereHas('user', function($q) use($artikel){
                $q->where('id', Auth::user()->id);
            })
            ->inRandomOrder()
            ->take(3)
            ->get();
        }
        return view('pages.admin.artikels.show', compact('artikel', 'related_post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artikel = Artikel::where('slug', $id)->orWhere('slug_en', $id)->first();
        $category = Category::all();
        $post_picture = Post_picture::orderBy('id', 'DESC')->paginate(6);
        $tags = Tag::where('post_id', $artikel->id)->get();
        return view('pages.admin.artikels.edit', compact('artikel', 'category', 'post_picture', 'tags'));
    }
    public function RecantTags(Request $request)
    {
        $tags = Tag::where('post_id', $request->post_id)->get();
        return view('pages.admin.artikels.recant-tags', compact('tags'));

    }
    public function about(Request $request)
    {
        $abouts = About::where('id',$request->id)->get();
        return view('pages/admin/about/show', compact('abouts'));
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
            'category_id'   =>['required'],
            'featured_image'=>['image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $artikel = Artikel::find($id);
        if($request->hasfile('featured_image')) {
            $path = 'images/'.$artikel->featured_image;
            if (is_file($path)){
                unlink($path);
            }
            $artikels= $request->file('featured_image');

            $ext = $artikels->getClientOriginalExtension();
            $newName = Str::slug($request->title).md5(uniqid(rand(), true)).'.'.$ext;
            $artikels->move(public_path('images/'), $newName);
            $artikel->featured_image= $newName;
            $artikel->save();
        }
        $artikel->update([
            'category_id'       => $request->category_id,
            'title'             => $request->title,
            'title_en'          => $request->title_en,
            'slug'              => Str::slug($request->title),
            'slug_en'           => Str::slug($request->title_en),
            'content'           => $request->content,
            'content_en'        => $request->content_en,
            'status'            => $request->status,
        ]);
        if (isset($request->tags)) {
            $count = count($request->tags);
            for($i=0; $i < $count; $i++) {
                Tag::create([
                    'post_id' => $artikel->id,
                    'name' => $request->tags[$i],
                    'slug' => Str::slug($request->tags[$i]),
                ]);


            }
        }
        if ($artikel) {
            return redirect(Auth::user()->role.'/artikels')->with('success', __("alert.yourEditIsSuccessfully"));
        } else {
            return redirect(Auth::user()->role.'/artikels')->with('error', __("alert.yourEditIsFailed"));
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
        $artikel = Artikel::find($id);
        $path = 'images/'.$artikel->featured_image;
        if (is_file($path)){
            unlink($path);
        }
        $artikel->delete();
        return response()->json($artikel);
        // if ($artikel) {
        //     return redirect(Auth::user()->role.'/artikels')->with('success', __("alert.yourDeleteArticleIsSuccessfully"));
        // } else {
        //     return redirect(Auth::user()->role.'/artikels')->with('error', __("alert.yourDeleteArticleIsFailed"));
        // }
    }
    // public function destroy(Request $request){
    //     $id     = $request->id;
    //     $artikel = Artikel::find($id);
    //     $path = 'images/'.$artikel->featured_image;
    //     if (is_file($path)) {
    //         unlink($path);
    //     }
    //     $artikel->delete();
    //     if ($artikel) {
    //         return redirect()->back()->with('success',  __("alert.yourDeleteArticleIsSuccessfully"));
    //     } else {
    //         return redirect()->back()->with('error',  __("alert.yourDeleteArticleIsFailed"));
    //     }
    // }
}
