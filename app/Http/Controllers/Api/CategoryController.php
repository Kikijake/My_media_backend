<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //GET ALL CATEGORY
    public function getAllCategory(){
        $category = Category::all();
        return response()->json([
            'category' => $category
        ], 200,);
    }

    // SEARCH
    public function categorySearch(Request $request){
        $post = Category::select('posts.*')
                        ->join('posts','categories.id','posts.category_id')
                        ->where('categories.title','like','%'.$request->key.'%')
                        ->get();
        return response()->json([
                    'searchData' => $post
                ], 200,);
    }
}
