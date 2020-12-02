<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Tag
 * @package App\Models
 * @mixin Builder
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable=['title','description','keyword'];

    public static $rules=[
        'title'=>['required'],
        'description'=>['required'],
        'keyword'=>['required'],
    ];
    public static $errorMsg=[
        'title.required'=>'TITLE MUST NOT BE EMPTY',
        'description.required'=>'DESCRIPTION MUST NOT BE EMPTY',
        'keyword.required'=>'KEYWORD MUST NOT BE EMPTY'
    ];

    public function products(){
        return $this->belongsToMany(Product::class,'product_tag','tag_id','product_id');
    }

    public function setTitleAttribute($value){
        $this->attributes['title']=Str::ucfirst($value);
    }
}
