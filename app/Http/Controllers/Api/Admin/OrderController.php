<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use GeneralTrait;
    public function show(Request $request)
    {
        try {
            $orders = Order::where('customer_id', Auth::guard('sanctum')->user()->id)->with('productDetails')->get();
            return $this->returnData('orders', $orders, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $price = 0;
            $customer = Auth::guard('sanctum')->user();
            $cart = $customer->cart;
            if ($cart) {
                $cart_products = $cart->products;
                foreach ($cart_products as $item) {
                    $product = Product::find($item['product_id']);
                    $price += $product->price * $item['quantity'];
                }
                $order = Order::Create([ //create order
                    'customer_id' => $customer->id,
                    'status' => '3',
                    'notes' => $request->notes,
                    'price' => $price
                ]);

                foreach ($cart_products as $item) {
                    $product = Product::find($item['product_id']);
                    
                    OrderProduct::create([ //create order products
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'name' => $product->name_ar,
                        'price' => $product->price,
                        'quantity' => $item['quantity'],
                        'total' => $product->price * $item['quantity'],
                    ]);
                }
                $cart->delete();
                return $this->returnData('order_id',$order->id , __('Created Successfully'));
            }
            return $this->returnError('201', __('Cart not found'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function cancel($id)
    {
        try {
            $order = DB::table('orders')->find($id);
            if($order->status == '3' || $order->status == '1')
            {
                $order = DB::table('orders')->where('id', $id)->update([
                    'status' => '1'
                ]);
                return $this->returnSuccess('200', __('Canceled Successfully'));
            }
            return $this->returnError('201', __('The order cannot be cancelled'));
        } catch (\Exception $e) {
            return $this->returnError('404', 'not found');
        }
    }
}
