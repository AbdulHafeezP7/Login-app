<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model for offer
class Offer extends Model
{
    use HasFactory;

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'offers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offer_en',      // The name of the offer in English
        'offer_ar',      // The name of the offer in Arabic
        'image',         // The image associated with the offer
        'actual_price',  // The actual price of the offer
        'offer_price',   // The discounted price of the offer
    ];
}
