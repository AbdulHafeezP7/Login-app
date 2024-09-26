<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

// Controller for handling activity logs
class ActivityLogController extends Controller
{
    // Display the activity logs
    public function showLogs(Request $request)
    {
        // Check if the request is an AJAX request
        if ($request->ajax()) {
            $query = ActivityLog::query();

            // Return the DataTable of activity logs
            return DataTables::of($query)
                ->addColumn('user_id', function ($row) {
                    return $row->id ? $row->user_id : 'System';
                })
                ->addColumn('action', function ($row) {
                    return $row->id ? $row->action : 'System';
                })
                ->addColumn('agent', function ($row) {
                    return $row->id ? $row->agent : 'System';
                })
                ->addColumn('ip_address', function ($row) {
                    return $row->id ? $row->ip_address : 'System';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                // Filter activity logs by action
                ->filterColumn('action', function ($query, $keyword) {
                    $query->where('action', 'like', "%{$keyword}%");
                })
                // Filter activity logs by user ID
                ->filterColumn('user_id', function ($query, $keyword) {
                    $query->where('user_id', 'like', "%{$keyword}%");
                })
                // Filter activity logs by agent
                ->filterColumn('agent', function ($query, $keyword) {
                    $query->where('agent', 'like', "%{$keyword}%");
                })
                // Filter activity logs by IP address
                ->filterColumn('ip_address', function ($query, $keyword) {
                    $query->where('user_id', 'like', "%{$keyword}%");
                })
                ->make(true);
        }
        
        // Return the view for activity logs
        return view('backend.activity-logs');
    }

    // Index method 
    public function index() {}

    // Create method 
    public function create() {}

    // Store method 
    public function store(Request $request) {}

    // Show method 
    public function show(ActivityLog $activityLog) {}

    // Edit method 
    public function edit(ActivityLog $activityLog) {}

    // Update method 
    public function update(Request $request, ActivityLog $activityLog) {}

    // Destroy method 
    public function destroy(ActivityLog $activityLog) {}
}
