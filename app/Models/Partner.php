<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model For Partner
class Partner extends Model
{
    use HasFactory;
    // Table Name And Table Items
    protected $table = 'partners';
    protected $fillable = [
        'partner_en',
        'partner_ar',
        'image',
    ];
}
