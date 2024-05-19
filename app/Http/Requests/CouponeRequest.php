<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponeRequest extends FormRequest
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
            'code' => 'required|string|max:255|unique:coupons,code',
            'value' => 'required|string|max:255|numeric',
            'description_en' => 'nullable|string|max:500',
            'description_ar' => 'nullable|string|max:500',
            'use_times' => 'required|string|numeric',
            'used_times' => 'required|string|numeric',
            'start_date' => 'nullable|date|before:expire_date',
            'expire_date' => 'nullable|required_with:start_date|after:start_date|date',
            'greater_than' => 'nullable|numeric',
            'status' => 'max:1',

        ];
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rules = [
                'code' => 'required|string|max:255|unique:coupons,code,'. $this->route()->coupon,
                'value' => 'required|string|max:255',
                'description_en' => 'nullable|string|max:500',
                'description_ar' => 'nullable|string|max:500',
                'use_times' => 'required|string|numeric',
                'used_times' => 'required|string|numeric',
                'start_date' => 'nullable|date|before:expire_date',
                'expire_date' => 'nullable|required_with:start_date|after:start_date|date',
                'greater_than' => 'required|numeric',
                'status' => 'max:1',
            ];
        }

        return $rules;
    }
}
