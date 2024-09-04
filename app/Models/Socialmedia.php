<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socialmedia extends Model
{
    use HasFactory;
    protected $table = 'socialmedias';
    protected $fillable = [
        'tiktok_name',
        'tiktok_image',
        'snapchat_name',
        'snapchat_image',
        'instagram_name',
        'instagram_image',
        'facebook_name',
        'facebook_image',
        'youtube_name',
        'youtube_image',
    ];
}
