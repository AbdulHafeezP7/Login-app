<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotEmptyHtml implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cleanedValue = strip_tags($value, '<p><br>');
        $cleanedValue = trim(preg_replace('/\s+/', ' ', $cleanedValue));
        if ($cleanedValue === '<p><br></p>' || empty($cleanedValue)) {
            $fail('The :attribute field cannot be empty.');
        }
    }
}
