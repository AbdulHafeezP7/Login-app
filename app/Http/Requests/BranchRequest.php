<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'branchname_en' => 'required|string|max:255',
            'branchname_ar' => 'required|string|max:255',
            'branchmanager_name' => 'required|string|max:255',
            'branch_location' => 'required|url|max:255',
            'branch_address' => 'required|string',
            'branchsocial_link' => 'required|string|max:255',
            'branchoffice_number' => 'required|string|max:255',
            'branchmanager_number' => 'required|string|max:255',
        ];
    }
}
