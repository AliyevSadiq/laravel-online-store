<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Norda - @yield('home_title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/front/images/favicon.png')}}">

    <!-- All CSS is here
	============================================ -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
    <link rel="stylesheet" href="{{asset('assets/front/css/front.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <style>




    </style>

</head>

<body>

<div class="main-wrapper bg-gray-9">
    <header class="header-area bg-orange">
        <div class="header-large-device">
            <div class="header-top header-top-ptb-7 border-bottom-9">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="{{route('home.index')}}"><img src="{{asset('assets/front/images/logo/logo-3.png')}}" alt="logo"></a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="categori-search-wrap categori-search-wrap-modify-2">

                                <div class="search-wrap-3">
                                    <form action="{{route('home.product.search')}}" method="get">
                                        <input placeholder="Search Products..." name="query" type="text">
                                        <button class="orange"><i class="lnr lnr-magnifier"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3">
                            <div class="header-action header-action-flex">
                                <div class="same-style-2 same-style-2-white same-style-2-hover-black same-style-2-font-inc">
                                    <a href="{{route('profile')}}"><i class="icon-user"></i></a>
                                </div>

                                <div class="same-style-2 same-style-2-white same-style-2-hover-black same-style-2-font-inc header-cart">
                                    <a class="cart-active" href="#">
                                        <i class="icon-basket-loaded"></i><span class="pro-count  max-count black">{{$total_count}}</span>
                                        <span class="cart-amount white" id="cart_amount">${{$total_price}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="main-menu main-menu-white main-menu-font-size-14 main-menu-padding-3 main-menu-lh-5 main-menu-hover-black">
                                <nav>
                                    <ul>
                                        <li><a href="#">Category <i class="icon-arrow-down"></i></a>
                                            <ul class="sub-menu-style">
                                                @foreach($categories as $category)
                                                <li><a href="{{route('home.category',['id'=>$category->id])}}">{{$category->title}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>

                                        <li><a href="{{route('home.product.list')}}">ALL PRODUCTS </a></li>
                                        <li><a href="{{route('home.discount.list')}}">DISCOUNT PRODUCTS </a></li>
                                        <li><a href="{{route('home.new.list')}}">NEW PRODUCTS </a></li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-small-device small-device-ptb-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-5">
                        <div class="mobile-logo">
                            <a href="{{route('home.index')}}">
                                <img alt="" src="{{asset('assets/front/images/logo/logo-3.png')}}">
                            </a>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="header-action header-action-flex">
                            <div class="same-style-2 same-style-2-white same-style-2-hover-black same-style-2-font-inc">
                                <a href="{{route('profile')}}"><i class="icon-user"></i></a>
                            </div>

                            <div class="same-style-2 same-style-2-white same-style-2-hover-black same-style-2-font-inc header-cart">
                                <a class="cart-active" href="#">
                                    <i class="icon-basket-loaded"></i><span class="pro-count mini-count black">{{$total_count}}</span>
                                </a>
                            </div>
                            <div class="same-style-2 same-style-2-white same-style-2-hover-black main-menu-icon">
                                <a class="mobile-header-button-active" href="#"><i class="icon-menu"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Mobile menu start -->
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="clickalbe-sidebar-wrap">
            <a class="sidebar-close"><i class="icon_close"></i></a>
            <div class="mobile-header-content-area">
                <div class="mobile-search mobile-header-padding-border-1">
                    <form class="search-form" action="#">
                        <input type="text" placeholder="Search here…">
                        <button class="button-search"><i class="icon-magnifier"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-padding-border-2">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><a href="#">Category</a>
                                <ul class="dropdown">
                                    @foreach($categories as $category)
                                        <li><a href="{{route('home.category',['id'=>$category->id])}}">{{$category->title}}</a></li>
                                    @endforeach
                                </ul>
                            </li>

                            <li><a href="{{route('home.product.list')}}">ALL PRODUCTS </a></li>
                            <li><a href="{{route('home.discount.list')}}">DISCOUNT PRODUCTS </a></li>
                            <li><a href="{{route('home.new.list')}}">NEW PRODUCTS </a></li>

                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-social-icon">
                    <a class="facebook" href="#"><i class="icon-social-facebook"></i></a>
                    <a class="twitter" href="#"><i class="icon-social-twitter"></i></a>
                    <a class="pinterest" href="#"><i class="icon-social-pinterest"></i></a>
                    <a class="instagram" href="#"><i class="icon-social-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- mini cart start -->
    <div class="sidebar-cart-active">
        <div class="sidebar-cart-all">
            <a class="cart-close" href="#"><i class="icon_close"></i></a>
            <div class="cart-content">
                <h3>Shopping Cart</h3>
                @if(count($cartList))
                <ul>
                    @foreach($cartList as $cart)
                    <li class="single-product-cart" data-cart="{{$cart->id}}">
                        <div class="cart-img">
                            <a href="{{route('home.product',['id'=>$cart->products->id])}}">
                                <img src="{{asset($cart->products->thumbnail)}}" alt="{{$cart->products->title}}"></a>
                        </div>
                        <div class="cart-title">
                            <h4><a href="{{route('home.product',['id'=>$cart->products->id])}}">{{$cart->products->title}}</a></h4>
                           @if($cart->discount_price)
                               @php  $price=$cart->discount_price   @endphp
                            @else
                                @php  $price=$cart->price   @endphp
                           @endif
                            <span> {{$cart->count}} × ${{$price}}	</span>
                        </div>
                        <div class="cart-delete">
                            <a href="#" class="delete-cart" data-id="{{$cart->id}}">×</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="cart-total">
                    <h4>Subtotal: <span class="cart-amount">${{$total_price}}</span></h4>
                </div>
                <div class="cart-checkout-btn">
                    <a class="btn-hover cart-btn-style" href="{{route('cart.index')}}">view cart</a>
                    <a class="no-mrg btn-hover cart-btn-style" href="{{route('cart.order')}}">checkout</a>
                </div>
                @else
                <div class="text-danger">EMPTY</div>
                @endif
            </div>
        </div>
    </div>


    @yield('home_content')

    <footer class="footer-area bg-white pt-100">
        <div class="footer-top border-bottom-4 pb-55">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-title">Category</h3>
                            <div class="footer-info-list info-list-50-parcent">
                                <ul>
                                    @foreach($categories as $category)
                                        <li><a href="{{route('home.category',['id'=>$category->id])}}">{{$category->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="footer-widget ml-70 mb-40">
                            <h3 class="footer-title">useful links</h3>
                            <div class="footer-info-list">
                                <ul>
                                    <li><a href="{{route('home.product.list')}}">ALL PRODUCTS </a></li>
                                    <li><a href="{{route('home.discount.list')}}">DISCOUNT PRODUCTS </a></li>
                                    <li><a href="{{route('home.new.list')}}">NEW PRODUCTS </a></li>


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="footer-widget mb-40">
                            <h3 class="footer-title">Contact Us</h3>
                            <div class="contact-info-2">
                                <div class="single-contact-info-2">
                                    <div class="contact-info-2-icon">
                                        <i class="icon-call-end"></i>
                                    </div>
                                    <div class="contact-info-2-content">
                                        <p>Got a question? Call us 24/7</p>
                                        <h3 class="orange">(365) 8635 56-24-02 </h3>
                                    </div>
                                </div>
                                <div class="single-contact-info-2">
                                    <div class="contact-info-2-icon">
                                        <i class="icon-cursor icons"></i>
                                    </div>
                                    <div class="contact-info-2-content">
                                        <p>268 Orchard St, Mahattan, 12005, CA, United State</p>
                                    </div>
                                </div>
                                <div class="single-contact-info-2">
                                    <div class="contact-info-2-icon">
                                        <i class="icon-envelope-open "></i>
                                    </div>
                                    <div class="contact-info-2-content">
                                        <p>contact@norda.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="social-style-1 social-style-1-font-inc social-style-1-mrg-2">
                                <a href="#"><i class="icon-social-twitter"></i></a>
                                <a href="#"><i class="icon-social-facebook"></i></a>
                                <a href="#"><i class="icon-social-instagram"></i></a>
                                <a href="#"><i class="icon-social-youtube"></i></a>
                                <a href="#"><i class="icon-social-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom pt-30 pb-30 ">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-6 col-md-6">
                        <div class="payment-img payment-img-right">
                            <a href="#"><img src="{{asset('assets/front/images/icon-img/payment.png')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="copyright copyright-center">
                            <p>Copyright © 2020 HasThemes | <a href="https://hasthemes.com/">Built with <span>Norda</span> by HasThemes</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>


<script src="{{asset('assets/front/js/front.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>



    $('.add_cart').on('click',function (e) {
        e.preventDefault();

        var id=$(this).data('id');

        $.ajax({
            url: "{{route('cart.add')}}",
            type:'get',
            data:{
                "id":id
            },
            success: function(result){
                 $(".cart-amount").html("$"+result["price"]);
                 $('.pro-count').html(result["total"])


                toastr.success(result["message"]);
            },
            error:function (result) {
                console.log(result);
                toastr.error('SOMETHING IS WRONG');

            }
        });
    });


    $('.delete-cart').on('click',function (e) {
        e.preventDefault();

        var id=$(this).data('id');

        $.ajax({
            url: "{{route('cart.delete')}}",
            type:'get',
            data:{"id":id},
            success: function(result){
                $('.single-product-cart[data-cart='+id+']').remove();
                $(".cart-amount").html("$"+result["price"]);
                $('.pro-count').html(result["total"])
                toastr.success(result["message"]);
            }
        });
    })
</script>

    <script>
        $(".single-ratting-star").on('click',function (e1) {
            e1.preventDefault();
           var rating=$(this).find("a").length;
           $("input[name='rating']").val(rating);
        })
    </script>





@if(session('error_review'))
    <script>
            toastr.error("{{session('error_review')}}");
    </script>
@endif

@if(session('success_review'))
    <script>
        toastr.success("{{session('success_review')}}");
    </script>
@endif

@if(session('success_cart'))
    <script>
        toastr.success("{{session('success_cart')}}");
    </script>
@endif
@if(session('success_order'))
    <script>
        toastr.success("{{session('success_order')}}");
    </script>
@endif
@if(session('error_order'))
    <script>
        toastr.error("{{session('error_order')}}");
    </script>
@endif
</body>

</html>
