<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // POST PAGE
    public function index(){
        $category=Category::all();
        $post = Post::all();
        return view('admin.post.index',compact(['category','post']));
    }

    // CREATE
    public function create(Request $request){
        $this->postValidation($request);
        $data = $this->getPostData($request);

        if($request->hasFile('postImage')){

            $filename = uniqid().$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->move(public_path().'/postImage',$filename);
            $data['image'] = $filename;
        }

        Post::create($data);
        return redirect()->route('admin#post');
    }

    // GET DATA
    private function getPostData($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
        ];
    }

    // VALIDATION
    private function postValidation($request){
        Validator::make($request->all(),[
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postImage' => 'mimes:png,jpg',
            'postCategory' => 'required',
        ])->validate();
    }

    // DELETE
    public function delete($id){
        $postData = Post::where('id',$id)->first();
        $dbImgName = $postData->image;

        Post::where('id',$id)->delete();
        if($dbImgName != null){
            File::delete(public_path().'/postImage/'.$dbImgName);
        }
        return redirect()->route('admin#post');
    }

    // EDIT PAGE
    public function editPage(Request $request){
        $category=Category::all();
        $post = Post::all();
        $editData = Post::where('id',$request->id)->first();
        return view('admin.post.edit',compact(['category','post','editData']));
    }

    // UPDATE POST
    public function update(Request $request){
        $this->postValidation($request);
        $data = $this->getPostData($request);

        if($request->hasFile('postImage')){
            // DELETE IMAGE
            $postData = Post::where('id',$request->id)->first();
            $dbImgName = $postData->image;
            if($dbImgName != null){
                if(File::exists(public_path().'/postImage/'.$dbImgName)){
                    File::delete(public_path().'/postImage/'.$dbImgName);
                }
            }
            //STORE IMAGE
            $filename = uniqid().$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->move(public_path().'/postImage',$filename);
            $data['image'] = $filename;
        }

        Post::where('id',$request->id)->update($data);
        return redirect()->route('admin#post');

    }
}
