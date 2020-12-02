<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $folder_thumbnail="public/storage/uploads/images/product/thumbnail/".date('Y-m-d');
        $folder_image="public/storage/uploads/images/product/image/".date('Y-m-d');
        return [
            'title'=>$this->faker->word,
            'content'=>$this->faker->paragraph(10),
            'seo_description'=>$this->faker->paragraph(1),
            'seo_keyword'=>$this->faker->paragraph(1),
            'thumbnail'=>$this->faker->image($folder_thumbnail,'210','210','sport',true),
            'image'=>$this->faker->image($folder_image,'1200','1125','sport',true),
            'category_id'=>$this->faker->numberBetween(Category::all()->first()->id,Category::all()->last()->id),
            'total_count'=>$this->faker->numberBetween(120,200),
            'price'=>$this->faker->numberBetween(400,1200)
        ];
    }
}
