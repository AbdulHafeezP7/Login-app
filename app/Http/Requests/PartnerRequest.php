<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation request for partner information
class PartnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Allow all users to make this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // Validation rules for partner information
        return [
            'partner_en' => 'required|string|max:255', // English partner name is required, must be a string, and has a maximum length of 255 characters
            'partner_ar' => 'required|string|max:255', // Arabic partner name is required, must be a string, and has a maximum length of 255 characters
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is required; if provided, it must be an image of specified types and no larger than 2048 kilobytes
        ];
    }
}
