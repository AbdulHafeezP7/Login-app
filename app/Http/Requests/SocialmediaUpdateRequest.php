<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialmediaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'socialmedia_url' => 'required|url|max:255',
            'socialmedia_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
