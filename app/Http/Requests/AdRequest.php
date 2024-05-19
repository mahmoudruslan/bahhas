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
    return  [
        'photo' => 'required',
        'target'=> 'required|max:500',
    ];
}
        
    public function messages()
    {
        return [
            'target.max' => __('This is field must be no more than 500 characters'),
            'photo.required' => __('This field is required'),
            'target.required' => __('This field is required'),
        ];
    }
}
