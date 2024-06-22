<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Egyjs\Arb\Facades\Arb;
use Egyjs\Arb\Events\ArbPaymentFailedEvent;
use Egyjs\Arb\Events\ArbPaymentSuccessEvent;
use Illuminate\Support\Facades\Event;

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
        $total = $cart->total;
        if (isset($request->coupon)) {
            //coupon process
            
            $coupon = Coupon::where('code', $request->coupon)->first();//get coupon
            if (!$coupon || $coupon->status == false) {
                return $this->returnError(200, 'Invalid coupon');
            }
            //check dates
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
            else if(!$cart->total >= $coupon->greater_than)//if low price
            {
                return $this->returnError(200, 'Order price must be greater than ' . $coupon->greater_than);
            }

            $cart->update([
                'coupon' => $request->coupon,
            ]);
            //coupon value %
            $percentage_coupon_value = $coupon->value;
            $coupon_value = $cart->total * ($percentage_coupon_value  /100);//get discount value
            $total = $cart->total - $coupon_value;//Subtract the discount value from the basic total
        }
        Arb::data([
            'customer_id' => $customer->id,
        ]);
    
        Arb::successUrl('http://localhost:8000/api/arb/response')
        ->failUrl('http://localhost:8000/api/arb/response');
        $response = Arb::initiatePayment($total); // 100 to be paid

        return response()->json(['response' => $response]);
    }

    
}
