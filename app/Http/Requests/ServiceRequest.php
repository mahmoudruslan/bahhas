<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class ServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'details_ar' => 'required|string|max:500',
            'details_en' => 'required|string|max:500',
            'quantity' => 'required|string|max:50',
            'category_id' => 'required|string|max:50',
            'status' => 'max:1',
            'image' => 'required||mimes:jpeg,png,jpg,gif|max:1024',
            'first_appearing' => 'numeric',
        ];
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            // $id = Crypt::decrypt($this->route('product'));
            $rules = [
                'name_ar' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
                'price' => 'required|string|max:255',
                'details_ar' => 'required|string|max:500',
                'details_en' => 'required|string|max:500',
                'quantity' => 'required|string|max:50',
                'category_id' => 'required|string|max:50',
                'status' => 'max:1',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:1024',
                'first_appearing' => 'numeric',
            ];
        }
        return $rules;
    }

}
