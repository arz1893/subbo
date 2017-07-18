<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountRequest extends FormRequest
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
        return [
            'bank_name' => 'required',
            'account_number' => 'required|integer|min:0|'
        ];
    }

    public function messages()
    {
        return [
            'bank_name.required' => 'Bank name is required',
            'account_number.required' => 'Account number is required',
            'account_number.number' => 'Account number format is invalid',
            'account_number.max:19' => 'Account number format is invalid'
        ];
    }
}
