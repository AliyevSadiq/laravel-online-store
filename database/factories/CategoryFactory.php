<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $folder="public/storage/uploads/images/category/".date('Y-m-d');
        return [
            'title'=>$this->faker->word,
            'description'=>$this->faker->paragraph(1),
            'keyword'=>$this->faker->paragraph(1),
            'image'=>$this->faker->image($folder,161,161, 'sport', true),
        ];
    }
}
