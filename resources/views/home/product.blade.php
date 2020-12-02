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
                    <li class="active">Shop </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="shop-area pt-120 pb-120 bg-white">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="shop-topbar-wrapper">
                        <div class="shop-topbar-left">
                            <div class="view-mode nav">
                                <a class="active" href="#shop-1" data-toggle="tab"><i class="icon-grid"></i></a>
                                <a href="#shop-2" data-toggle="tab"><i class="icon-menu"></i></a>
                            </div>

                        </div>

                    </div>
                    <div class="shop-bottom-area">
                        <div class="tab-content jump">
                            <div id="shop-1" class="tab-pane active">
                                <div class="row">
                                    @foreach($productList as $product)
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="single-product-wrap mb-35">
                                            <div class="product-img product-img-zoom mb-15">
                                                <a href="{{route('home.product',['id'=>$product->id])}}">
                                                    <img src="{{asset($product->thumbnail)}}" alt="">
                                                </a>
                                                @if($product->discount_id)
                                                <span class="pro-badge left bg-red">-{{$product->discount->percent}}%</span>
                                                @endif
                                            </div>
                                            <div class="product-content-wrap-2 text-center">
                                                <div class="product-rating-wrap">
                                                    <div class="product-rating">
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                    </div>
                                                    <span>(5)</span>
                                                </div>
                                                <h3><a href="{{route('home.product',['id'=>$product->id])}}">{{$product->title}}</a></h3>
                                                <div class="product-price-2">
                                                    @if($product->discount_id)
                                                        <span class="new-price">
                                                            ${{$product->price-(($product->discount->percent*$product->price)/100)}}
                                                        </span>
                                                        <span class="old-price">${{$product->price}}</span>
                                                    @else
                                                        <span>${{$product->price}}</span>
                                                    @endif


                                                </div>
                                            </div>
                                            <div class="product-content-wrap-2 product-content-position text-center">
                                                <div class="product-rating-wrap">
                                                    <div class="product-rating">
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                    </div>
                                                    <span>(5)</span>
                                                </div>
                                                <h3><a href="{{route('home.product',['id'=>$product->id])}}">{{$product->title}}</a></h3>
                                                <div class="product-price-2">
                                                    @if($product->discount_id)
                                                        <span class="new-price">
                                                            ${{$product->price-(($product->discount->percent*$product->price)/100)}}
                                                        </span>
                                                        <span class="old-price">${{$product->price}}</span>
                                                    @else
                                                        <span>${{$product->price}}</span>
                                                    @endif
                                                </div>
                                                <div class="pro-add-to-cart">
                                                    <button title="Add to Cart" class="add_cart" data-id="{{$product->id}}">Add To Cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="shop-2" class="tab-pane">
                                @foreach($productList as $product)
                                <div class="shop-list-wrap mb-30">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6">
                                            <div class="product-list-img">
                                                <a href="{{route('home.product',['id'=>$product->id])}}">
                                                    <img src="{{asset($product->thumbnail)}}" alt="{{$product->title}}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-7 col-md-6 col-sm-6">
                                            <div class="shop-list-content">
                                                <h3><a href="{{route('home.product',['id'=>$product->id])}}">{{$product->title}}</a></h3>
                                                <div class="pro-list-price">

                                                    @if($product->discount_id)
                                                        <span class="new-price">
                                                            ${{$product->price-(($product->discount->percent*$product->price)/100)}}
                                                        </span>
                                                        <span class="old-price">${{$product->price}}</span>
                                                    @else
                                                        <span>${{$product->price}}</span>
                                                    @endif

                                                </div>
                                                <div class="product-list-rating-wrap">
                                                    <div class="product-list-rating">
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star gray"></i>
                                                        <i class="icon_star gray"></i>
                                                    </div>
                                                    <span>(3)</span>
                                                </div>
                                                <p>{{$product->seo_description}}</p>
                                                <div class="product-list-action">
                                                    <button title="Add To Cart" class="add_cart" data-id="{{$product->id}}"><i class="icon-basket-loaded"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{$productList->links('pagination.custom')}}


                    </div>
                </div>
                @include('home.filter')
            </div>
        </div>
    </div>


@endsection
