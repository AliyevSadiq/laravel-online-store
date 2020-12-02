<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $title='Product List';
        $productList=Product::with(['tags','category'])->paginate(20);
        return view('admin.product.index',compact('title','productList'));
    }
    public function create(){
        $title='Product Create';
        $tags=Tag::pluck('title','id')->all();
        $discountList=Discount::pluck('title','id')->all();
        $categories=Category::pluck('title','id')->all();
        return view('admin.product.create',compact('title','tags','categories','discountList'));
    }

    public function store(Request $request){
        $data=$request->all();
        Validator::make($data,Product::$createRules,Product::$errorMsg)->validate();
        $data['thumbnail']=Product::uploadImg($request,'thumbnail');
        $data['image']=Product::uploadImg($request,'image');

        $discountData=$request->input('discount_id');

        $product=Product::create($data);

        $gallery_items=[];
        if($request->hasFile('galleries')){
            foreach ($request->file('galleries') as $img){
                $folder="product/gallery/".date("Y-m-d");
                $gallery_items[]=[
                    'product_id'=>$product->attributesToArray()['id'],
                    'image'=>$img->store("uploads/images/{$folder}"),
                    'created_at'=>NOW()
                ];
            }
        }

        $product->tags()->sync($request->input('tags'));
        Gallery::insert($gallery_items);


            Product::where('id','=',$product->attributesToArray()['id'])->update([
              'discount_id'=>$discountData
            ]);



        $request->session()->flash('success_product','PRODUCT CREATED');
        return redirect()->route('product.index');
    }

    public function edit($id){
        $product=Product::find($id);
        $title=$product->title;
        $tags=Tag::pluck('title','id')->all();
        $categories=Category::pluck('title','id')->all();
        $discountList=Discount::pluck('title','id')->all();
        return view('admin.product.edit',compact('title','tags','categories','product','discountList'));
    }
    public function update(Request $request,$id){
        $data=$request->all();
        Validator::make($data,Product::$updateRules,Product::$errorMsg)->validate();
        $product=Product::find($id);
        $data['thumbnail']=Product::uploadImg($request,'thumbnail',$product->thumbnail) ? Product::uploadImg($request,'thumbnail',$product->thumbnail) : $product->thumbnail;
        $data['image']=Product::uploadImg($request,'image',$product->image) ? Product::uploadImg($request,'image',$product->image) : $product->image;
        $discountData=$request->input('discount_id');
        $product->update($data);

        $gallery_items=[];
        if($request->hasFile('galleries')){
            foreach ($request->file('galleries') as $img){
                $folder="product/gallery/".date("Y-m-d");
                $gallery_items[]=[
                    'product_id'=>$product->id,
                    'image'=>$img->store("uploads/images/{$folder}"),
                    'created_at'=>NOW()
                ];
            }
        }
        $product->tags()->sync($request->input('tags'));
        Gallery::insert($gallery_items);

        Product::where('id','=',$product->attributesToArray()['id'])->update([
            'discount_id'=>$discountData
        ]);
        $request->session()->flash('success_product','PRODUCT CREATED');
        return redirect()->route('product.index');


    }



    public function delete($id){
        $product=Product::find($id);
        $product->tags()->sync([]);
        Storage::delete($product->image);
        Storage::delete($product->thumbnail);
        $gallery=Gallery::where('product_id','=',$id)->get();

        foreach ($gallery as $image){
            Storage::delete($image->image);
        }
        Gallery::where('product_id','=',$id)->delete();
        $product->delete();
        session()->flash('success_product','PRODUCT DELETED');
        return redirect()->route('product.index');
    }

    public function deleteImage(Request $request){
     $id=$_GET['id'];
     $gallery=Gallery::find($id);
     Storage::delete($gallery->image);
     $gallery->delete();
     return response()->json('IMAGE DELETED',200);
    }
}
