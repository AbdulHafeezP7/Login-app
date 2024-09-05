<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'article_en' => strip_tags($this->article_en),
            'article_ar' => strip_tags($this->article_ar),
        ]);
    }
    public function rules()
    {
        return [
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'article_en' => 'required|string',
            'article_ar' => 'required|string',
            'slug' => 'required|string|max:255|unique:articles,slug,' . $this->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
