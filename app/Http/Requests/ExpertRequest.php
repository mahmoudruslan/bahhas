<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpertRequest extends FormRequest
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
      
            $id = $this->route('expert')->id;
            return [
                'full_name' => 'required|string|max:255',
                'specialization' => 'required|string|max:255',
                'degree' => 'required|string|max:255',
                'university' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'text_introduction' => 'required|string|max:5000',
                'phone' => 'required|numeric',
                'email' => 'required|email|unique:experts,email,' . $id,
                'international_bank_number' => 'required|numeric',
                // 'IBAN_certificate' => 'nullable|mimes:pdf|max:1024',
                // 'the_biography' => 'nullable|mimes:pdf|max:1024',
                // 'show_information' => 'required|numeric|max:1',
                // 'publish_achievements' => 'required|numeric|max:1',
                // 'gender' => 'required|numeric|max:1',
                'image' => 'nullable||mimes:jpeg,png,jpg,gif|max:1024',
                'status' => 'nullable|numeric|max:1',
            ];
        
        
    }
}
