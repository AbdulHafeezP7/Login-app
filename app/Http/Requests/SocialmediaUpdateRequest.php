<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation request for updating social media information
class SocialmediaUpdateRequest extends FormRequest
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
        // Validation rules for updating social media information
        return [
            'socialmedia_url' => 'required|url|max:255', // Social media URL is required, must be a valid URL, and has a maximum length of 255 characters
            'socialmedia_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Social media image is optional; if provided, it must be an image of specified types and no larger than 2048 kilobytes
        ];
    }
}
