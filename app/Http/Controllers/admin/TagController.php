<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index(){
        $title='Tag List';
        $tagList=Tag::paginate(2);
        return view('admin.tag.index',compact('title','tagList'));
    }
    public function create(){
        $title='Tag Create';
        return view('admin.tag.create',compact('title'));
    }
    public function store(Request $request){
        $data=$request->all();
        Validator::make($data,Tag::$rules,Tag::$errorMsg)->validate();
        Tag::create($data);
        $request->session()->flash('success_tag','TAG CREATED');
        return redirect()->route('tag.index');
    }
    public function edit($id){
        $tag=Tag::find($id);
        $title=$tag->title;
        return view('admin.tag.edit',compact('title','tag'));
    }
    public function update(Request $request,$id){
        $data=$request->all();
        Validator::make($data,Tag::$rules,Tag::$errorMsg)->validate();
        $tag=Tag::find($id);
        $tag->update($data);
        $request->session()->flash('success_tag','TAG UPDATED');
        return redirect()->route('tag.index');
    }

    public function delete($id){
        $tag=Tag::find($id);
        $tag->delete();
        return redirect()->route('tag.index')->with('success_tag','TAG DELETED');
    }
}
