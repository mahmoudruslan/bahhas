<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Notifications\SendVerifyMail;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    use GeneralTrait;
    public function loginWithEmail(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), $this->emailRule());

            if ($validator->fails()) {
                return $this->returnValidationError($validator);
            }

            $customer  = Customer::where('email', $request->email)->first();
                if (!$customer) {
                    $customer = Customer::create([
                        'email' => $request->email,
                    ]);
                }
                $old_tokens = $customer->tokens();
                if ($old_tokens) {
                    $old_tokens->delete();
                }
                $customer->createOTPCode();
                $token  = $customer->createToken('auth_token')->plainTextToken;
                $customer->notify(new SendVerifyMail());
                return response()->json([
                    
                        'status' => true,
                        'msg' => 'success',
                        'token_type' => 'Bearer',
                        'token' => $token,
                        'customer' => $customer->makeHidden('code')
                    
                ]);
            
            return $this->returnError('203', __('Login data is incorrect'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }
    public function loginWithPhone(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), $this->phoneRule());

            if ($validator->fails()) {
                return $this->returnValidationError($validator);
            }

            $customer  = Customer::where('phone', $request->phone)->first();
            if (!$customer) {
                $customer = Customer::create([
                    'phone' => $request->phone,
                ]);
            }                
            $old_tokens = $customer->tokens();
                if ($old_tokens) {
                    $old_tokens->delete();
                }
                $customer->createOTPCode();
                $token  = $customer->createToken('auth_token')->plainTextToken;
                // send sms
                $http_code = $this->sendVerifySMS($customer->code, $customer->phone);

                return response()->json([
                    
                        'status' => true,
                        'msg' => 'success',
                        'sms_error_number' => $http_code,
                        'token_type' => 'Bearer',
                        'token' => $token,
                        'customer' => $customer->makeHidden('code')

                    
                ]);
            
            return $this->returnError('203', __('Login data is incorrect'));
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

    public function sendVerifySMS($code, $phone)
    {
        $SMS_API_KEY = Config::get('sms.SMS_API_KEY');
        $SMS_USER_SENDER = Config::get('sms.SMS_USER_SENDER');
        $SMS_USER_NAME = Config::get('sms.SMS_USER_NAME');
        $SMS_SEND_URL = Config::get('sms.SMS_SEND_URL');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "{$SMS_SEND_URL}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $fields = <<<EOT
        {
            "userName": "{$SMS_USER_NAME}",
            "numbers": "{$phone}",
            "userSender": "{$SMS_USER_SENDER}",
            "apiKey": "{$SMS_API_KEY}",
            "msg": "{$code}"
        }
            
        EOT;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: *"
        ));

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        // var_dump($info);
        return $info["http_code"];
        // return $response['message'];
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
                        return $this->returnError('403', __('Verify code expired'));
                    }
                $customer->update([
                    'email_verified_at' => now(),
                    'code' => null
                ]);
                return $this->returnSuccess(__("Verified successfully"));
            }
            return $this->returnError('403', __('error in OTP code'));
            
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }




    public function emailRule()
    {
        $rules = [
            'email' => 'required|string|email',
            // 'password' => 'required|string|max:20',
        ];
        return $rules;
    }
    public function phoneRule()
    {
        $rules = [
            'phone' => 'required|numeric|digits_between:6,50',
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
