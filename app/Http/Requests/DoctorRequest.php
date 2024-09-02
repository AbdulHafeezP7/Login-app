<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
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
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'doctor_description' => 'required|string',
            'department' => 'required|string',
        ];
    }
}
