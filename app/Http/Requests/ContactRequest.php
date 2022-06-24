<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['nullable'],
            'address' => ['required', 'string'],
            'company_id' => ['required', 'exists:companies,id'],
        ];
    }

    public function attributes()
    {
        return [
            'company_id' => 'company',
            'email' => 'email address',
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'The email address that you entered is not valid.',
            '*.required' => 'The :attribute field cannot be empty.',
        ];
    }
}
