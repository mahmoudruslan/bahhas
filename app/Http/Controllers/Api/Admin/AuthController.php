<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Traits\GeneralTrait;
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
                return $this->returnValidationError('403', $validator);
            }

            $customer  = Customer::where('phone', $request->phone)->first();
            if ($customer && Hash::check($request->password, $customer->password)) {
                if ($customer->status != 'active') {
                    return  $this->returnError('200', __('Your registration application has not been reviewed'));
                }
                $device_name = $request->post('device_name', $request->userAgent());
                $token = $customer->createToken($device_name);

                $this->saveNotificationToken($request, $customer);

                return $this->returnToken('customer', $customer, $token->plainTextToken);
            }
            return $this->returnError('500', 'بيانات الدخول غير صحيحة');
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }
    public function logout(Request $request)
    {
        try {
            $customer = Auth::guard('sanctum')->user();
            $customer->currentAccessToken()->delete();

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
                return $this->returnValidationError('403', $validator);
            }
            //register
            $customer = Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'other_phone' => $request->other_phone,
                'address' => $request->address,
                'governorate' => $request->governorate,
                'district' => $request->district,
                'activity_type' => $request->activity_type,
                'password' => $request->password,
                'status' => 'not active'
            ]);

            $this->saveNotificationToken($request, $customer);
            return $this->returnSuccess('200', __('Your application will be reviewed'));
        } catch (\Exception $e) {
            return $this->returnError('500', $e->getMessage());
        }
    }


    public function loginRules()
    {
        $rules = [
            'phone' => 'required|numeric',
            'password' => 'required',
            'notification-token' => 'required',            
        ];
        return $rules;
    }

    public function registerRules()
    {
        $rules = [
            'name' => 'required|max:100',
            'phone' => 'required|numeric|digits_between:6,50|unique:customers',
            'other_phone' => 'max:50',
            'address' => 'required|max:200',
            'governorate' => 'required|max:200',
            'district' => 'required|max:200',
            'activity_type' => 'required|max:200',
            'password' => 'required|max:8',
            'notification-token' => 'required',            

        ];
        return $rules;
    }
}
