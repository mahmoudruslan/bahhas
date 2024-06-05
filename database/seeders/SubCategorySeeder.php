<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = Factory::create();
        $categories = Category::where('type', 'product')->get('id');

        foreach($categories as $category)
        {
            for ($i = 0; $i < 5; $i++) { 
                SubCategory::create([
                    'name_ar' => $faker->word,
                    'name_en' => $faker->word,
                    'category_id' => $category->id,
                    'cover' => 'images/sub-categories/cover.jpg',
                    ]);
            }

        }
        // SubCategory::factory()->count(10)->create();
    }
}
