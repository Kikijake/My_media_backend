<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // CATEGORY PAGE
    public function index(Request $request){
        $categorySearch = $request->categorySearch;
        if($request->toArray() != []){
            $category = Category::orWhere('title','like','%'.$categorySearch.'%')
                        ->orWhere('description','like','%'.$categorySearch.'%')
                        ->get();
        }else{
            $category = Category::all();
        }
        return view('admin.category.index',compact(['category','categorySearch']));
    }


    // CATEGORY CREATE
    public function create(Request $request){
        $this->categoryValidation($request);
        $data = $this->categoryGetData($request);
        Category::create($data);
        return redirect()->route('admin#category');
    }

    // CATEGORY GET DATA
    private function categoryGetData($request){
        return [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription
        ];
    }

    // CATEGORY CREATE VALIDATION
    private function categoryValidation($request){
        Validator::make($request->all(),[
            'categoryName' => 'required',
            'categoryDescription' => 'required'
        ])->validate();
    }

    // DELETE
    public function delete($id){
        Category::where('id',$id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess' => 'Category Deleted']);
    }

    // EDIT PAGE
    public function editPage(Request $request){
        $category = Category::all();
        $updateData = Category::where('id',$request->id)->first();
        return view('admin.category.edit',compact(['updateData','category',]));
    }

    // UPDATE CATEGORY
    public function update(Request $request){
        $this->categoryValidation($request);
        $updateData = $this->categoryGetData($request);
        Category::where('id',$request->id)->update($updateData);
        return redirect()->route('admin#category');
    }
}
