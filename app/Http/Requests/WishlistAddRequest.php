<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WishlistAddRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'url' => 'nullable|string',
        ];
    }
}