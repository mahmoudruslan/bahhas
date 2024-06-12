<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title_ar' => 'required|string|max:500',
            'title_en' => 'required|string|max:500',
            'details_ar' => 'required|string|max:1000',
            'details_en' => 'required|string|max:1000',
            'url' => 'required|string|max:1000',
            'status' => 'required|max:1',
            'cover' => 'required||mimes:jpeg,png,jpg,gif|max:1024',
        ];

        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rules = [
            'title_ar' => 'required|string|max:500',
            'title_en' => 'required|string|max:500',
            'url' => 'required|string|max:1000',
            'status' => 'required|max:1',
            'cover' => 'nullable',
            'details_ar' => 'required|string|max:1000',
            'details_en' => 'required|string|max:1000',
            ];
        }
        return $rules;
    }
}
