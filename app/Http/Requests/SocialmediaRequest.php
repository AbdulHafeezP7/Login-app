<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation request for social media information
class SocialmediaRequest extends FormRequest
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
        // Validation rules for social media information
        return [
            'socialmedia_url' => 'required|url|max:255', // Social media URL is required, must be a valid URL, and has a maximum length of 255 characters
            'socialmedia_image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Social media image is required; if provided, it must be an image of specified types and no larger than 2048 kilobytes
        ];
    }
}
