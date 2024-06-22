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
        dd($request->all());
        try {
            if ($request->result == null) {

                $customer = Customer::find(8);//auth customer
                $cart = $customer->cart;
                $cart_products = $cart->cartProducts;
                // if ($cart && count($cart_products = $cart->cartProducts) > 0) {

                $latestOrder = Order::orderBy('created_at','DESC')->first();

                    $order = Order::Create([ //create order
                        'customer_id' => $customer->id,
                        'status' => true,
                        'paid' => true,
                        'order_nr' => '#'.str_pad($latestOrder->id ?? 0 + 1, 8, rand(1111111, 9999999), STR_PAD_LEFT),
                        'coupon' => $cart->coupon,
                        'price' => $cart->total,
                    ]);
                    foreach ($cart_products as $cart_product) {

                        $product = Product::find($cart_product['product_id']);
                        OrderProduct::create([ //create order products
                            'order_id' => $order->id,
                            'product_id' => $product->id,
                            'name_ar' => $product->name_ar,
                            'name_en' => $product->name_en,
                            'price' => $product->price,
                            'quantity' => $cart_product->quantity,
                            'total' => $cart_product->total,
                            'notes' => $cart_product->notes,
                            'attach' => $cart_product->attach
                        ]);
                    }
                    $cart->delete();
                    $order = Order::with('products')->find($order->id);
                    dd($order);
                    return $this->returnData('order', $order, __('Created Successfully'));
            }
            return $this->returnError('201', __('error in payment'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function cancel($id)
    {
        try {
            $order = DB::table('orders')->find($id);
            if ($order->status == '3' || $order->status == '1') {
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
