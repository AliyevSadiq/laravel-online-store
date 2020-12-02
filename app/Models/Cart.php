<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 * @package App\Models
 * @mixin Builder
 */
class Cart extends Model
{
    use HasFactory;


    protected $fillable=['product_id','user_id','price','discount_price','count'];


    public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
