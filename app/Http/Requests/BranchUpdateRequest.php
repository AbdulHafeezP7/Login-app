<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'branchname_en' => 'required|string|max:255',
            'branchname_ar' => 'required|string|max:255',
            'branchmanager_name' => 'required|string|max:255',
            'branch_location' => 'required|url|max:255',
            'branch_address' => 'required|string',
            'branchsocial_link' => 'required|string|max:255',
            'branchoffice_number' => [
                'required',
                'regex:/^(\+?\d{1,4}[\s-])?(\(?\d{3}\)?[\s-]?)?[\d\s-]{7,15}$/',
                'max:255'
            ],
            'branchmanager_number' => [
                'required',
                'regex:/^(\+?\d{1,4}[\s-])?(\(?\d{3}\)?[\s-]?)?[\d\s-]{7,15}$/',
                'max:255'
            ],
        ];
    }
}


