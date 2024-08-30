<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';
    protected $fillable = [
        'name_en',
        'name_ar',
        'doctor_description',
        'department',
        'image',
        'availability',
    ];
}
