<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Product;
use App\Traits\Files;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CartController extends Controller
{
    use GeneralTrait, Files;
    public function getCart()
    {
        try {
            $lang = app()->getLocale();
            $customer_id = Auth::guard('sanctum')->id();
            $customer = Customer::find($customer_id);

            $cart = $customer->cart;

            if ($cart) {
                $new_cart = Cart::with(['cartProducts.product:id,name_' . $lang . ' AS name,details_' . $lang . ' AS details,image,price'])->find($cart->id);
                return $this->returnData('cart', $new_cart);
            }
            return $this->returnData('cart', []);
        } catch (\Exception $e) {
            return $this->returnError('500', __('not found'));
        }
    }

    public function store(Request $request)
    {
        try {
            $customer_id = Auth::guard('sanctum')->id();
            $customer = Customer::find($customer_id);
            // if the cart exists update attach and notes column, else = create new cart
            $cart = $this->createOrUpdateCart($customer);
            // get product for the cart 
            $cart_product = $cart->cartProducts->where('cart_id', $cart->id)->where('product_id', $request->product_id)->first();
            // if $cart_product empty = create product for the cart else update quantity
            $this->createOrUpdateCartProduct($cart_product, $cart, $request, $customer);
            return $this->returnSuccess('200', __('Data saved successfully'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function addCoupon(Request $request)
    {
        //coupon process
        $customer_id = Auth::guard('sanctum')->id();
        $customer = Customer::find($customer_id);
        $cart = $customer->cart;
        //check if cart exists
        if ($cart) {
            $coupon = Coupon::where('code', $request->coupon)->first(); //get coupon
            if (!$coupon || $coupon->status == false) {
                return $this->returnError(200, 'Invalid coupon');
            }
            //check dates
            $at_the_moment = Carbon::createFromFormat('Y-m-d H:i:s', now());
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->start_date);
            $expire_date = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->expire_date);
            $expire = $at_the_moment->gte($expire_date);
            $the_future = $start_date->gte($at_the_moment);
            if ($expire || $coupon->used_times >= $coupon->use_times) {
                return $this->returnError(200, 'Coupon has expired');
            } else if ($the_future) {
                return $this->returnError(200, 'Coupon is not active yet');
            } else if (!$cart->total >= $coupon->greater_than) //if low price
            {
                return $this->returnError(200, 'Order price must be greater than ' . $coupon->greater_than);
            }
            //coupon value %
            $percentage_coupon_value = $coupon->value;
            $coupon_value = $cart->total * ($percentage_coupon_value  / 100); //get discount value
            $total = $cart->total - $coupon_value; //Subtract the discount value from the basic total
            //update the cart
            $cart->update([
                'coupon' => $request->coupon,
                'total_after_discount' => round($total),
            ]);
            return $this->returnSuccess(200, __('Coupon added successfully'));
        }

        return $this->returnError(200, __('Cart not found'));
    }
    public function deleteProduct(Request $request)
    {
        try {
            $customer_id = Auth::guard('sanctum')->id();
            $customer = Customer::find($customer_id);
            $user_cart = $customer->cart;
            if ($user_cart) {
                $cart_product = $user_cart->cartProducts()->where('product_id', $request->product_id)->first();
                $this->deleteFiles($cart_product->attach);
                $cart_product->delete();
            }
            if (!count($user_cart->cartProducts) > 0) {
                $user_cart->delete();
            }
            return $this->returnSuccess('200', __('Data deleted successfully'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function increase(Request $request)
    {
        try {
            $customer_id = Auth::guard('sanctum')->id();
            $customer = Customer::find($customer_id);
            $cart = $customer->cart;
            $product = $cart->cartProducts->where('product_id', $request->product_id)->first();
            if ($product) {
                if ($product->quantity < 100) {
                    $product->update([
                        'quantity' => $product->quantity + 1,
                        'total' => $product->total + $product->product->price,
                    ]);
                    $cart->update([
                        'total' => $total = $cart->total + $product->product->price,
                        'total_after_discount' => $total,
                        'coupon' => null,
                    ]);
                }
                return $this->returnData(
                    'data',
                    [
                        'quantity' => $product->quantity,
                        'product_total' => $product->total,
                        'cart_total' => $cart->total,
                        'cart_total_after_discount' => $cart->total_after_discount
                    ]
                );
            }
            return $this->returnError(200, __('The product is not in the cart'));
            
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function decrease(Request $request)
    {
        try {
            $customer_id = Auth::guard('sanctum')->id();
            $customer = Customer::findOrFail($customer_id);
            $cart = $customer->cart;
            $product = $cart->cartProducts->where('product_id', $request->product_id)->first();
            if ($product) {
                if ($product->quantity > 1) {
                    $product->update([
                        'quantity' => $product->quantity - 1,
                        'total' => $product->total - $product->product->price,
                    ]);
                    $cart->update([
                        'total' => $total = $cart->total - $product->product->price,
                        'total_after_discount' => $total,
                        'coupon' => null,
                    ]);
                }
                return $this->returnData(
                    'data',
                    [
                        'quantity' => $product->quantity,
                        'product_total' => $product->total,
                        'cart_total' => $cart->total,
                        'cart_total_after_discount' => $cart->total_after_discount
                    ]
                );
            }
            return $this->returnError(200, __('The product is not in the cart'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    private function createOrUpdateCart($customer)
    {
        $cart = Cart::updateOrCreate([
            'customer_id' => $customer->id,
        ]);
        return $cart;
    }

    private function createOrUpdateCartProduct($cart_product, $cart, $request, $customer)
    {
        $product = Product::findOrFail($request->product_id);
        $attach_name = null;
        if ($request->attach) {
            $path = 'images/orders/';
            $attach_name = $this->saveImag($path, [$request->attach]);
            $attach_name = $path . $attach_name;
        }
        if (empty($cart_product)) {
            $cart_product = CartProduct::Create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'total' => $product->price * $request->quantity,
                'notes' => $request->notes,
                'attach' => $attach_name,
            ]);
        } else {
            $this->deleteFiles($cart_product->attach);
            $cart_product->update([
                'quantity' => $quantity = $cart_product->quantity + 1,
                'total' => $product->price * $quantity,
                'notes' => $request->notes,
                'attach' => $attach_name,
            ]);
        }
        $cart_products = $customer->cart->cartProducts;
        $cart->update([
            'total' => $total = count($cart_products) > 1 ? $cart_products->sum('total') : $cart_product->total,
            'total_after_discount' => $total,
            'coupon' => null
        ]);
        return true;
    }
}
