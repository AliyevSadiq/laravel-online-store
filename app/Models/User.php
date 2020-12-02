<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

/**
 * Class User
 * @package App\Models
 * @mixin Builder
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'last_name',
        'first_name',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $registerRules=[
        'name'=>['required','unique:users'],
        'email'=>['required','unique:users','email'],
        'image'=>['required','image'],
        'password'=>['required','confirmed']
    ];

    public static $loginRules=[
        'password'=>['required'],
        'email'=>['required','email'],
    ];

    public static $profileEditRules=[
        'name'=>['required'],
        'last_name'=>['required'],
        'first_name'=>['required'],
        'phone'=>['required'],
        'address'=>['required'],
        'email'=>['required','email'],
        'image'=>['nullable','image'],
        'password'=>['confirmed'],
    ];


    public static $errorMsg=[
        'name.required'=>'NAME MUST NOT BE EMPTY',
        'name.unique'=>'NAME MUST BE SAME',
        'email.required'=>'EMAIL MUST NOT BE EMPTY',
        'email.unique'=>'EMAIL MUST BE SAME',
        'email.email'=>'EMAIL IS INVALID',
        'image.required'=>'IMAGE MUST NOT BE EMPTY',
        'password.required'=>'PASSWORD MUST NOT BE EMPTY',
        'password.confirmed'=>'PASSWORD MUST BE SAME',
        'last_name.required'=>'LAST NAME MUST NOT BE EMPTY',
        'first_name.required'=>'FIRST NAME MUST NOT BE EMPTY',
        'phone.required'=>'PHONE MUST NOT BE EMPTY',
        'address.required'=>'ADDRESS MUST NOT BE EMPTY',
    ];


    public static function uploadImage($request,$image=null){
        if($request->hasFile('image')){
            if($image){
                Storage::delete($image);
            }
                    $folder="user/".date("Y-m-d");
            return  $request->file('image')->store("uploads/images/{$folder}");
        }
        return null;
    }
}
