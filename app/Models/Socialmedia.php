<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model For Socialmedia
class Socialmedia extends Model
{
    use HasFactory;
    // Table Name And Table Items
    protected $table = 'socialmedias';
    protected $fillable = [
        'socialmedia_url',
        'socialmedia_image',
    ];
}
