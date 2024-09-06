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
            'tiktok_name' => 'required|string|max:255',
            'tiktok_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'snapchat_name' => 'required|string|max:255',
            'snapchat_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'instagram_name' => 'required|string|max:255',
            'instagram_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook_name' => 'required|string|max:255',
            'facebook_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'youtube_name' => 'required|string|max:255',
            'youtube_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
