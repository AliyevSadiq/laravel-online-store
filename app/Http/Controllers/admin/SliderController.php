<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index(){
        $title='Slider List';
        $sliderList=Slider::paginate(2);
        return view('admin.slider.index',compact('title','sliderList'));
    }

    public function create(){
        $title='Create Slider';
        return view('admin.slider.create',compact('title'));
    }
    public function store(Request $request){
        Validator::make($request->all(),Slider::$createRules,Slider::$errorMsg)->validate();
        $data=$request->all();
        $data['image']=Slider::uploadImage($request);
        Slider::create($data);
        $request->session()->flash('success_slider','SLIDER CREATED');
        return redirect()->route('slider.index');
    }

    public function edit($id){
        $slider=Slider::find($id);
        $title="Slider {$slider->title}";
        return view('admin.slider.edit',compact('title','slider'));
    }

    public function update(Request $request,$id){
        $slider=Slider::find($id);
        Validator::make($request->all(),Slider::$updateRules,Slider::$errorMsg)->validate();
        $data=$request->all();
        $data['image']=Slider::uploadImage($request,$slider->image) ? Slider::uploadImage($request,$slider->image) : $slider->image;
        $slider->update($data);
        $request->session()->flash('success_slider','SLIDER UPDATED');
        return redirect()->route('slider.index');
    }

    public function delete($id){
        $slider=Slider::find($id);
        Storage::delete($slider->image);
        $slider->delete();
        return redirect()->route('slider.index')->with('success_slider','SLIDER DELETED');
    }
}
