<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;

class ParentCategoryRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'cover' => 'required',
        ];

        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rules = [
                'name_ar' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
            ];
        }
        return $rules;
    }
}
