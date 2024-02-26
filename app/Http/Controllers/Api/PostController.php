<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // GET ALL POSTS
    public function getAllPost(){
        $post = Post::all();
        return response()->json([
            'post' => $post
        ], 200);
    }

    // SEARCH
    public function postSearch(Request $request){
        $post = Post::where('title','like','%'.$request->key.'%')->get();
        return response()->json([
                    'searchData' => $post
                ], 200,);
    }

    // POST DETAILS
    public function postDetails(Request $request){
        $post = Post::where('id',$request->postId)->first();
        return response()->json([
            'post' => $post
        ], 200,);
    }
}
