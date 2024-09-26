<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model for activity logs
class ActivityLog extends Model
{
    use HasFactory;

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'activity_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',     // The ID of the user associated with the activity
        'action',      // The action performed by the user
        'activity',    // Description of the activity
        'agent',       // The agent used for the activity (e.g., web, mobile)
        'ip_address',  // The IP address of the user
    ];
}
