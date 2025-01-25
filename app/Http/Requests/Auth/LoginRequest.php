<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'password.required' => 'Password is required',
        ];
    }
} 