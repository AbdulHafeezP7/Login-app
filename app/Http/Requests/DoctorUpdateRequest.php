<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorUpdateRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'doctor_description' => strip_tags($this->doctor_description),
        ]);
    }

    public function rules()
    {
        return [
            'name_en' => [
                'required',
                'regex:/^Dr\.\s.+$/',
                'string',
                'max:255'
            ],
            'name_ar' => [
                'required',
                'regex:/^Dr\.\s.+$/',
                'string',
                'max:255'
            ],
            'doctor_description' => 'required|string|min:1',  // Ensure it is not empty after removing tags
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department' => 'required|string',
        ];
    }
}
