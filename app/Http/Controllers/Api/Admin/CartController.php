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
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

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
                $cart = $cart->with(['products.product:id,name_'. $lang . ' AS name,details_'. $lang . ' AS details,image,price'])->first();
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
            $customer_id = Auth::guard('sanctum')->id();
            $customer = Customer::find($customer_id);
            // if the cart exists update attach and notes column, else = create new cart
            $cart = $this->createOrUpdateCart($customer);
            // get product for the cart 
            $cart_product = $cart->products->where('cart_id', $cart->id)->where('product_id', $request->product_id)->first();
            // if $cart_product empty = create product for the cart else update quantity
            $this->createOrUpdateCartProduct($cart_product, $cart, $request, $customer);
            return $this->returnSuccess('200', __('Created Successfully'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function deleteProduct(Request $request)
    {
        try {
            $customer_id = Auth::guard('sanctum')->id();
            $customer = Customer::find($customer_id);
            $user_cart = $customer->cart;
            if ($user_cart) {
                $cart_product = $user_cart->Products()->where('product_id', $request->product_id)->first();
                $this->deleteFiles($cart_product->attach);
                $cart_product->delete();
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
            $customer_id = Auth::guard('sanctum')->id();
            $customer = Customer::find($customer_id);
            $cart = $customer->cart;
            $product = $cart->products->where('product_id', $request->product_id)->first();
            if ($product->quantity < 100) {
                $product->update([
                    'quantity' => $product->quantity + 1,
                    'total' => $product->total + $product->product->price,
                ]);
                $cart->update([
                    'total' => $cart->total + $product->product->price,
                ]);
            }
            return $this->returnData(
                'data',[
                    'quantity' => $product->quantity,
                    'product_total' => $product->total,
                    'cart_total' => $cart->total
                ]
            );
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function decrease(Request $request)
    {
        try {
            $customer_id = Auth::guard('sanctum')->id();
            $customer = Customer::find($customer_id);
            $cart = $customer->cart;
            $product = $cart->products->where('product_id', $request->product_id)->first();
            if ($product) {
                if ($product->quantity > 1) {
                    $product->update([
                        'quantity' => $product->quantity - 1,
                        'total' => $product->total - $product->product->price,
                    ]);
                    $cart->update([
                        'total' => $cart->total - $product->product->price,
                    ]);
                }
                return $this->returnData(
                    'data',
                    [
                        'quantity' => $product->quantity,
                        'product_total' => $product->total,
                        'cart_total' => $cart->total
                    ]
                );
            }
            return $this->returnError('500', __('product not found'));
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
        $cart_products = $customer->cart->products;
        $cart->update([
            'total' => count($cart_products) > 1 ? $cart_products->sum('total') : $cart_product->total
        ]);
        return true;
    }
}
