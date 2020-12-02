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
                    <li class="active">{{$title}} </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="checkout-main-area pt-120 pb-120 bg-white">
        <div class="container">

            <div class="checkout-wrap pt-30">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap mr-50">
                            <h3>Billing Details</h3>
                            <form action="{{route('cart.orderForm')}}" method="post" class="order-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20">
                                            <label>First Name <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name')}}">
                                            @error('first_name')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20">
                                            <label>Last Name <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{old('last_name')}}">
                                            @error('last_name')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-info mb-20">
                                            <label>Phone <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}">
                                            @error('phone')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-info mb-20">
                                            <label>Email Address <abbr class="required" title="required">*</abbr></label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                                            @error('email')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-info mb-20">
                                            <label>Address <abbr class="required" title="required">*</abbr></label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="20" rows="5">{{old('address')}}</textarea>
                                            @error('address')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="additional-info-wrap">
                                    <label>Order notes</label>
                                    <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="note">{{old('note')}}</textarea>
                                </div>

                                <div class="Place-order mt-10">
                                    <button type="submit">CONFIRM ORDER</button>
                                </div>
                            </form>


                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="your-order-area">
                            <h3>Your order</h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-info-wrap">
                                    <div class="your-order-info">
                                        <ul>
                                            <li>Product <span>Total</span></li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>
                                            @foreach($cartList as $cart)
                                            <li>{{$cart->products->title}} X {{$cart->count}}
                                                @if($cart->discount_price)
                                                    <span>${{$cart->discount_price*$cart->count}} </span>
                                                @else
                                                    <span>${{$cart->price*$cart->count}} </span>
                                                @endif
                                            </li>
                                            @endforeach

                                        </ul>
                                    </div>

                                    <div class="your-order-info order-total">
                                        <ul>
                                            <li>Total <span>${{$items_price}}</span></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
