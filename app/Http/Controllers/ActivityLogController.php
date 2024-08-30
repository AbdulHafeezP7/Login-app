<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ActivityLogController extends Controller
{
    public function showLogs(Request $request)
    {
        if ($request->ajax()) {
            $query = ActivityLog::query();
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
                ->filterColumn('action', function ($query, $keyword) {
                    $query->where('action', 'like', "%{$keyword}%");
                })
                ->filterColumn('user_id', function ($query, $keyword) {
                    $query->where('user_id', 'like', "%{$keyword}%");
                })
                ->filterColumn('agent', function ($query, $keyword) {
                    $query->where('agent', 'like', "%{$keyword}%");
                })
                ->filterColumn('ip_address', function ($query, $keyword) {
                    $query->where('user_id', 'like', "%{$keyword}%");
                })
                ->make(true);
        }
        return view('backend.activity-logs');
    }
    public function index() {}
    public function create() {}
    public function store(Request $request) {}
    public function show(ActivityLog $activityLog) {}
    public function edit(ActivityLog $activityLog) {}
    public function update(Request $request, ActivityLog $activityLog) {}
    public function destroy(ActivityLog $activityLog) {}
}
