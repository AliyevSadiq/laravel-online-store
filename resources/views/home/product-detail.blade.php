@extends('layout.home_main_layout')

@section('home_title') @parent {{$title}} @endsection

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

    <div class="product-details-area pt-120 pb-115 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-tab">
                        <div class="pro-dec-big-img-slider">
                            <div class="easyzoom-style">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="{{asset($product->image)}}">
                                        <img src="{{asset($product->image)}}" alt="">
                                    </a>
                                </div>
                                <a class="easyzoom-pop-up img-popup" href="{{asset($product->image)}}"><i class="icon-size-fullscreen"></i></a>
                            </div>


                            @foreach($product->galleries as $image)
                            <div class="easyzoom-style">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="{{asset($image->image)}}">
                                        <img src="{{asset($image->image)}}" alt="">
                                    </a>
                                </div>
                                <a class="easyzoom-pop-up img-popup" href="{{asset($image->image)}}"><i class="icon-size-fullscreen"></i></a>
                            </div>
                            @endforeach
                        </div>
                        <div class="product-dec-slider-small product-dec-small-style1">
                            @foreach($product->galleries as $image)
                            <div class="product-dec-small ">
                                <img src="{{asset($image->image)}}" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-content pro-details-content-mrg">
                        <h2>{{$product->title}}</h2>
                        <div class="product-ratting-review-wrap">
                            <div class="product-ratting-digit-wrap">
                                <div class="product-ratting">
                                    @for($i=0;$i<$rating;$i++)
                                    <i class="icon_star"></i>
                                    @endfor
                                </div>
                                <div class="product-digit">
                                    <span> {{$rating}}
                                    </span>
                                </div>
                            </div>
                            <div class="product-review-order">
                                <span>{{count($product->reviews)}} Reviews</span>
                                <span>{{$product->views_count}} views</span>
                                <span>{{$product->total_count}} total</span>
                            </div>
                        </div>
                        <p>{{$product->seo_description}}</p>
                        <div class="pro-details-price">
                            @if($product->discount_id)
                                <span class="new-price">$
                                                {{$product->price-(($product->discount->percent*$product->price)/100)}}
                                        </span>
                                <span class="old-price">${{$product->price}}</span>
                            @else
                                <span>${{$product->price}}</span>
                            @endif
                        </div>



                        <div class="product-details-meta">
                            <ul>
                                <li><span>Categories:</span> <a href="{{route('home.category',['id'=>$product->category_id])}}">{{$product->category->title}}</a> </li>
                                <li><span>Tag: </span>
                                    @foreach($product->tags  as $tag)

                                    <a href="{{route('home.tag',['id'=>$tag->id])}}">{{$tag->title}}</a> </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="pro-details-action-wrap">
                            <div class="pro-details-add-to-cart">
                                <a  class="add_cart" data-id="{{$product->id}}">Add To Cart </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="description-review-wrapper pb-110 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="dec-review-topbar nav mb-45">
                        <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                        <a data-toggle="tab" href="#des-details4">Reviews and Ratting </a>
                    </div>
                    <div class="tab-content dec-review-bottom">
                        <div id="des-details1" class="tab-pane active">
                            <div class="description-wrap">
                                <p>{{$product->content}}</p>
                            </div>
                        </div>
                        <div id="des-details4" class="tab-pane">
                            <div class="review-wrapper">
                                <h2>{{count($product->reviews)}} review for {{$product->title}}</h2>
                                  @foreach($product->reviews as $review)
                                   <div class="single-review">

                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-name">
                                                <h5><span>{{$review->name}}</span> - {{date('M d, Y', strtotime($review->created_at))}} </h5>
                                            </div>
                                            <div class="review-rating ml-3">
                                                @for($i=0;$i<$review->rating;$i++)
                                                <i class="yellow icon_star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p>{{$review->message}}</p>
                                    </div>
                                </div>
                                 @endforeach
                            </div>
                            <div class="ratting-form-wrapper">
                                <span>Add a Review</span>
                                <p>Your email address will not be published. Required fields are marked <span>*</span></p>
                                <div class="ratting-form">
                                    <form action="{{route('home.product.review')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="rating-form-style mb-20">
                                                    <label>Name <span>*</span></label>
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                                                    @error('name')
                                                     <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="rating-form-style mb-20">
                                                    <label>Email <span>*</span></label>
                                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                                                    @error('email')
                                                    <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="star-box-wrap">
                                                    <div class="single-ratting-star">
                                                        <a href="#"><i class="icon_star"></i></a>
                                                    </div>
                                                    <div class="single-ratting-star">
                                                        <a href="#"><i class="icon_star"></i></a>
                                                        <a href="#"><i class="icon_star"></i></a>
                                                    </div>
                                                    <div class="single-ratting-star">
                                                        <a href="#"><i class="icon_star"></i></a>
                                                        <a href="#"><i class="icon_star"></i></a>
                                                        <a href="#"><i class="icon_star"></i></a>
                                                    </div>
                                                    <div class="single-ratting-star">
                                                        <a href="#"><i class="icon_star"></i></a>
                                                        <a href="#"><i class="icon_star"></i></a>
                                                        <a href="#"><i class="icon_star"></i></a>
                                                        <a href="#"><i class="icon_star"></i></a>
                                                    </div>
                                                    <div class="single-ratting-star">
                                                        <a href="#"><i class="icon_star"></i></a>
                                                        <a href="#"><i class="icon_star"></i></a>
                                                        <a href="#"><i class="icon_star"></i></a>
                                                        <a href="#"><i class="icon_star"></i></a>
                                                        <a href="#"><i class="icon_star"></i></a>
                                                    </div>

                                                </div>
                                                <input type="hidden" name="rating" value="">
                                                @error('rating')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating-form-style mb-20">
                                                    <label>Your review <span>*</span></label>
                                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror">{{old('message')}}</textarea>
                                                    @error('message')
                                                    <div class="text-danger">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-submit">
                                                    <input type="submit" class="review-btn" value="Submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
