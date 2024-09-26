<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation request for handling article data
class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // Validation rules for article creation/updating
        return [
            'title_en' => 'required|string|max:255', // English title is required and should be a string with max length 255
            'title_ar' => 'required|string|max:255', // Arabic title is required and should be a string with max length 255
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is required, nullable, must be an image, with allowed types and max size
            'slug' => 'required|string|unique:articles,slug|max:255', // Slug is required, should be unique in the articles table, and max length is 255
        ];
    }
}
