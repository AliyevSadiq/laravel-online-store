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
                    <li class="active">Register </li>
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
                                <h4> Register </h4>
                            </a>

                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Username" value="{{old('name')}}">
                                            @error('name')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                            </div>
                                            <div class="form-group">
                                            <input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                                                @error('email')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                                @error('image')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <input type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror">
                                                @error('password')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <input type="password" name="password_confirmation" placeholder="Confirm Password">
                                                @error('password')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                             </div>
                                            <div class="button-box">
                                                <button type="submit">Registration</button>
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
