@extends('layout.home_main_layout')

@section('home_title')
    @parent {{$title}}
@endsection
@section('home_content')

    <div class="slider-area bg-gray-10">
        <div class="container">
            <div class="hero-slider-active-2 nav-style-1 nav-style-1-modify-2 nav-style-1-orange">


                @foreach($sliderList as $slider)
                <div class="single-hero-slider single-hero-slider-hm10 single-animation-wrap">
                    <div class="row slider-animated-1">
                        <div class="col-lg-5 col-md-5 col-12 col-sm-12">
                            <div class="hero-slider-content-6 slider-content-hm9 slider-content-hm10">

                                <h1 class="animated">{{$slider->title}}</h1>
                                <p class="animated">{{$slider->description}}</p>
                                <div class="btn-style-1">
                                    <a class="animated btn-1-padding-4 btn-1-orange btn-1-font-14" href="{{$slider->slider_url}}">Explore Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-12 col-sm-12">
                            <div class="hm10-hero-slider-img">
                                <img class="animated" src="{{$slider->image}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="product-categories-area pt-70 pb-70">
        <div class="container">
            <div class="section-title-btn-wrap mb-25">
                <div class="section-title-8">
                    <h2>Popular Categories</h2>
                </div>
                <div class="btn-style-9">
                    <a href="shop.html">All Product</a>
                </div>
            </div>
            <div class="section-wrap-1">
                <div class="product-categories-slider-1 nav-style-3">
                    @foreach($categoryList as $category)
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-border-transparent mb-15">
                                <a href="{{route('home.category',['id'=>$category->id])}}">
                                    <img src="{{$category->image}}" alt="">
                                </a>
                            </div>
                            <div class="product-content-categories-2 product-content-orange text-center">
                                <h5 class="font-width-dec"><a href="{{route('home.category',['id'=>$category->id])}}">{{$category->title}}</a></h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="product-area pb-70">
        <div class="container">
            <div class="section-wrap-1">
                <div class="section-title-deal-wrap mb-30">
                    <div class="section-title-8">
                        <h2>New products</h2>
                    </div>

                </div>
                <div class="product-slider-active-8 dot-style-2 dot-style-2-position-static dot-style-2-mrg-3 nav-style-5 nav-style-5-modify">
                    @foreach($productList as $product)
                    <div class="product-plr-1">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-zoom mb-20">
                                <a href="{{route('home.product',['id'=>$product->id])}}">
                                    <img src="{{asset($product->thumbnail)}}" alt="{{$product->title}}">
                                </a>
                                @if($product->discount_id)
                                <span class="pro-badge left bg-red">-{{$product->discount->percent}}%</span>
                                @endif

                            </div>
                            <div class="product-content-wrap-3">
                                <h3 class="mrg-none"><a class="orange" href="{{route('home.product',['id'=>$product->id])}}">{{$product->title}}</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    @if($product->discount_id)
                                        <span class="new-price">$
                                                 {{$product->price-(($product->discount->percent*$product->price)/100)}}
                                        </span>
                                        <span class="old-price">${{$product->price}}</span>
                                    @else
                                        <span>${{$product->price}}</span>
                                    @endif

                                </div>
                                <div class="product-author">
                                    <span>Category: <a class="orange" href="{{route('home.category',['id'=>$product->category->id])}}">{{$product->category->title}}</a></span>
                                </div>
                                <div class="product-sold">
                                    <div class="single-product-sold">

                                        <span>Count: {{$product->total_count}} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content-wrap-3 product-content-position-2 pro-position-2-padding-dec">
                                <h3 class="mrg-none"><a class="orange" href="{{route('home.product',['id'=>$product->id])}}">{{$product->title}}</a></h3>
                                <div class="product-rating-wrap-2">
                                    <div class="product-rating-4">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    </div>
                                    <span>(4)</span>
                                </div>
                                <div class="product-price-4">
                                    @if($product->discount_id)
                                        <span class="new-price">$
                                                {{$product->price-(($product->discount->percent*$product->price)/100)}}
                                        </span>
                                        <span class="old-price">${{$product->price}}</span>
                                    @else
                                        <span>${{$product->price}}</span>
                                    @endif
                                </div>
                                <div class="product-author">
                                    <span>Category: <a class="orange" href="{{route('home.category',['id'=>$product->category->id])}}">{{$product->category->title}}</a></span>
                                </div>
                                <div class="product-sold">
                                    <div class="single-product-sold">

                                        <span>Count: {{$product->total_count}} </span>
                                    </div>
                                </div>
                                <div class="pro-add-to-cart-2">
                                    <button title="Add to Cart" class="add_cart" data-id="{{$product->id}}">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>






@endsection
