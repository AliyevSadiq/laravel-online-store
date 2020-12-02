@extends('layout.home_main_layout')

@section('home_title')
    @parent {{$title}}
@endsection
@section('home_content')

    <div class="breadcrumb-area bg-gray">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{route('home.index')}}">Home</a>
                    </li>
                    <li class="active">{{$title}}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="cart-main-area pt-115 pb-120 bg-white">
        <div class="container">
            @if(count($cartList))
            <h3 class="cart-page-title">Your cart items</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <form action="#">
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Until Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>action</th>
                                </tr>
                                </thead>
                                <tbody>

                                 @foreach($cartList as $cart)
                                <tr class="single-product-cart" data-cart="{{$cart->id}}">
                                    <td class="product-thumbnail">
                                        <a href="{{route('home.product',['id'=>$cart->products->id])}}">
                                            <img src="{{asset($cart->products->thumbnail)}}" alt="{{$cart->products->title}}">
                                        </a>
                                    </td>
                                    <td class="product-name"><a href="{{route('home.product',['id'=>$cart->products->id])}}">{{$cart->products->title}}</a></td>
                                    @if($cart->discount_price)
                                        @php $price=$cart->discount_price @endphp
                                    @else
                                        @php $price=$cart->price @endphp
                                    @endif



                                    <td class="product-price-cart"><span class="amount">${{$price}}</span></td>
                                    <td class="product-quantity pro-details-quality">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" readonly type="text" name="qtybutton" value="{{$cart->count}}">
                                        </div>
                                    </td>
                                    <td class="product-subtotal">${{$price*$cart->count}}</td>
                                    <td class="product-remove">
                                        <a href="#" class="delete-cart" data-id="{{$cart->id}}"><i class="icon_close"></i></a>
                                    </td>
                                </tr>
                                 @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="{{route('home.product.list')}}">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear">
                                        <a href="{{route('cart.refresh')}}">Clear Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">

                        <div class="col-lg-4 col-md-12">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                <h5>Total products <span class="cart-amount">${{$items_price}}</span></h5>

                                <a href="{{route('cart.order')}}">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="alert alert-danger">
                    <strong>CART EMPTY</strong>
                </div>
            @endif
        </div>
    </div>


@endsection
