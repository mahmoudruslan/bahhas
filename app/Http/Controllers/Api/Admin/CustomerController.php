<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Traits\Files;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    use GeneralTrait, Files;


    public function update(Request $request)
    {
        try {
            $customer_id = Auth::guard('sanctum')->id();
            $customer = Customer::find($customer_id);
            $validator = Validator::make($request->all(), $this->rules($customer_id));
            if ($validator->fails()) {
                return $this->returnValidationError($validator);
            }
            
            if (!$customer) {
                return $this->returnError('404', 'customer not found');
            }
            $data = $validator->validated();
            if($request->image){
                $this->deleteFiles($customer->image);
                $path = 'images/customers/';
                $image_name = $this->saveImag($path, [$request->image]);
                $data['image'] = $path . $image_name;
            }
            $customer->update($data);
            return $this->returnSuccess('200', __('Data updated successfully'));
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    protected function rules($id = null)
    {
        $rules = [
            'first_name' => 'required|string|max:200',
            'last_name' => 'required|string|max:200',
            'phone' => 'required|numeric|digits_between:6,50',
            'email' => 'required|email|unique:customers,email',
        ];
        if ($id != null) $rules['email'] = 'required|email|unique:customers,email,' . $id;
        return $rules;
    }

    public function destroy()
    {
        try {
            $customer_id = Auth::guard('sanctum')->id();// customer id
            $customer = Customer::find($customer_id);// auth customer
            $this->deleteFiles($customer->image);// delete customer's files
            $customer->tokens()->delete();// delete customer's tokens
            $customer->delete();// delete the customer
            return $this->returnSuccess(200, 'customer deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show()
    {
        try {
            $customer = Auth::guard('sanctum')->user()->only(['first_name','last_name','email','phone','image']);
            return $this->returnData('customer', $customer);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
