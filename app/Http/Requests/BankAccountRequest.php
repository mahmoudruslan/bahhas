<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'owner' => 'required|string|max:255',
            'IBAN_number' => 'required|numeric|digits_between:6,100|unique:bank_accounts',
            'number' => 'required|numeric|digits_between:6,100|unique:bank_accounts',
        ];
    }
}
