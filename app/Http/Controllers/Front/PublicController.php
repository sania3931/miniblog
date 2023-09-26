<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Artikel;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PublicController extends Controller
{
    public function index()
    {
        if (app()->getlocale() == 'id') {
            $artikel = Artikel::where('title', '!=', null)->where('status', '1')->orderBy('id', 'DESC');
        }elseif (app()->getlocale()== 'en') {
            $artikel = Artikel::where('title_en', '!=', null)->where('status', '1')->orderBy('id', 'DESC');
        };
        // $artikel = Artikel::where('status', '1')->orderBy('id', 'DESC');
        return view('pages.public.index', compact('artikel'));
    }

    public function show($id)
    {
        $artikel = Artikel::where('slug', $id)->orWhere('slug_en' , $id)->first();
        $related_post = Artikel::whereHas('category', function($q) use($artikel){
            $q->where('id', $artikel->category_id);
        })
        ->inRandomOrder()
        ->take(3)
        ->get();
        return view('pages/public/show', compact('artikel', 'related_post'));
    }

    public function artikelLoad (Request $request) {
        $skip = $request->skip;
        $take = $request->take;
        if (app()->getlocale() == 'id') {
            $artikel = Artikel::where('title', '!=', null)->where('status', '1')->skip($skip)->take($take)->orderBy('created_at', 'DESC')->get();
        }elseif (app()->getlocale()== 'en') {
            $artikel = Artikel::where('title_en', '!=', null)->where('status', '1')->skip($skip)->take($take)->orderBy('created_at', 'DESC')->get();
        };
        // $artikel = Artikel::skip($skip)->take($take)->orderBy('created_at', 'DESC')->get();
        return view('pages/public/artikel-load', compact('skip', 'artikel', 'take'));
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('flat')]);
    }

    public function storeComment(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => ['required'],
            'email' => ['required'],
            'captcha' => ['required','captcha'],
            'comment' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $comment = Comment::create($request->except(['captcha']));
        return response()->json($comment);
    }
    public function storeReplay(Request $request)
    {
        // dd($request->all());
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
    }
    public function getComment(Request $request, $id)
    {
        $comment = Comment::where('post_id', $id)->paginate(4);
        $replay = Comment::where('post_id', $id)->get();
        return view('pages/public/list-comment', compact('comment', 'replay'));
    }
    public function tentang()
    {
        $abouts = About::select('content', 'facebook', 'twitter', 'instagram')->first();
        return view('pages/public/about-blog', compact('abouts'));
    }
    public function privacyPolicy()
    {
        return view('pages/public/privacy-policy');
    }
    public function faqArticle()
    {
        return view('pages/public/faq-blog');
    }
    public function contact()
    {
        return view('pages/public/contac-us');
    }
}
