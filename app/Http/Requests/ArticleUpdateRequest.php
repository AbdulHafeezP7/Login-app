<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('articles', 'slug')->ignore($this->route('id')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => 'The slug should be unique.',
        ];
    }
}

