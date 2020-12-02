<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Factory::create();
        for($i=0;$i<400;$i++){
            DB::table('product_tag')->insert(
                [
                    'product_id'=>$faker->numberBetween(Product::all()->first()->id,Product::all()->last()->id),
                    'tag_id'=>$faker->numberBetween(Tag::all()->first()->id,Tag::all()->last()->id)
                ]
            );
        }

    }
}
