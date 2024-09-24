<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model For Doctor
class Doctor extends Model
{
    use HasFactory;
    // Table Name And Table Items
    protected $table = 'doctors';
    protected $fillable = [
        'name_en',
        'name_ar',
        'doctor_description',
        'department',
        'image',
        'availability',
    ];
    // Connecting Department Table Item With Doctor
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
