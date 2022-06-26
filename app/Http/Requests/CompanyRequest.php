<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'website' => ['required', 'string'],
            'address' => ['required', 'string'],
        ];
    }

    public function authorize()
    {
        return auth()->check();
    }

    public function attributes()
    {
        return [
            'email' => 'email address',
        ];
    }
}
