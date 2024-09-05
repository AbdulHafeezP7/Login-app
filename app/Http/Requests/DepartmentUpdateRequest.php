<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'department_en' => 'required|string|max:255',
            'department_ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'department_details' => 'required|string',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'slug')->ignore($this->route('id')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => 'The slug should be unique.',
        ];
    }
}

