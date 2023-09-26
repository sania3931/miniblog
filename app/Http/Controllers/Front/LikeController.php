<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function saveLike( Request $request)
    {
        if (Auth::check()) {
            $like = Like::where('post_id', $request->id)->where('user_id', Auth::user()->id)->first();
            if ($like) {
                $like->delete();
            }else {
                $like = new Like();
                $like->post_id = $request->id;
                $like->user_id = Auth::user()->id;
                $like->save();
            }
            $post_like = Like::where('post_id', $request->id)->get()->count();
            return response()->json($post_like);
        } else {
            return redirect('login');
        }
    }
}
