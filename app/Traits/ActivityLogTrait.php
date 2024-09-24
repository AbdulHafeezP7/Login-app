<?php

namespace App\Traits;

use App\Models\ActivityLog;

// ActivityLog Trait
trait ActivityLogTrait
{
    public function logActivity($userId, $action, $activity, $agent, $ipAddress)
    {
        // ActivityLog Items
        ActivityLog::create([
            'user_id' => $userId,
            'action' => $action,
            'activity' => $activity,
            'agent' => $agent,
            'ip_address' => $ipAddress,
        ]);
    }
}
