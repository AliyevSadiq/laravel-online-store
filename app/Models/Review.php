<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 * @package App\Models
 * @mixin Builder
 */
class Review extends Model
{
    use HasFactory;



    protected $fillable=['name','email','message','user_id','product_id','is_active','rating'];


    public static $createRules=[
        'name'=>['required'],
        'email'=>['required','email'],
        'message'=>['required'],
        'rating'=>['required','integer'],
    ];
    public static $errorMsg=[
        'name.required'=>'NAME MUST NOT BE EMPTY',
        'email.required'=>'EMAIL MUST NOT BE EMPTY',
        'email.email'=>'EMAIL IS INVALID',
        'message.required'=>'MESSAGE MUST NOT BE EMPTY',
        'rating.required'=>'RATING MUST NOT BE EMPTY',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
