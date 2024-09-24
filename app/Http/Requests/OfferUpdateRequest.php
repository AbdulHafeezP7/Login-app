<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Validation Request For Offer Update
class OfferUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        // Requirements Of Validation
        return [
            'offer_en' => 'required|string|max:255',
            'offer_ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'actual_price' => 'required|string|max:255',
            'offer_price' => 'required|string|max:255',
        ];
    }
}
