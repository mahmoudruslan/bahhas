<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BhhathRequest extends FormRequest
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
        return [
            'brief_ar' => 'required|string|max:5000',
            'brief_en' => 'required|string|max:5000',
            'facebook_link' => 'required|string',
            'youtube_link' => 'required|string',
            'X_link' => 'required|string|max:500',
            'instagram_link' => 'required|string',
        ];
    }
}
