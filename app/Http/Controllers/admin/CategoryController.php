<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $title='Category List';
        $categoryList=Category::paginate(2);
        return view('admin.category.index',compact('title','categoryList'));
    }
    public function create(){
        $title='Category Create';
        return view('admin.category.create',compact('title'));
    }
    public function store(Request $request){
        $data=$request->all();
        Validator::make($data,Category::$createRules,Category::$errorMsg)->validate();

        $data['image']=Category::uploadImage($request);
        Category::create($data);
        $request->session()->flash('success_category','CATEGORY CREATED');
        return redirect()->route('category.index');
    }

    public function edit($id){
        $category=Category::find($id);
        $title=$category->title;
        return view('admin.category.edit',compact('title','category'));
    }

    public function update(Request $request,$id){
        $data=$request->all();
        Validator::make($data,Category::$updateRules,Category::$errorMsg)->validate();
        $category=Category::find($id);
        $data['image']=Category::uploadImage($request,$category->image) ? Category::uploadImage($request,$category->image) : $category->image;
        $category->update($data);
        $request->session()->flash('success_category','CATEGORY UPDATED');
        return redirect()->route('category.index');
    }



    public function delete($id){
        $category=Category::find($id);
        Storage::delete($category->image);
        $category->delete();
        return redirect()->route('category.index')->with('success_category','CATEGORY DELETED');
    }
}
