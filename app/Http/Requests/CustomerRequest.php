<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'status' => 'nullable',
            'phone' => 'required|numeric|digits_between:6,50|unique:customers',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
            'email' => 'required|string|email|max:255|unique:customers',
            // 'password' => 'required|string|min:8|confirmed',
            // 'address_id' => 'required|numeric',
        ];
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $id = $this->route('customer');
            $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'status' => 'nullable',
            'phone' => 'required|numeric|digits_between:6,50|unique:customers,phone,'.$id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'email' => 'required|string|email|max:255|unique:customers,email,'.$id,
            // 'password' => 'required|string|min:8|confirmed',
            ];
        }
        return $rules;
    }
}
