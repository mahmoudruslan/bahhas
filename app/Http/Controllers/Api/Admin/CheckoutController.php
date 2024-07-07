<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\GeneralTrait;
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
            return $this->returnError(200, __('Cart not found'));
        }
        $total = $cart->total_after_discount;

        Arb::data([
            'customer_id' => $customer->id,
        ]);
        $success_url = Setting::where('key','ARB_REDIRECT_SUCCESS')->first()->value;
        $fail_url = Setting::where('key','ARB_REDIRECT_FAIL')->first()->value;
        Arb::successUrl($success_url)
        ->failUrl($fail_url);
        $response = Arb::initiatePayment($total); // 100 to be paid

        return response()->json(['response' => $response]);
    }

    
}
