<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model for departments
class Department extends Model
{
    use HasFactory;

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_en',        // The name of the department in English
        'department_ar',        // The name of the department in Arabic
        'image',                // The image associated with the department
        'department_details',    // Additional details about the department
        'slug',                 // The URL-friendly identifier for the department
        'content_ar',           // Arabic content related to the department
    ];
}
