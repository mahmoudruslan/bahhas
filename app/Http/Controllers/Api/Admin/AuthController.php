<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Notifications\SendVerifyMail;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    use GeneralTrait;
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), $this->loginRules());

            if ($validator->fails()) {
                return $this->returnValidationError($validator);
            }

            $customer  = Customer::where('email', $request->email)->first();
            if ($customer) {
                $old_tokens = $customer->tokens();
                if ($old_tokens) {
                    $old_tokens->delete();
                }
                $customer->createOTPCode();
                $token  = $customer->createToken('auth_token')->plainTextToken;
                $customer->notify(new SendVerifyMail());
                return $this->returnToken('customer', $customer->makeHidden('code'), $token);
            }
            return $this->returnError('500', 'بيانات الدخول غير صحيحة');
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }
    public function logout(Request $request)
    {
        try {
            $customer_id = Auth::guard('sanctum')->id();
            $customer = Customer::findOrFail($customer_id);
            $customer->update([
                'email_verified_at' => null,
            ]);
            $customer->tokens()->delete();

            return $this->returnSuccess('200', __('Signed out successfully'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), $this->registerRules());

            if ($validator->fails()) {
                return $this->returnValidationError($validator);
            }
            //register
            $customer = Customer::create($validator->validated());
            $customer->createOTPCode();

            $token = $customer->createToken('auth_token')->plainTextToken;
            $customer->notify(new SendVerifyMail());
            // $this->saveNotificationToken($request, $customer);
            // return $this->returnSuccess("check your email");
            return $this->returnData('data', [
                'customer'          => $customer,
                'access_token'  => $token,
                'token_type'    => 'Bearer'
            ]);
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }

    public function checkOTPCode(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), ['code' => 'required|string|max:4']);

            if ($validator->fails()) {
                return $this->returnValidationError($validator);
            }
            $customer_id = Auth::guard('sanctum')->id();
            $customer = Customer::findOrFail($customer_id);
            // if (Hash::check($request->code,$customer->code)) {
                if ($request->code === $customer->code) {
                    $at_the_moment = Carbon::createFromFormat('Y-m-d H:i:s', now());
                    $code_expire = Carbon::createFromFormat('Y-m-d H:i:s', $customer->code_expire);
                    $result = $at_the_moment->gte($code_expire);

                    if ($result) {
                        $customer->update([
                            'code' => null,
                            'code_expire' => null,
                        ]);
                        return $this->returnError('403', 'code expire');
                    }
                $customer->update([
                    'email_verified_at' => now(),
                    'code' => null
                ]);
                return $this->returnSuccess("verified successfully");
            }
            return $this->returnError('403', 'error otp code');
            
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }




    public function loginRules()
    {
        $rules = [
            'email' => 'required|string|email',
            // 'password' => 'required|string|max:20',
        ];
        return $rules;
    }

    public function registerRules()
    {
        $rules = [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|numeric|digits_between:6,50|unique:customers',
            'email' => 'required|string|email|unique:customers,email',
            // 'password' => 'required|string|max:200',
        

        ];
        return $rules;
    }
}
