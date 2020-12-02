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
                    <li class="active">my account </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="my-account-wrapper pt-120 pb-120 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if(session('profile_edit'))
                    <div class="alert alert-success">
                        <strong>{{session('profile_edit')}}</strong>
                    </div>
                    @endif
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                        Dashboard</a>
                                    <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>

                                    <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> address</a>
                                    <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>
                                    <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->
                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Dashboard</h3>
                                            <div class="welcome">
                                                <p>Hello, <strong>{{$user->last_name}} {{$user->first_name}}</strong> (If Not <strong>{{$user->name}} !</strong><a href="{{route('logout')}}" class="logout"> Logout</a>)</p>
                                            </div>

                                            <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Orders</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Order</th>
                                                        <th>Date</th>
                                                        <th>Total price</th>
                                                        <th>Total count</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php $i=1; @endphp
                                                    @foreach($orders as $order)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td>{{date("M d, Y",strtotime($order->created_at))}}</td>
                                                        <td>${{$order->total_price}}</td>
                                                        <td>{{$order->total_count}}</td>
                                                    </tr>
                                                    @php $i++; @endphp
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Billing Address</h3>
                                            <address>
                                                <p><strong>{{$user->last_name}} {{$user->first_name}}</strong></p>
                                                <p>{{$user->address}}</p>
                                                <p>Mobile: {{$user->phone}}</p>
                                            </address>

                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Account Details</h3>
                                            <div class="account-details-form">
                                                <form action="{{route('profile.update')}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="first_name" class="required">First Name</label>
                                                                <input type="text" id="first_name" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{$user->first_name}}" />
                                                                @error('first_name')
                                                                <div class="text-danger">{{$message}}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="last_name" class="required">Last Name</label>
                                                                <input type="text" id="last_name" name="last_name" class="form-control @error('first_name') is-invalid @enderror" value="{{$user->last_name}}" />
                                                                @error('first_name')
                                                                <div class="text-danger">{{$message}}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="name" class="required">User Name</label>
                                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}"/>
                                                        @error('name')
                                                        <div class="text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="email" class="required">Email</label>
                                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}"/>
                                                        @error('email')
                                                        <div class="text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="phone" class="required">Phone</label>
                                                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$user->phone}}"/>
                                                        @error('phone')
                                                        <div class="text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>


                                                    <div class="single-input-item">
                                                        <label for="image" class="required">Image</label>
                                                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" />
                                                        @error('image')
                                                        <div class="text-danger">{{$message}}</div>
                                                        @enderror
                                                        <img src="{{asset("storage/".$user->image)}}" width="200" class="img-thumbnail"  alt="">
                                                    </div>

                                                    <div class="single-input-item">
                                                        <label for="address" class="required">Address</label>
                                                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="5">{{$user->address}}</textarea>
                                                        @error('address')
                                                        <div class="text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>


                                                    <fieldset>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="password" class="required">New Password</label>
                                                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"/>
                                                                    @error('password')
                                                                    <div class="text-danger">{{$message}}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="password_confirmation" class="required">New Password</label>
                                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password') is-invalid @enderror"/>
                                                                    @error('password')
                                                                    <div class="text-danger">{{$message}}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item">
                                                        <button class="check-btn sqr-btn ">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- Single Tab Content End -->
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>

@endsection
