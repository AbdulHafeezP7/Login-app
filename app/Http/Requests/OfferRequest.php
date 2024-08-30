<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'offer_en' => 'required|string|max:255',
            'offer_ar' => 'required|string|max:255',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'actual_price' => 'required|string|max:255',
            'offer_price' => 'required|string|max:255',
        ];
    }
}
