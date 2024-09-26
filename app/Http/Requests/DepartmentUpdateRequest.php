<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// Validation request for updating a department
class DepartmentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Authorization check, returning true for all users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Validation rules for updating a department
        return [
            'department_en' => 'required|string|max:255', // English department name is required and should be a string with a maximum length of 255 characters
            'department_ar' => 'required|string|max:255', // Arabic department name is required and should be a string with a maximum length of 255 characters
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', // Image is optional; if provided, it must be of specific types
            'department_details' => 'required|string', // Department details are required and should be a string
            'slug' => [
                'required', // Slug is required
                'string', // Slug should be a string
                'max:255', // Slug should not exceed 255 characters
                Rule::unique('departments', 'slug')->ignore($this->route('id')), // Slug must be unique, ignoring the current department being updated
            ],
        ];
    }

    /**
     * Get custom validation messages for attributes.
     *
     * @return array
     */
    public function messages()
    {
        // Custom messages for validation
        return [
            'slug.unique' => 'The slug should be unique.', // Custom message for unique slug validation failure
        ];
    }
}
