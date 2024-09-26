<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation request for user creation and updates
class UserRequest extends FormRequest
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
        // Validation rules for user data
        return [
            'name' => 'required|string|max:255', // User name is required, must be a string, and cannot exceed 255 characters
            'email' => 'required|string|max:255', // Email is required, must be a string, and cannot exceed 255 characters
            'password' => 'required|string|max:255', // Password is required, must be a string, and cannot exceed 255 characters
            'password_confirmation' => 'required|string|max:255', // Password confirmation is required, must be a string, and cannot exceed 255 characters
        ];
    }
}
