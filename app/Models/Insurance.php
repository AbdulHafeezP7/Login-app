<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model For Insurance
class Insurance extends Model
{
    use HasFactory;
    // Table Name And Table Items
    protected $table = 'insurances';
    protected $fillable = [
        'insurance_en',
        'insurance_ar',
        'image',
    ];
}
