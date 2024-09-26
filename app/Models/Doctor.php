<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model for doctors
class Doctor extends Model
{
    use HasFactory;

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'doctors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_en',             // The name of the doctor in English
        'name_ar',             // The name of the doctor in Arabic
        'doctor_description',   // A description of the doctor
        'department',           // The department the doctor belongs to
        'image',                // The image associated with the doctor
        'availability',         // The availability status of the doctor
    ];

    /**
     * Get the department associated with the doctor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
