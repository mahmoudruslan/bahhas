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
        return false;
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
            'phone' => 'required|numeric|digits_between:6,50|unique:users',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address_id' => 'required|numeric',
        ];
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $id = Crypt::decrypt($this->route('user'));
            $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'status' => 'nullable',
            'phone' => 'required|numeric|digits_between:6,50|unique:users,mobile,'.$id,
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'required|string|min:8|confirmed',
            'address_id' => 'required|numeric',
            ];
        }

        return $rules;
    }
}
