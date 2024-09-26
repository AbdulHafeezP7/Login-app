<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model for branches
class Branch extends Model
{
    use HasFactory;

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'branchs';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branchname_en',       // The name of the branch in English
        'branchname_ar',       // The name of the branch in Arabic
        'branchmanager_name',   // The name of the branch manager
        'branch_location',      // The location of the branch
        'branch_address',       // The address of the branch
        'branchsocial_link',    // The social media link for the branch
        'branchoffice_number',  // The office number of the branch
        'branchmanager_number',  // The contact number of the branch manager
    ];
}
