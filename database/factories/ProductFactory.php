<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\InnerCategory;
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
        $categories = Category::select('id')->get();
        $sub_categories = SubCategory::select('id', 'category_id')->get();
        return [
            'first_appearing' => rand('0', '50'),
            'name_ar' => $this->faker->word,
            'name_en' => $this->faker->word,
            'details_ar' => $this->faker->sentence,
            'details_en' => $this->faker->sentence,
            'quantity' => rand('10', '100'),
            'image' => 'images/products/product.jpg',
            'price' => rand('10', '2000'),
            'category_id' => $category_id = $categories->random()->id,
            'sub_category_id' => 
            Category::find($category_id)->parent->type == 'products'
            ? 
            $sub_categories->where('category_id', $category_id)->random()->id
            : 
            null,
        
        ];
    }
}
