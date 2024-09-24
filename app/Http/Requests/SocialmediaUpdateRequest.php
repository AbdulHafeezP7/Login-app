<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation Request For Socialmedia Update
class SocialmediaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        // Requirements Of Validation
        return [
            'socialmedia_url' => 'required|url|max:255',
            'socialmedia_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
