<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model For Department
class Department extends Model
{
    use HasFactory;
    // Table Name And Table Items
    protected $table = 'departments';
    protected $fillable = [
        'department_en',
        'department_ar',
        'image',
        'department_details',
        'slug',
        'content_ar'
    ];
}
