<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation Request For User Password Reset
class UserPasswordResetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        // Requirements Of Validation
        return [
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string',
        ];
    }
}
