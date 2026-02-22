<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

class DebugController extends Controller
{
    public function checkOrders()
    {
        $availableOrders = Order::whereNull('driver_id')
            ->whereIn('status', ['pending', 'ready_for_pickup', 'out for delivery'])
            ->with(['customer', 'orderItems.product'])
            ->get();

        $drivers = User::where('role', 'driver')->get();

        $allOrders = Order::with(['customer', 'driver'])->get();

        // Count by status
        $statusCounts = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        return view('debug.orders', compact('availableOrders', 'drivers', 'allOrders', 'statusCounts'));
    }

    public function checkImages()
    {
        // Existing method placeholder
        return response()->json(['status' => 'ok']);
    }
}
