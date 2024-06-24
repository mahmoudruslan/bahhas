<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Seeder;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'customer_id' => 1,
            'status' => 1,
            'price' => 1000,
            'order_nr' => "#45632871",
            'paid' => 1,
            'coupon' => null,
        ]);
    }
}
