<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {





        $folder="public/storage/uploads/images/slider/".date('Y-m-d');
        return [
            'title'=>$this->faker->word,
            'description'=>$this->faker->paragraph(1),
            'slider_url'=>$this->faker->url,
            'image'=>$this->faker->image($folder,794,438, 'sport', true),
        ];
    }
}
