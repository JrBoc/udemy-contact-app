<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'file', 'image', 'mimes:jpeg,png'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function handleRequest()
    {
        $data = $this->only([
            'last_name',
            'first_name',
            'company',
            'bio',
        ]);

        if ($this->has('profile_picture')) {
            $profilePicture = $this->file('profile_picture');
            $profilePicture->move(public_path('upload'), $fileName = user()->id . '.' . $profilePicture->extension());

            $data += [
                'profile_picture' => $fileName,
            ];
        }

        return $data;
    }
}
