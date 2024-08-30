<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $fillable = [
        'title_en',
        'title_ar',
        'image',
        'article_en',
        'article_ar',
        'slug',
    ];
}
