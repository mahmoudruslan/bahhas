<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ParentCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        // $parent_ids = ParentCategory::pluck('id');
        return [
            'name_ar' => $this->faker->word,
            'name_en' => $this->faker->word,
            'cover' => 'category.jpg',
            'type' => 'products'
            // 'parent_category_id' => $parent_ids->random()
        ];
    }
}
