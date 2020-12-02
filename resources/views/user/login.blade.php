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
                        <a href="#">Home</a>
                    </li>
                    <li class="active">Login </li>
                </ul>
            </div>
        </div>
    </div>

    <div style="background-color: white">
    <div class="login-register-area pt-115 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="active" data-toggle="tab" href="#lg1">
                                <h4> Login </h4>
                            </a>
                            <a   href="{{route('registerForm')}}">
                                <h4> Register </h4>
                            </a>

                        </div>
                        <div class="tab-content">
                                @if(session('success_auth'))
                                    <div class="alert alert-success">
                                        <strong>{{session('success_auth')}}</strong>
                                    </div>
                                @endif

                                @if(session('error_auth'))
                                    <div class="alert alert-danger">
                                        <strong>{{session('error_auth')}}</strong>
                                    </div>
                                @endif

                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{route('login')}}" method="post" >
                                            @csrf

                                            <div class="form-group">
                                            <input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                                                @error('email')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                            <input type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror">
                                                @error('password')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="button-box">
                                                <button type="submit">Login</button>
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
    </div>
    </div>
@endsection
