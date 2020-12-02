<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function registerForm(){
        $title='Registration';
        return view('user.register',compact('title'));
    }

    public function register(Request $request){
        $data=$request->all();
        Validator::make($data,User::$registerRules,User::$errorMsg)->validate();
        $data['image']=User::uploadImage($request);
        $data['password']=Hash::make($request->input('password'));
        User::create($data);
        $request->session()->flash('success_auth','USER REGISTERED');
        return redirect()->route('loginForm');
    }

    public function loginForm(){
        $title='Login';
        return view('user.login',compact('title'));
    }

    public function login(Request $request){
        Validator::make($request->all(),User::$loginRules,User::$errorMsg)->validate();

        if(Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
        ])){
            if(Auth::user()->is_admin){
                return redirect()->route('admin.index');
            }
            return redirect()->route('home.index');
        }else{
            $request->session()->flash('error_auth','EMAIL/PASSWORD IS WRONG');
            return redirect()->route('loginForm');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }


    public function profile(){
        $title='PROFILE';
        $user=User::find(auth()->user()->id);
        $orders=Order::where('user_id','=',auth()->user()->id)->get();
        return view('user.profile.index',compact('title','user','orders'));
    }

    public function profileUpdate(Request $request){
        $data=$request->all();
        Validator::make($data,User::$profileEditRules,User::$errorMsg)->validate();
        $user=User::find(auth()->user()->id);


        $data['image']=User::uploadImage($request,$user->image) ? User::uploadImage($request,$user->image) : $user->image;



        $data['password']= $request->input('password') ? Hash::make($request->input('password')) : $user->password;
        $user->update($data);

        $request->session()->flash('profile_edit','PROFILE UPDATED');
        return redirect()->route('profile');

    }
}
