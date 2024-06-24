<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Seeder;


class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderProduct::create([
            'order_id' => 1,
            'product_id' => 1,
            'price' => 250,
            'name_ar' => "منتج 1",
            'name_en' => "product 1",
            'quantity' => "1",
            'total' => 250,
            'attach' => null,
            'notes' => null,
        ]);
        OrderProduct::create([
            'order_id' => 1,
            'product_id' => 2,
            'price' => 250,
            'name_ar' => "منتج 2",
            'name_en' => "product 2",
            'quantity' => "1",
            'total' => 250,
            'attach' => null,
            'notes' => null,
        ]);
        OrderProduct::create([
            'order_id' => 1,
            'product_id' => 3,
            'price' => 250,
            'name_ar' => "منتج 2",
            'name_en' => "product 2",
            'quantity' => "1",
            'total' => 250,
            'attach' => null,
            'notes' => null,
        ]);
        OrderProduct::create([
            'order_id' => 1,
            'product_id' => 4,
            'price' => 250,
            'name_ar' => "منتج 2",
            'name_en' => "product 4",
            'quantity' => "1",
            'total' => 250,
            'attach' => null,
            'notes' => null,
        ]);
    }
}
