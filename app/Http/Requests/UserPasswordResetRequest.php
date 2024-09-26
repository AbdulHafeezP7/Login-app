<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation request for user password reset
class UserPasswordResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Allow all users to make this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // Validation rules for resetting user password
        return [
            'password' => 'required|string|min:8|confirmed', // Password is required, must be a string, at least 8 characters long, and confirmed
            'password_confirmation' => 'required|string', // Password confirmation is required and must be a string
        ];
    }
}
