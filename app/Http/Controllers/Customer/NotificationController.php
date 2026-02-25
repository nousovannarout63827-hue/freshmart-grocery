<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display customer notifications.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Get notifications
        $query = $user->notifications()->orderBy('created_at', 'desc');
        
        // Filter
        $filter = $request->get('filter', 'all');
        if ($filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($filter === 'read') {
            $query->whereNotNull('read_at');
        }
        
        $notifications = $query->paginate(20);
        
        // Get unread count
        $unreadCount = $user->unreadNotifications()->count();
        
        return view('customer.profile.notifications', compact('notifications', 'unreadCount'));
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead($id)
    {
        $user = auth()->user();
        $notification = $user->notifications()->find($id);
        
        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        
        return response()->json(['success' => true]);
    }

    /**
     * Delete a notification.
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $notification = $user->notifications()->find($id);
        
        if ($notification) {
            $notification->delete();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }

    /**
     * Delete all notifications.
     */
    public function destroyAll()
    {
        $user = auth()->user();
        $user->notifications()->delete();
        
        return response()->json(['success' => true]);
    }

    /**
     * Get unread notification count.
     */
    public function unreadCount()
    {
        $user = auth()->user();
        return response()->json([
            'count' => $user->unreadNotifications()->count()
        ]);
    }
}
