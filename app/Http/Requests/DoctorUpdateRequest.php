<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class DoctorUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name_en' => 'required|string|max:255',
            'name_ar' =>'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department' => 'required|string',
        ];
    }
}
