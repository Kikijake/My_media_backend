<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    public function index(){
        $posts = ActionLog::select('action_logs.*','posts.*',DB::raw('COUNT(action_logs.post_id) as viewCount'))
            ->leftJoin('posts','posts.id','action_logs.post_id')
            ->groupBy('action_logs.post_id')
            ->orderBy('viewCount','desc')
            ->get();
        return view('admin.trendPost.index',compact('posts'));
    }

    // DIRECT TREND POST DETAILS
    public function details($id){
        $post = Post::where('id',$id)->first();
        return view('admin.trendPost.details',compact('post'));
    }
}
