<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display the master activity log for SuperAdmin.
     * Shows ALL actions from ALL users with pagination and filtering.
     */
    public function index(Request $request)
    {
        $query = ActivityLog::with('user');

        // 1. Filter by Specific User (Staff Member or Driver)
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // 2. Filter by Action Type (Created, Updated, Deleted, etc.)
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // 3. Filter by Module (Delivery, Inventory, etc.)
        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        // 4. Filter by User Role (driver, staff, admin)
        if ($request->filled('role')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        // 5. Filter by Specific Date
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $logs = $query->latest()->paginate(50)->withQueryString();

        // Get list of users to populate the dropdown
        $users = User::orderBy('name')->get();
        
        // Get drivers specifically
        $drivers = User::where('role', 'driver')->orderBy('name')->get();

        // Get unique modules for filter
        $modules = ActivityLog::selectRaw('DISTINCT module')->pluck('module');

        // Get unique actions for filter
        $actions = ActivityLog::selectRaw('DISTINCT action')->pluck('action');

        // Count driver activities
        $driverActivityCount = ActivityLog::whereHas('user', function($q) {
            $q->where('role', 'driver');
        })->count();

        return view('admin.activity_logs.index', compact('logs', 'users', 'drivers', 'modules', 'actions', 'driverActivityCount'));
    }
}
