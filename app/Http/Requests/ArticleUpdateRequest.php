<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// Validation request for updating an article
class ArticleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Validation rules for updating an article
        return [
            'title_en' => 'required|string|max:255', // English title is required and should be a string with a maximum length of 255 characters
            'title_ar' => 'required|string|max:255', // Arabic title is required and should be a string with a maximum length of 255 characters
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', // Image is optional but must be an image with specified types if provided
            'slug' => [
                'required', // Slug is required
                'string', // Slug should be a string
                'max:255', // Maximum length for slug is 255 characters
                Rule::unique('articles', 'slug')->ignore($this->route('id')), // Slug must be unique, ignoring the current article being updated
            ],
        ];
    }

    /**
     * Get the validation error messages for the request.
     *
     * @return array
     */
    public function messages()
    {
        // Custom validation messages
        return [
            'slug.unique' => 'The slug must be unique.', // Custom message for slug uniqueness
        ];
    }
}
