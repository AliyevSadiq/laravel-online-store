<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $folder_image="public/storage/uploads/images/product/gallery/".date('Y-m-d');
        return [
            'product_id'=>$this->faker->numberBetween(Product::all()->first()->id,Product::all()->last()->id),
            'image'=>$this->faker->image($folder_image,'1200','1125','sport',true)
        ];
    }
}
