<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Rennokki\QueryCache\Traits\QueryCacheable;

/**
 * Class Slider
 * @package App\Models
 * @mixin Builder
 */
class Slider extends Model
{
    use HasFactory;
    use QueryCacheable;


    protected $fillable=['title','description','slider_url','image'];


    public static $createRules=[
        'title'=>['required'],
        'description'=>['required'],
        'slider_url'=>['required'],
        'image'=>['required','image'],
    ];
    public static $updateRules=[
        'title'=>['required'],
        'description'=>['required'],
        'slider_url'=>['required'],
        'image'=>['image'],
    ];

    public static $errorMsg=[
      'title.required'=>'TITLE MUST NOT BE EMPTY',
      'description.required'=>'DESCRIPTION MUST NOT BE EMPTY',
      'slider_url.required'=>'URL MUST NOT BE EMPTY',
      'image.required'=>'IMAGE MUST NOT BE EMPTY',
      'image.image'=>'THIS IMAGE IS  INVALID',
    ];

    public static function uploadImage($request,$image=null){
        if($request->hasFile('image')){

            if($image){
                Storage::delete($image);
            }

            $folder="slider/".date('Y-m-d');
            return  $request->file('image')->store("uploads/images/{$folder}");
        }
        return null;
    }

}
