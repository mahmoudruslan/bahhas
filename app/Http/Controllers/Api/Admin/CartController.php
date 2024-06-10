<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Customer;
use App\Models\Product;
use App\Traits\Files;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;


use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    use GeneralTrait, Files;
    public function getCart($customer_id)
    {
        try {
            $customer = Customer::findOrFail($customer_id);

            $cart = $customer->cart;

            if ($cart) {
                $cart = $cart->with(['products.product'])->first();
                return $this->returnData('cart', $cart);
            }
            return $this->returnData('cart', []);
        } catch (\Exception $e) {
            return $this->returnError('500', __('not found'));
        }
    }

    public function store(Request $request)
    {
        try {
            // if the cart exists update attach and notes column, else = create new cart
            $cart = $this->createOrUpdateCart($request);
            // get product for the cart 
            $cart_product = $cart->products->where('cart_id', $cart->id)->where('product_id', $request->product_id)->first();
            // if $cart_product empty = create product for the cart else update quantity
            $this->createOrUpdateCartProduct($cart_product, $cart, $request);
            return $this->returnSuccess('200', __('Created Successfully'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function deleteProduct(Request $request)
    {
        try {
            $user_cart = Customer::find($request->customer_id)->cart;
            if ($user_cart) {
                $user_cart->Products()->where('product_id', $request->product_id)->delete();
            }
            if (!count($user_cart->products) > 0) {
                $user_cart->delete();
            }
            return $this->returnSuccess('200', __('Deleted Successfully'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function increase(Request $request)
    {
        try {
            $customer_cart = Customer::findOrFail($request->customer_id)->cart;
            $product = $customer_cart->products->where('product_id', $request->product_id)->first();
            if ($product->quantity < 100) {
                $product->update([
                    'quantity' => $product->quantity + 1,
                    'total' => $product->total + $product->product->price,
                ]);
            }
            return $this->returnData(
                'data',[
                    'quantity' => $product->quantity,
                    'total' => $product->total
                ]
            );
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function decrease(Request $request)
    {

        try {
            $customer_cart = Customer::findOrFail($request->customer_id)->cart;
            $product = $customer_cart->products->where('product_id', $request->product_id)->first();
            if ($product) {
                if ($product->quantity > 1) {
                    $product->update([
                        'quantity' => $product->quantity - 1,
                        'total' => $product->total - $product->product->price,
                    ]);
                    
                }
                return $this->returnData(
                    'data',
                    [
                        'quantity' => $product->quantity,
                        'total' => $product->total
                    ]
                );
            }
            return $this->returnError('500', __('product not found'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    private function createOrUpdateCart($request)
    {
        $customer = Customer::findOrFail($request->customer_id);
        $cart = $customer->cart;
        $attach_name = null;
        if ($request->attach) {
            $path = 'images/orders/';
            $attach_name = $this->saveImag($path, [$request->attach]);
            $attach_name = $path . $attach_name;
        }
        if ($cart) {
            $this->deleteFiles($cart->attach); //delete old attach
            $cart->update([
                'attach' => $attach_name,
                'notes' => $request->notes ?? null
            ]);
        } else {
            $cart = Cart::create([
                'customer_id' => $request->customer_id,
                'attach' => $attach_name,
                'notes' => $request->notes ?? null
            ]);
        }
        return $cart;
    }

    private function createOrUpdateCartProduct($cart_product, $cart, $request)
    {
        $product = Product::findOrFail($request->product_id);
        if (empty($cart_product)) {
            $cart_product = CartProduct::Create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'total' => $product->price * $request->quantity
            ]);
            
        } else {

            $cart_product->update([
                'quantity' => $quantity = $cart_product->quantity + 1,
                'total' => $product->price * $quantity
            ]);
        }
        $cart->update([
            'total' => count($cart->products) > 1 ? $cart->products->sum('total') : $cart_product->total
        ]);
        return true;
    }
}
