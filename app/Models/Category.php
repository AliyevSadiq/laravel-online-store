<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class Category
 * @package App\Models
 * @mixin Builder
 */
class Category extends Model
{
    use HasFactory;


    protected $fillable=['title','description','keyword','image'];


    public static $createRules=[
        'title'=>['required'],
        'description'=>['required'],
        'keyword'=>['required'],
        'image'=>['required','image'],
    ];
    public static $updateRules=[
        'title'=>['required'],
        'description'=>['required'],
        'keyword'=>['required'],
        'image'=>['image'],
    ];

    public static $errorMsg=[
        'title.required'=>'TITLE MUST NOT BE EMPTY',
        'description.required'=>'DESCRIPTION MUST NOT BE EMPTY',
        'keyword.required'=>'KEYWORD MUST NOT BE EMPTY',
        'image.required'=>'IMAGE MUST NOT BE EMPTY',
        'image.image'=>'THIS IMAGE IS  INVALID',
    ];

    public static function uploadImage($request,$image=null){
        if($request->hasFile('image')){
            if($image){
                Storage::delete($image);
            }
            $folder="category/".date('Y-m-d');
           return $request->file('image')->store("uploads/images/{$folder}");
        }
        return null;
    }

    public function setTitleAttribute($value){
        $this->attributes['title']=Str::ucfirst($value);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }


}
