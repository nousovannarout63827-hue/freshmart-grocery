<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverLocationController extends Controller
{
    /**
     * Show the location update page for drivers
     */
    public function index()
    {
        $driver = Auth::user();
        
        // Check if user is a driver
        if ($driver->role !== 'driver') {
            abort(403, 'Access denied. Only drivers can access this page.');
        }

        return view('driver.location', compact('driver'));
    }

    /**
     * Update driver location manually
     */
    public function update(Request $request)
    {
        $driver = Auth::user();

        if ($driver->role !== 'driver') {
            abort(403, 'Access denied.');
        }

        $validated = $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $driver->update([
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'location_updated_at' => now(),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Location updated successfully',
                'location' => [
                    'latitude' => $driver->latitude,
                    'longitude' => $driver->longitude,
                    'updated_at' => $driver->location_updated_at?->diffForHumans(),
                ]
            ]);
        }

        return back()->with('success', 'Your location has been updated successfully!');
    }

    /**
     * Get driver location (API endpoint)
     */
    public function getLocation()
    {
        $driver = Auth::user();

        if ($driver->role !== 'driver') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json([
            'latitude' => $driver->latitude,
            'longitude' => $driver->longitude,
            'updated_at' => $driver->location_updated_at?->diffForHumans(),
            'has_location' => $driver->latitude !== null && $driver->longitude !== null,
        ]);
    }

    /**
     * Show the driver tracking page (Admin only)
     */
    public function showTracking()
    {
        $admin = Auth::user();

        if ($admin->role !== 'admin') {
            abort(403, 'Access denied. Only admins can access this page.');
        }

        return view('admin.drivers.tracking');
    }

    /**
     * Get all active drivers location (Admin only - API endpoint)
     */
    public function getAllDriversLocation()
    {
        $admin = Auth::user();

        if ($admin->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Get drivers who are currently on active deliveries (out_for_delivery or arrived)
        $drivers = \App\Models\User::where('role', 'driver')
            ->where('status', 'active')
            ->whereHas('assignedOrders', function($query) {
                $query->whereIn('status', ['out_for_delivery', 'arrived']);
            })
            ->with(['assignedOrders' => function($query) {
                $query->whereIn('status', ['out_for_delivery', 'arrived'])
                      ->whereNotNull('latitude')
                      ->whereNotNull('longitude')
                      ->with('customer');
            }])
            ->get(['id', 'name', 'latitude', 'longitude', 'location_updated_at', 'phone_number', 'avatar', 'profile_photo_path']);

        // Get active orders with customer locations (not yet assigned to drivers)
        $unassignedOrders = \App\Models\Order::with('customer')
            ->whereIn('status', ['pending', 'preparing', 'ready_for_pickup'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereNull('driver_id')
            ->get(['id', 'customer_id', 'latitude', 'longitude', 'delivery_address', 'status', 'created_at']);

        return response()->json([
            'drivers' => $drivers->map(function ($driver) {
                $hasLocation = $driver->latitude !== null && $driver->longitude !== null 
                               && is_numeric($driver->latitude) && is_numeric($driver->longitude);
                
                $assignedOrder = $driver->assignedOrders->first();
                
                return [
                    'id' => $driver->id,
                    'name' => $driver->name,
                    'latitude' => $hasLocation ? (float)$driver->latitude : null,
                    'longitude' => $hasLocation ? (float)$driver->longitude : null,
                    'updated_at' => $driver->location_updated_at?->diffForHumans(),
                    'updated_at_full' => $driver->location_updated_at?->format('M d, Y h:i A'),
                    'phone_number' => $driver->phone_number,
                    'has_location' => $hasLocation,
                    'avatar' => $driver->avatar ?? $driver->profile_photo_path,
                    'assigned_order' => $assignedOrder ? [
                        'id' => $assignedOrder->id,
                        'customer_name' => $assignedOrder->customer->name ?? 'Customer',
                        'customer_latitude' => (float)$assignedOrder->latitude,
                        'customer_longitude' => (float)$assignedOrder->longitude,
                        'address' => $assignedOrder->delivery_address ?? 'Delivery address',
                        'status' => str_replace('_', ' ', $assignedOrder->status),
                    ] : null,
                    'is_on_duty' => $assignedOrder !== null, // Only true if has active order
                ];
            }),
            'unassigned_orders' => $unassignedOrders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'customer_name' => $order->customer->name ?? 'Customer',
                    'latitude' => (float)$order->latitude,
                    'longitude' => (float)$order->longitude,
                    'address' => $order->delivery_address ?? 'Delivery address',
                    'status' => str_replace('_', ' ', $order->status),
                    'order_time' => $order->created_at?->diffForHumans(),
                ];
            }),
            'total_drivers' => $drivers->count(),
            'drivers_with_location' => $drivers->whereNotNull('latitude')->whereNotNull('longitude')->count(),
            'drivers_with_orders' => $drivers->filter(fn($d) => $d->assignedOrders->isNotEmpty())->count(),
        ]);
    }
}
