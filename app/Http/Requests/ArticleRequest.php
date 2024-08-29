<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NotEmptyHtml;
class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content_en' => ['required', new NotEmptyHtml],
            'content_ar' => ['required', new NotEmptyHtml],
            'slug' => 'required|string|unique:articles,slug|max:255',
        ];
    }
}
