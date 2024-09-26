<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation request for updating a doctor's information
class DoctorUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Validation rules for updating a doctor
        return [
            'name_en' => 'required|string|max:255', // English name is required, should be a string, and has a maximum length of 255 characters
            'name_ar' => 'required|string|max:255', // Arabic name is required, should be a string, and has a maximum length of 255 characters
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional; if provided, it must be an image of specified types and a maximum size of 2048 KB
            'department' => 'required|string', // Department is required and should be a string
        ];
    }
}
