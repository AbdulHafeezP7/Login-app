<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model For Branch
class Branch extends Model
{
    use HasFactory;
    // Table Name And Table Items
    protected $table = 'branchs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'branchname_en',
        'branchname_ar',
        'branchmanager_name',
        'branch_location',
        'branch_address',
        'branchsocial_link',
        'branchoffice_number',
        'branchmanager_number',
    ];
}
