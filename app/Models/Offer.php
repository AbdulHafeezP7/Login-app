<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model For Offer
class Offer extends Model
{
    use HasFactory;
    // Table Name And Table Items
    protected $table = 'offers';
    protected $fillable = [
        'offer_en',
        'offer_ar',
        'image',
        'actual_price',
        'offer_price',
    ];
}
