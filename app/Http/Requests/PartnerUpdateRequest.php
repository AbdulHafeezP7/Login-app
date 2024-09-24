<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation Request For Partner Update
class PartnerUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        // Requirements Of Validation
        return [
            'partner_en' => 'required|string|max:255',
            'partner_ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
