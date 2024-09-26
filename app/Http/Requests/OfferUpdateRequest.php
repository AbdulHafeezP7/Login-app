<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation request for offer update information
class OfferUpdateRequest extends FormRequest
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
        // Validation rules for updating offer information
        return [
            'offer_en' => 'required|string|max:255', // English offer name is required, should be a string, and has a maximum length of 255 characters
            'offer_ar' => 'required|string|max:255', // Arabic offer name is required, should be a string, and has a maximum length of 255 characters
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', // Image is optional; if provided, it must be an image of specified types
            'actual_price' => 'required|string|max:255', // Actual price is required, should be a string, and has a maximum length of 255 characters
            'offer_price' => 'required|string|max:255', // Offer price is required, should be a string, and has a maximum length of 255 characters
        ];
    }
}
