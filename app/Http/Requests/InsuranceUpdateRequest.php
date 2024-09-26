<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation request for updating insurance information
class InsuranceUpdateRequest extends FormRequest
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
        // Validation rules for updating insurance information
        return [
            'insurance_en' => 'required|string|max:255', // English insurance name is required, should be a string, and has a maximum length of 255 characters
            'insurance_ar' => 'required|string|max:255', // Arabic insurance name is required, should be a string, and has a maximum length of 255 characters
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional; if provided, it must be an image of specified types and a maximum size of 2048 KB
        ];
    }
}
