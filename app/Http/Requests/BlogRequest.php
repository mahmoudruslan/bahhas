<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'title' => 'required|string|max:5000',
            'description' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'blog_id' => 'nullable|numeric',
        ];
    }
}
