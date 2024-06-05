<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categories = Category::where('type', 'product')->pluck('id');
        return [
            'name_ar' => $this->faker->word,
            'name_en' => $this->faker->word,
            'category_id' => $categories->random(),
            'cover' => 'cover.jpg',
        ];
    }
}
