<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 * @mixin Builder
 */
class Order extends Model
{
    use HasFactory;


    protected $fillable=[
        'total_count','total_price','last_name','first_name','email','phone','address','note','user_id'
    ];

    public static $rules=[
      'last_name'=>'required',
      'first_name'=>'required',
      'email'=>['required','email'],
      'phone'=>'required',
      'address'=>'required',
      'note'=>'nullable'
    ];

    public static $errorMsg=[
        'last_name.required'=>'LAST NAME MUST NOT BE EMPTY',
        'first_name.required'=>'FIRST NAME MUST NOT BE EMPTY',
        'email.required'=>'EMAIL MUST NOT BE EMPTY',
        'email.email'=>'EMAIL IS INVALID',
        'phone.required'=>'PHONE MUST NOT BE EMPTY',
        'address.required'=>'ADDRESS NAME MUST NOT BE EMPTY'
    ];
}
