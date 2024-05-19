<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $orders = Order::pluck('id');
        $products = Product::pluck('id');
        return [
            'order_id' => $orders->random(),
            'product_id' => $id = $products->random(),
            'name' => Product::find($id)->name,
            'price' => $price = Product::find($id)->price,
            'quantity' => $q = rand(1, 4),
            'total' => $q * $price,
        ];
    }
}
