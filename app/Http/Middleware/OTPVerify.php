<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OTPVerify
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $customer_id = Auth::guard('sanctum')->id();
        $customer = Customer::find($customer_id);
        // $token = $customer->tokens()->orderBy('id', 'desc')->first()->token;
        // $code = $customer->code;

        if ($customer->email_verified_at == null) {
            return $this->returnError('403', 'must be verified');
        }

    return $next($request);
    }
}
