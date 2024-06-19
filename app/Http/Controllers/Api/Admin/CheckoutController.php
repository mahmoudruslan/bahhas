<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Egyjs\Arb\Events\ArbPaymentFailedEvent;
use Egyjs\Arb\Events\ArbPaymentSuccessEvent;
use Illuminate\Http\Request;
use Egyjs\Arb\Facades\Arb;
use Illuminate\Support\Facades\Event;
use Egyjs\Arb\Objects\Card;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    use GeneralTrait;
    public function redirectToCheckoutPage()
    {

        $customer = Auth::guard('sanctum')->user();
        $cart = $customer->cart;
        if (!$cart) {
            return $this->returnError(200, 'Cart is empty');
        }

        $cart_total = $customer->cart->total;
        Arb::successUrl('http://localhost:8000/arb/response')
    ->failUrl('http://localhost:8000/arb/response');
        $response = Arb::initiatePayment($cart_total); // 100 to be paid

        return response()->json(['response' => $response]);
    }
}
