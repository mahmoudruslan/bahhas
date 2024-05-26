<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product_ids = Product::pluck('id');
        $customer_ids = Customer::pluck('id');
        return [
            'description' => $this->faker->sentence,
            'product_id' => $product_ids->random(),
            'customer_id' => $customer_ids->random(),
        ];
    }
}
