<?php

namespace App\Http\Middleware\custom;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CartMiddleware
{



    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $items_price=[];
        $items_count=[];
        $cartList=Cart::with('products')->where('user_id','=',auth()->user()->id)->get();
        foreach ($cartList as $cart){
            if($cart->discount_price){
                $price=$cart->discount_price;
            }else{
                $price=$cart->price;
            }
            $items_price[]=$price*$cart->count;
            $items_count[]=$cart->count;
        }


        $request->attributes->add([
            'total_count' =>count($items_count),
            'total_price' =>array_sum($items_price),
            'cartList' =>$cartList,
        ]);


        return $next($request);
    }
}
