<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;


class CategoryRequest extends FormRequest
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
            'parent_category_id' => 'required|numeric',
            'cover' => 'required',
        ];

        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rules = [
                'name_ar' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
                'parent_category_id' => 'required|numeric',
                'cover' => 'nullable',
            ];
        }
        return $rules;
    }

}
