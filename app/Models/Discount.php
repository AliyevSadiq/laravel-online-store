<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Discount
 * @package App\Models
 * @mixin Builder
 */
class Discount extends Model
{
    use HasFactory;
    protected $fillable=['title','percent','expired_date'];


    public static $rules=[
      'title'=>['required'],
      'percent'=>['required','integer'],
      'expired_date'=>['required'],
    ];
    public static $errorMsg=[
      'title.required'=>'TITLE MUST NOT BE EMPTY',
      'percent.required'=>'PERCENT MUST NOT BE EMPTY',
      'percent.integer'=>'PERCENT MUST BE INTEGER',
      'expired_date.required'=>'EXPIRE DATE MUST NOT BE EMPTY',
    ];
}
