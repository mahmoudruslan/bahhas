<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Egyjs\Arb\Facades\Arb;

use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    use GeneralTrait;
    public function redirectToCheckoutPage(Request $request)
    {

        $customer = Auth::guard('sanctum')->user();
        $cart = $customer->cart;


        if (!$cart) {
            return $this->returnError(200, 'Cart is empty');
        }
        if (isset($request->coupon)) {
            
            
            $coupon = Coupon::where('code', $request->coupon)->first();
            if (!$coupon || $coupon->status == false) {
                return $this->returnError(200, 'Invalid coupon');
            }
            $at_the_moment = Carbon::createFromFormat('Y-m-d H:i:s', now());
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->start_date);
            $expire_date = Carbon::createFromFormat('Y-m-d H:i:s', $coupon->expire_date);
            $expire = $at_the_moment->gte($expire_date);
            $the_future = $start_date->gte($at_the_moment);
            if ($expire || $coupon->used_times >= $coupon->use_times ) {
                return $this->returnError(200, 'Coupon has expired');
            }
            else if($the_future)
            {
                return $this->returnError(200, 'Coupon is not active yet');
            }
            else if(!$cart->total >= $coupon->greater_than)
            {
                return $this->returnError(200, 'Order price must be greater than ' . $coupon->greater_than);
            }

            $percentage_coupon_value = $coupon->value;
            $coupon_value = $cart->total * ($percentage_coupon_value  /100);

            $total_after_coupon = $cart->total - $coupon_value;
            
            $cart->update([
                'coupon' => $request->coupon ?? null,
                // 'total' => $total_after_coupon
            ]);
        }
        
        $cart_total = $customer->cart->total;
        Arb::successUrl('http://localhost:8000/arb/response')
    ->failUrl('http://localhost:8000/arb/response');
        $response = Arb::initiatePayment($cart_total); // 100 to be paid

        return response()->json(['response' => $response]);
    }
}
