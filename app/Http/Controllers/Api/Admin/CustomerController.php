<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Traits\Files;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    use GeneralTrait, Files;

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), $this->rules());
            if ($validator->fails()) {
                return $this->returnValidationError($validator);
            }
            Customer::create($validator->validated());
            return $this->returnSuccess('200', __('Updated Successfully'));
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {

            $validator = Validator::make($request->all(), $this->rules($id));
            if ($validator->fails()) {
                return $this->returnValidationError($validator);
            }
            $customer = Customer::find($id);
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
            return $this->returnSuccess('200', __('Updated Successfully'));
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

    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $this->deleteFiles($customer->image);
            $customer->delete();
            return $this->returnSuccess(200, 'customer deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
