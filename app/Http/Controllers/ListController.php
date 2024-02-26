<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index(Request $request){
        $adminSearchKey = $request->adminSearchKey;
        if($request->toArray() != []){
            $users = User::orWhere('name','like','%'.$adminSearchKey.'%')
                        ->orWhere('email','like','%'.$adminSearchKey.'%')
                        ->orWhere('phone','like','%'.$adminSearchKey.'%')
                        ->orWhere('address','like','%'.$adminSearchKey.'%')
                        ->orWhere('gender','like','%'.$adminSearchKey.'%')
                        ->get();
        }else{
            $users = User::all();
        }
        return view('admin.list.index',compact(['users','adminSearchKey']));
    }

    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User Account Deleted!']);
    }
}
