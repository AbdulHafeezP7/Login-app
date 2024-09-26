<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model for articles
class Article extends Model
{
    use HasFactory;

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_en',    // The title of the article in English
        'title_ar',    // The title of the article in Arabic
        'content_en',  // The content of the article in English
        'content_ar',  // The content of the article in Arabic
        'image',       // The image associated with the article
        'slug',        // The URL-friendly slug for the article
    ];
}
