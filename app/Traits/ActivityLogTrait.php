<?php

namespace App\Traits;

use App\Models\ActivityLog;

// Trait for logging user activities
trait ActivityLogTrait
{
    /**
     * Log a user activity to the ActivityLog model.
     *
     * @param int    $userId   The ID of the user performing the action.
     * @param string $action    A description of the action performed.
     * @param string $activity  Details about the activity being logged.
     * @param string $agent     The user agent of the client making the request.
     * @param string $ipAddress The IP address from which the request originated.
     *
     * @return void
     */
    public function logActivity($userId, $action, $activity, $agent, $ipAddress)
    {
        // Create a new activity log entry
        ActivityLog::create([
            'user_id' => $userId,     // ID of the user associated with the activity
            'action' => $action,       // Description of the action performed
            'activity' => $activity,   // Details of the activity
            'agent' => $agent,         // User agent of the client
            'ip_address' => $ipAddress, // IP address of the user
        ]);
    }
}
