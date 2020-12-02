<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(){
        $title='Home Page';




           if(Cache::has('sliderList')){
               $sliderList=Cache::get('sliderList');
           }else{
               $sliderList=Slider::all();
               Cache::put('sliderList',$sliderList,60);
           }

        if(Cache::has('categoryList')){
            $categoryList=Cache::get('categoryList');
        }else{
            $categoryList=Category::select(['id','title','image'])->get();
            Cache::put('categoryList',$categoryList,60);
        }

        $productList=Product::select(['id','title','price','category_id','discount_id','total_count','thumbnail'])
        ->with(['category','discount'])->orderBy('id','desc')->limit(20)->get();



        return view('home.index',compact('title','sliderList','categoryList','productList'));
    }

    public function productList(){
        $title='PRODUCT LIST';
        $productList=Product::select(['id','title','price','discount_id','thumbnail','seo_description'])
            ->with(['discount'])->orderBy('id','desc')->paginate(10);
        return view('home.product',compact('title','productList'));
    }

    public function category($id){
    $category=Category::where('id','=',$id)->select(['id','title'])->first();

    if(!$category){
        abort(404);
    }
        $title='CATEGORY | '.$category->title;
        $productList=Product::select(['id','title','price','discount_id','thumbnail','seo_description'])->
            where('category_id','=',$id)->with(['discount'])->orderBy('id','desc')->paginate(10);
        return view('home.product',compact('title','productList'));
    }

    public function discountList(){
        $title='DISCOUNT PRODUCT';
        $productList=Product::select(['id','title','price','discount_id','thumbnail','seo_description'])->
            where('discount_id','=',1)->with(['discount'])->orderBy('id','desc')->paginate(10);
        return view('home.product',compact('title','productList'));
    }

    public function tag($id){
        $tag=Tag::where('id','=',$id)->select(['id','title'])->first();
        if(!$tag){
            abort('404');
        }
        $title='TAG | '.$tag->title;


        $productList=$tag->products()->with('discount')->
        select(['products.id','title','price','discount_id','thumbnail','seo_description'])->
        orderBy('products.id','desc')->paginate(60);

        return view('home.product',compact('title','productList'));
    }

    public function newList(){
        $now=date('Y-m-d 0:0:0');
        $tomorrow=date("Y-m-d 23:59:59",strtotime("+1 Day"));
        $title='NEW PRODUCTS';
        $productList=Product::select(['id','title','price','discount_id','thumbnail','seo_description'])->
        whereBetween('created_at',[$now,$tomorrow])->with(['discount'])->orderBy('id','desc')->paginate(10);
        return view('home.product',compact('title','productList'));
    }


    public function search(){
        if(isset($_GET['query'])){
            $query=trim(htmlspecialchars($_GET['query']));
        }else{
            $query=null;
        }
        if(isset($_GET['min'])){
            $min=trim(htmlspecialchars(intval(abs($_GET['min']))));
        }else{
            $min=null;
        }
        if(isset($_GET['max'])){
            $max=trim(htmlspecialchars(intval(abs($_GET['max']))));
        }else{
            $max=null;
        }

        $condition_items=[];
        if($query){
            $condition_items[]=['title','LIKE',"%$query%"];
        }
        if($min){
            $condition_items[]=['price','>',$min];
        }
        if($max){
            $condition_items[]=['price','<',$max];
        }

        if(!$condition_items){
            return redirect()->route('home.product.list');
        }


        $title='SEARCH PRODUCT';
        $productList=Product::select(['id','title','price','discount_id','thumbnail','seo_description'])->
        where($condition_items)->with(['discount'])->orderBy('id','desc')->paginate(10);
        return view('home.product',compact('title','productList'));
    }


    public function productDetail($id){

        $product=Product::where('id','=',$id)->with(['tags','category','discount','galleries','reviews'])->first();

        if(!$product){
            return redirect()->route('home.product.list');
        }

        $review_items=[];
        foreach ($product->reviews as $review){
            $review_items[]=$review->rating;
        }
        if($review_items){

            $rating=intval(array_sum($review_items)/count($product->reviews));
        }else{
            $rating=0;
        }






        $title='PRODUCT DETAIL | '.$product->title;
//        $product->update([
//           'views_count'=>$product->views_count+1
//        ]);
        return view('home.product-detail',compact('title','product','rating'));
    }


    public function review(Request $request){
        $data=$request->all();
        if(!auth()->user()){
            $request->session()->flash('error_review','YOU MUST BE LOGIN');
            return redirect()->back();
        }else{
            $data['user_id']=auth()->user()->id;
        }
        $product=Product::find($data['product_id']);

        if(!$product){
            $request->session()->flash('error_review','PRODUCT NOT FOUND FOR REVIEW');
            return redirect()->back();
        }

        $review_check=Review::where([
            ['user_id','=',auth()->user()->id],
            ['product_id','=',$product->id],
        ])->first();

        if($review_check){
            $request->session()->flash('error_review','YOU ALREADY WRITTEN REVIEW FOR THIS PRODUCT');
            return redirect()->back();
        }

        Validator::make($data,Review::$createRules,Review::$errorMsg)->validate();

       Review::create($data);

        $request->session()->flash('success_review','YOU REVIEW CHECKING FROM MODERATOR');
        return redirect()->back();
    }


}
