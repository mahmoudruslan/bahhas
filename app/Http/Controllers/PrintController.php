<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PrintController extends Controller
{

    public function printOrders()
    {
        $orders = Order::all();
        return view('admin.orders.orders_print')->with('orders', $orders);
    }
}
