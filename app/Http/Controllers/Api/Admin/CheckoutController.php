<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Egyjs\Arb\Events\ArbPaymentFailedEvent;
use Egyjs\Arb\Events\ArbPaymentSuccessEvent;
use Illuminate\Http\Request;
use Egyjs\Arb\Facades\Arb;
use Illuminate\Support\Facades\Event;
use Egyjs\Arb\Objects\Card;

class CheckoutController extends Controller
{
    public function redirectToCheckoutPage()
    {

        Arb::card([
            'number' => '4012001037141112',
            'year' => '20'.'27',
            'month' => '12',
            'name' => 'AbdulRahman',
            'cvv' => '212',
            'type' => Card::CREDIT // or Card::DEBIT
         ]);    
         $response = Arb::initiatePayment(100); // 100 to be paid

        // Arb::successUrl('http://localhost:8000/arb/response/success')
        // ->failUrl('http://localhost:8000/arb/response/fail');

        // $response = Arb::initiatePayment(2); // 100 to be paid

        return response()->json(['response' => $response]);
    }
}
