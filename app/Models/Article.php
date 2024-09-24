<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model For Article
class Article extends Model
{
    use HasFactory;
    // Table Name And Table Items
    protected $table = 'articles';
    protected $fillable = [
        'title_en',
        'title_ar',
        'content_en',
        'content_ar',
        'image',
        'slug',
    ];
}
