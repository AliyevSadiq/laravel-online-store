<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        $title='Review List';
        $reviewList=Review::with('product')->paginate(2);
        return view('admin.review.index',compact('title','reviewList'));
    }


    public function edit($id){
        $review=Review::find($id);
        $title='REVIEW EDIT';
        return view('admin.review.edit',compact('title','review'));
    }

    public function update(Request $request,$id){
        $review=Review::find($id);

        $review->update([
           'is_active'=>$request->all()['is_active']
        ]);
        $request->session()->flash('success_review','REVIEW UPDATED');
        return redirect()->route('review.index');
    }




    public function delete($id){
        $tag=Review::find($id);
        $tag->delete();
        return redirect()->route('review.index')->with('success_review','REVIEW DELETED');
    }
}
