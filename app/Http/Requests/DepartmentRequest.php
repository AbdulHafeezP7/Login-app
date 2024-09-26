<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation request for department
class DepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Authorization check, returning true for all users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // Validation rules for creating a department
        return [
            'department_en' => 'required|string|max:255', // English department name is required and should be a string with a maximum length of 255 characters
            'department_ar' => 'required|string|max:255', // Arabic department name is required and should be a string with a maximum length of 255 characters
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is required, should be of specific types, and must not exceed 2048 KB
            'department_details' => 'required|string', // Department details are required and should be a string
            'slug' => 'required|string|unique:departments,slug|max:255', // Slug is required, must be unique within the departments table, and should not exceed 255 characters
        ];
    }
}
