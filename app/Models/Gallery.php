<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gallery
 * @package App\Models
 * @mixin Builder
 */
class Gallery extends Model
{
    use HasFactory;

    protected $table='gallery_product';


    protected $fillable=['image','product_id'];


    public function product(){
        return $this->belongsTo(Product::class);
    }
}
