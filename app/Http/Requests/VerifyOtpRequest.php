<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // must already be authenticated (handled by auth middleware)
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'size:6', 'regex:/^[0-9]+$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Please enter the verification code.',
            'code.size' => 'The code must be 6 digits.',
            'code.regex' => 'The code must contain digits only.',
        ];
    }
}