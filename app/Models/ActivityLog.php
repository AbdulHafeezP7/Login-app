<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model For ActivityLog
class ActivityLog extends Model
{
    use HasFactory;
    // Table Name And Table Items
    protected $table = 'activity_logs';
    protected $fillable = [
        'user_id',
        'action',
        'activity',
        'agent',
        'ip_address',
    ];
}
