<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        try {
            $customer = auth()->guard('sanctum')->user();
            $cart = $customer->cart;
            if ($cart) {
                $cart_products = $cart->Products->map(function ($row) {
                    $product = Product::find($row->product_id);
                    $row->name = $product->name_ar;
                    $row->details = $product->details_ar;
                    $row->amount = $product->amount;
                    $row->photo = $product->photo;
                    $row->price = $product->price;
                    $row->unit = $product->unit;
                    $row->inner_category_id = $product->inner_category_id;

                    return $row;
                });
                return $this->returnData('cart', $cart_products);
            }
            return $this->returnData('cart', []);
        } catch (\Exception $e) {
            return $this->returnError('500', __('not found'));
        }
    }

    public function store(Request $request)
    {
        try {
            $cart = Cart::updateOrCreate([
                'customer_id' => Auth::guard('sanctum')->user()->id
            ]);
            $product = $cart->products
            ->where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();
            if(empty($product)){
                CartProduct::Create([
                    'cart_id' => $cart->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity
                ]);
            }else{
                $product->update([
                    'quantity' => $product->quantity + 1,
                ]);
            }
            
            return $this->returnSuccess('200', __('Created Successfully'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function deleteProduct(Request $request)
    {
        try {
            $user_cart = auth()->guard('sanctum')->user()->cart;
            $user_cart->Products()->where('product_id', $request->product_id)->delete();
            return $this->returnSuccess('200', __('Deleted Successfully'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function deleteCart()
    {
        try {
            auth()->guard('sanctum')->user()->cart->delete();
            return $this->returnSuccess('200', __('Deleted Successfully'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function increase(Request $request)
    {
        try {
            $customer_cart = auth()->guard('sanctum')->user()->cart;
            $product = $customer_cart->products->where('product_id', $request->product_id)->first();
            $product->update([
                'quantity' => $product->quantity + 1,
            ]);
            return $this->returnData('quantity', $product->quantity);
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function decrease(Request $request)
    {
        try {
            $customer_cart = auth()->guard('sanctum')->user()->cart;
            $product = $customer_cart->products->where('product_id', $request->product_id)->firstOrFail();
            if($product)
            {
                if ($product->quantity > 1) {
                    $product->update([
                        'quantity' => $product->quantity - 1,
                    ]);
                    return $this->returnData('quantity', $product->quantity);
                }
                $product->delete();
                return $this->returnSuccess('200', __('Product removed'));
            }
            return $this->returnSuccess('200', __('Product removed'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }
}
