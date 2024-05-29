<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string|max:5000',
            'description_en' => 'required|string|max:5000',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:1024',
            'blog_id' => 'nullable|numeric',
        ];
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rules = [
                'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string|max:5000',
            'description_en' => 'required|string|max:5000',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:1024',
            'blog_id' => 'nullable|numeric',
            ];
        }
        return $rules;
    }
}
