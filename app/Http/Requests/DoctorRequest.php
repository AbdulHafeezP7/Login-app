<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NotEmptyHtml;

class DoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function prepareForValidation()
    {
        $this->merge([
            'doctor_description' => strip_tags($this->doctor_description),
        ]);
    }
    public function rules(): array
    {

        return [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'doctor_description' => ['required', new NotEmptyHtml],
            'department' => 'required|string',
        ];
    }
}
