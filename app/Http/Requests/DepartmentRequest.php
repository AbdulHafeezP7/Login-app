<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'department_en' => 'required|string|max:255',
            'department_ar' => 'required|string|max:255',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department_details' => 'required|string',
            'slug' => 'required|string|unique:departments,slug|max:255',
        ];
    }
}
