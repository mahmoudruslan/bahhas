<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Validator;


class CustomerController extends Controller
{
    use GeneralTrait;
    public function update(Request $request, $id)
    {
        try {
            

            $validator = Validator::make($request->all(), $this->rules());
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $user = Customer::find($id);
            if (!$user) {
                return $this->returnError('404', 'user not found');
            }
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'other_phone' => $request->other_phone,
                'address' => $request->address,
                'governorate' => $request->governorate,
                'district' => $request->district,
                'activity_type' => $request->activity_type,
                'password' => $request->password,
            ]);
            return $this->returnSuccess('200', __('Updated Successfully'));
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    protected function rules()
    {
        $rules = [
            'name' => 'required|max:200',
            'phone' => 'required|numeric|digits_between:6,50',
            'other_phone'=> 'min:6|max:50',
            'address' => 'required|max:200',
            'governorate' => 'required|max:200',
            'district' => 'required|max:200',
            'activity_type' => 'required|max:200',
            'password'=> 'required|max:8',
        ];
        return $rules;
    }
}
