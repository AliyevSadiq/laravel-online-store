<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {



        view()->composer('layout.home_main_layout',function ($view){
            if(Cache::has('categories')){
                $categoryList=Cache::get('categories');
            }else{
                $categoryList=Category::select(['id','title'])->with('products')->get();
                Cache::put('categories',$categoryList,600);
            }
            $view->with('categories',$categoryList);
            if(auth()->user()){

                $cartList=Cart::with('products')->where('user_id','=',auth()->user()->id)->get();
            }else{
                $cartList=[];
            }

            $view->with('cartList',$cartList);

            $items_price=[];
            $items_count=[];

            foreach ($cartList as $cart){
                if($cart->discount_price){
                    $price=$cart->discount_price;
                }else{
                    $price=$cart->price;
                }
                $items_price[]=$price*$cart->count;
                $items_count[]=$cart->count;
            }
            $view->with('total_price',array_sum($items_price));
            $view->with('total_count',array_sum($items_count));
        });


        view()->composer('home.filter',function ($view){
            if(Cache::has('tags')){
                $tagList=Cache::get('tags');
            }else{
                $tagList=Tag::select(['id','title'])->get();
                Cache::put('tags',$tagList,600);
            }
            $view->with('tags',$tagList);

            if(Cache::has('categories')){
                $categoryList=Cache::get('categories');
            }else{
                $categoryList=Category::select(['id','title'])->with('products')->get();
                Cache::put('categories',$categoryList,600);
            }
            $view->with('categories',$categoryList);
        });



        Paginator::useBootstrap();
    }
}
