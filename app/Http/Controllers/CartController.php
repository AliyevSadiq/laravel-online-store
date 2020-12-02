<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{




    public function index(){
        $title='CART PAGE';

        $cartList=\request()->attributes->get('cartList');
        $items_price=\request()->attributes->get('total_price');


        return view('home.cart',compact('title','cartList','items_price'));
    }



    public function add(){
        $product_id=$_GET['id'];

        $cart=Cart::where([['product_id','=',$product_id],['user_id','=',auth()->user()->id]])->first();



        $product=Product::where('id','=',$product_id)->
        select(['price','discount_id','total_count'])->with('discount')->first();


        if(!$product){
            return response()->json('PRODUCT NOT FOUND',404);
        }

        if($product->discount_id){
            $discount=$product->price - (($product->discount->percent*$product->price)/100);
        }else{
            $discount=0;
        }


        if(!$cart){
        Cart::create([
                'product_id'=>$product_id,
                'user_id'=>auth()->user()->id,
                'price'=>$product->price,
                'discount_price'=>$discount,
                'count'=>1,
            ]);
        }else{

            $count=$cart->count+1;
            if($count>=$product->total_count){
                return response()->json('PRODUCT COUNT SO MUCH',400);
            }
            $cart->update([
                'count'=>$count
            ]);
        }

        $cartList=Cart::with('products')->where('user_id','=',auth()->user()->id)->get();



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

        return response()->json(['message'=>'PRODUCT ADDED IN CART','total'=>array_sum($items_count),'price'=>array_sum($items_price)],200);
    }

    public function delete(){
     $id=$_GET['id'];
     $cart=Cart::find($id);
     if($cart){
         $cart->delete();
         $items_price=[];
         $items_count=[];
         $cartList=Cart::where('user_id','=',auth()->user()->id)->get();
         foreach ($cartList as $cart){
             if($cart->discount_price){
                 $price=$cart->discount_price;
             }else{
                 $price=$cart->price;
             }
             $items_price[]=$price*$cart->count;
             $items_count[]=$cart->count;
         }
         return response()->json(['message'=>'PRODUCT DELETED FROM CART','total'=>array_sum($items_count),'price'=>array_sum($items_price)],200);

     }else{
         return response()->json('THIS ITEM NO DELETING',404);
     }
    }



    public function refresh(){
        Cart::where('user_id','=',auth()->user()->id)->delete();
        session()->flash('success_cart','CART EMPTY');
        return redirect()->back();
    }

    public function order(){
      $title='ORDER PAGE';

        $items_price=[];


        $cartList=\request()->attributes->get('cartList');
        $items_price=\request()->attributes->get('total_price');


      return view('home.order',compact('items_price','cartList','title'));
    }

    public function orderForm(Request $request){
        $data=$request->all();
        $cartList=\request()->attributes->get('cartList');
        $total_price=\request()->attributes->get('total_price');
        $total_count=\request()->attributes->get('total_count');
        $data['total_count']=$total_count;
        $data['total_price']=$total_price;
        $data['user_id']=auth()->user()->id;

        Validator::make($data,Order::$rules,Order::$errorMsg)->validate();
        try{
            DB::beginTransaction();
            $order=Order::create($data);
            $order_items=[];

            foreach ($cartList as $product){
                if($product->discount_price){
                    $price=$product->discount_price;
                }else{
                    $price=$product->price;
                }


                $order_items[]=[
                    'order_id'=>$order->id,
                    'product_id'=>$product->products->id,
                    'qty'=>$product->count,
                    'price'=>$price,
                ];
            }

            DB::table('order_product')->insert(
                $order_items
            );
            Cart::where('user_id','=',auth()->user()->id)->delete();
            $request->session()->flash('success_order','ORDER COMPLETE');
            DB::commit();
            return redirect()->route('home.product.list');
        }catch (\Exception $e){
            DB::rollBack();
            $request->session()->flash('error_order','ORDER NOT COMPLETE');
            return redirect()->back();
        }



    }


}
