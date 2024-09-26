<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation request for branch
class BranchRequest extends FormRequest
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
        // Validation rules for creating or updating a branch
        return [
            'branchname_en' => 'required|string|max:255', // English branch name is required and should be a string with a maximum length of 255 characters
            'branchname_ar' => 'required|string|max:255', // Arabic branch name is required and should be a string with a maximum length of 255 characters
            'branchmanager_name' => 'required|string|max:255', // Branch manager's name is required and should be a string with a maximum length of 255 characters
            'branch_location' => 'required|url|max:255', // Branch location is required, must be a valid URL, and has a maximum length of 255 characters
            'branch_address' => 'required|string', // Branch address is required and should be a string
            'branchsocial_link' => 'required|string|max:255', // Social media link for the branch is required and should be a string with a maximum length of 255 characters
            'branchoffice_number' => 'required|string|max:255', // Branch office number is required and should be a string with a maximum length of 255 characters
            'branchmanager_number' => 'required|string|max:255', // Branch manager's contact number is required and should be a string with a maximum length of 255 characters
        ];
    }
}
