<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Seeder;

class OrderPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $orders = Order::whereNull('price')->get();
    
        foreach($orders as $order)
        {
            // $price = OrderProduct::where('order_id', $order->id)->sum('total');

            $order->update([
                // 'price' => $price
            ]);
        }
    }
}
