<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation request for adding or updating a doctor
class DoctorRequest extends FormRequest
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
        // Validation rules for adding or updating a doctor
        return [
            'name_en' => 'required|string|max:255', // English name is required, should be a string, and max length of 255 characters
            'name_ar' => 'required|string|max:255', // Arabic name is required, should be a string, and max length of 255 characters
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is required but nullable; if provided, must be an image of specified types and max size of 2048 KB
            'department' => 'required|string', // Department is required and should be a string
        ];
    }
}
