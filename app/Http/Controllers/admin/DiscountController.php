<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    public function index(){
        $title='Discount List';
        $discountList=Discount::paginate(2);
        return view('admin.discount.index',compact('title','discountList'));
    }

    public function create(){
        $title='Discount Create';
        return view('admin.discount.create',compact('title'));
    }

    public function store(Request $request){
        $data=$request->all();
        Validator::make($data,Discount::$rules,Discount::$errorMsg)->validate();
        Discount::create($data);
        $request->session()->flash('success_discount','DISCOUNT CREATED');
        return redirect()->route('discount.index');
    }

    public function edit($id){
        $discount=Discount::find($id);
        $title=$discount->title;
        return view('admin.discount.edit',compact('title','discount'));
    }

    public function update(Request $request,$id){
        $data=$request->all();
        Validator::make($data,Discount::$rules,Discount::$errorMsg)->validate();
        $discount=Discount::find($id);
        $discount->update($data);
        $request->session()->flash('success_discount','DISCOUNT UPDATED');
        return redirect()->route('discount.index');
    }
    public function delete($id){
        $discount=Discount::find($id);
        $discount->delete();
        return redirect()->route('discount.index')->with('success_discount','DISCOUNT DELETED');
    }
}
