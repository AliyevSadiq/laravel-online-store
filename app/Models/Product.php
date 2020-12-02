<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class Product
 * @package App\Models
 * @mixin Builder
 */
class Product extends Model
{
    use HasFactory;



    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function cart(){
        return $this->hasOne(Cart::class);
    }
    public function discount(){
        return $this->belongsTo(Discount::class);
    }
    public  function tags(){
        return $this->belongsToMany(Tag::class,'product_tag','product_id','tag_id');
    }

    public function galleries(){
        return  $this->hasMany(Gallery::class);
    }
    public function reviews(){
        return  $this->hasMany(Review::class)->where('is_active','=',1);
    }

    protected $fillable=[
        'title','content','seo_description','seo_keyword','thumbnail','image',
        'category_id','discount_id','total_count','views_count','price','tags.*','galleries.*'
    ];


    public static $createRules=[
      'title'=>['required'],
      'content'=>['required'],
      'seo_description'=>['required'],
      'seo_keyword'=>['required'],
      'thumbnail'=>['required','image'],
      'image'=>['required','image'],
      'category_id'=>['required','integer'],
      'total_count'=>['required','integer'],
      'price'=>['required','integer'],
      'tags.*'=>['required','integer'],
      'galleries.*'=>['image'],
    ];

    public static $updateRules=[
        'title'=>['required'],
        'content'=>['required'],
        'seo_description'=>['required'],
        'seo_keyword'=>['required'],
        'thumbnail'=>['image'],
        'image'=>['image'],
        'category_id'=>['required','integer'],
        'total_count'=>['required','integer'],
        'price'=>['required','integer'],
        'tags.*'=>['required','integer'],
        'galleries.*'=>['image'],
    ];


    public static $errorMsg=[
      'title.required'=>'TITLE MUST NOT BE EMPTY',
      'content.required'=>'CONTENT MUST NOT BE EMPTY',
      'seo_description.required'=>'SEO DESCRIPTION MUST NOT BE EMPTY',
      'seo_keyword.required'=>'SEO KEYWORD MUST NOT BE EMPTY',
      'thumbnail.required'=>'THUMBNAIL MUST NOT BE EMPTY',
      'thumbnail.image'=>'THUMBNAIL IS INVALID',
      'image.image'=>'IMAGE IS INVALID',
      'image.required'=>'IMAGE MUST NOT BE EMPTY',
      'category_id.required'=>'CATEGORY MUST NOT BE EMPTY',
      'category_id.integer'=>'CATEGORY MUST BE INTEGER',
      'total_count.integer'=>'TOTAL COUNT MUST BE INTEGER',
      'total_count.required'=>'TOTAL COUNT MUST NOT BE EMPTY',
       'price.integer'=>'PRICE MUST BE INTEGER',
        'price.required'=>'PRICE MUST NOT BE EMPTY',
      'tags.*.required'=>'TAGS MUST NOT BE EMPTY',
      'tags.*.integer'=>'TAGS MUST BE INTEGER',
    ];

   public static function uploadImg($request,$name,$image=null){
       if($request->hasFile($name)){
           if($image){
               Storage::delete($image);
           }
           $folder="product/{$name}/".date("Y-m-d");
           return $request->file($name)->store("uploads/images/{$folder}");
       }
       return null;
   }

    public function setTitleAttribute($value){
        $this->attributes['title']=Str::ucfirst($value);
    }


}
