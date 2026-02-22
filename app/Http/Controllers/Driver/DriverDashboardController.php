<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DriverDashboardController extends Controller
{
    /**
     * Display the driver dashboard with all order states.
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');
        
        // Available Orders: Orders ready for pickup (approved by admin/staff, no driver assigned)
        $availableOrders = Order::whereNull('driver_id')
            ->where('status', 'ready_for_pickup')
            ->with(['customer', 'orderItems.product'])
            ->latest()
            ->get();

        // Orders assigned to THIS driver (ready to pickup at store)
        $myToPickupOrders = Order::where('driver_id', auth()->id())
            ->where('status', 'ready_for_pickup')
            ->with(['customer', 'orderItems.product'])
            ->latest()
            ->get();

        // Active deliveries (driver has accepted and is delivering)
        $myActiveOrders = Order::where('driver_id', auth()->id())
            ->whereIn('status', ['out_for_delivery', 'arrived'])
            ->with(['customer', 'orderItems.product'])
            ->latest()
            ->get();

        // Completed deliveries today
        $completedToday = Order::where('driver_id', auth()->id())
            ->where('status', 'delivered')
            ->whereDate('updated_at', today())
            ->with(['customer'])
            ->latest()
            ->get();

        // Delivery history (all time)
        $deliveryHistory = Order::where('driver_id', auth()->id())
            ->where('status', 'delivered')
            ->with(['customer'])
            ->latest()
            ->take(10)
            ->get();

        // Stats
        $stats = [
            'available' => $availableOrders->count(),
            'to_pickup' => $myToPickupOrders->count(),
            'active' => $myActiveOrders->count(),
            'completed_today' => $completedToday->count(),
            'total_earnings' => $completedToday->sum('total_amount') * 0.10, // Example: 10% commission
        ];

        return view('driver.dashboard', compact(
            'availableOrders',
            'myToPickupOrders',
            'myActiveOrders',
            'completedToday',
            'deliveryHistory',
            'stats',
            'filter'
        ));
    }

    /**
     * Accept an available order (only when status is ready_for_pickup).
     */
    public function acceptOrder($id)
    {
        $order = Order::findOrFail($id);

        // Validate order is still available (no driver assigned yet)
        if ($order->driver_id !== null) {
            return redirect()->back()->with('error', 'This order has already been assigned to a driver.');
        }

        // Validate order status - must be ready_for_pickup (approved by staff)
        if ($order->status !== 'ready_for_pickup') {
            return redirect()->back()->with('error', 'This order is not ready for pickup yet. Current status: ' . $order->status);
        }

        // Assign the order to the logged-in driver and update status
        $order->update([
            'driver_id' => auth()->id(),
            'status' => 'out_for_delivery'
        ]);

        // Log activity
        ActivityLog::log(
            'Accepted Order',
            'Delivery',
            'Driver ' . auth()->user()->name . ' accepted Order #' . $id . ' for delivery'
        );

        return redirect()->back()->with('success', 'Order accepted! Please proceed to the store for pickup.');
    }

    /**
     * Confirm pickup at the store.
     */
    public function confirmPickup($id)
    {
        $order = Order::findOrFail($id);

        // Validate order belongs to this driver
        if ($order->driver_id !== auth()->id()) {
            return redirect()->back()->with('error', 'This order is not assigned to you.');
        }

        // Validate order status - should be ready_for_pickup or out_for_delivery
        if (!in_array($order->status, ['ready_for_pickup', 'out_for_delivery'])) {
            return redirect()->back()->with('error', 'This order cannot be picked up. Current status: ' . $order->status);
        }

        // Update status to picked_up (internal tracking)
        $order->update([
            'status' => 'out_for_delivery'
        ]);

        // Log activity
        ActivityLog::log(
            'Picked Up Order',
            'Delivery',
            'Driver ' . auth()->user()->name . ' picked up Order #' . $id . ' from store'
        );

        return redirect()->back()->with('success', 'Order picked up! You are now out for delivery.');
    }

    /**
     * Confirm arrival at customer location.
     */
    public function confirmArrival($id)
    {
        $order = Order::findOrFail($id);

        // Validate order belongs to this driver
        if ($order->driver_id !== auth()->id()) {
            return redirect()->back()->with('error', 'This order is not assigned to you.');
        }

        // Validate order status - must be out_for_delivery
        if ($order->status !== 'out_for_delivery') {
            return redirect()->back()->with('error', 'Cannot confirm arrival. Current status: ' . $order->status);
        }

        // Update status to arrived
        $order->update([
            'status' => 'arrived'
        ]);

        // Log activity
        ActivityLog::log(
            'Arrived at Customer',
            'Delivery',
            'Driver ' . auth()->user()->name . ' arrived at customer location for Order #' . $id
        );

        return redirect()->back()->with('success', 'Arrival confirmed! Please complete the delivery.');
    }

    /**
     * Confirm delivery completion.
     */
    public function confirmDelivery(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validate order belongs to this driver
        if ($order->driver_id !== auth()->id()) {
            return redirect()->back()->with('error', 'This order is not assigned to you.');
        }

        // Validate order status - can be from out_for_delivery or arrived
        if (!in_array($order->status, ['out_for_delivery', 'arrived'])) {
            return redirect()->back()->with('error', 'This order cannot be marked as delivered. Current status: ' . $order->status);
        }

        // Prepare update data
        $updateData = [
            'status' => 'delivered',
        ];

        // If COD, mark as paid
        if ($order->payment_method === 'cod') {
            $updateData['payment_status'] = 'paid';
        }

        // Optional: Add delivery notes
        if ($request->has('delivery_notes')) {
            $updateData['delivery_notes'] = $request->input('delivery_notes');
        }

        $order->update($updateData);

        // Log activity
        $paymentInfo = $order->payment_method === 'cod' ? ' (COD - Cash collected)' : ' (Pre-paid)';
        ActivityLog::log(
            'Delivered Order',
            'Delivery',
            'Driver ' . auth()->user()->name . ' completed delivery of Order #' . $id . ' - $' . number_format($order->total_amount, 2) . $paymentInfo
        );

        return redirect()->back()->with('success', 'Order delivered successfully! Great job!');
    }

    /**
     * View order details.
     */
    public function viewOrder($id)
    {
        $order = Order::with(['customer', 'driver', 'orderItems.product'])->findOrFail($id);

        // Validate order belongs to this driver or is available to accept
        if ($order->driver_id !== auth()->id() && $order->driver_id === null) {
            // Allow viewing available orders before accepting
        } elseif ($order->driver_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You do not have access to this order.');
        }

        return view('driver.order-details', compact('order'));
    }

    /**
     * Get directions (placeholder for integration with maps).
     */
    public function getDirections($id)
    {
        $order = Order::findOrFail($id);

        // Validate order belongs to this driver
        if ($order->driver_id !== auth()->id()) {
            return redirect()->back()->with('error', 'This order is not assigned to you.');
        }

        // Log activity
        ActivityLog::log(
            'Requested Directions',
            'Delivery',
            'Driver ' . auth()->user()->name . ' requested directions for Order #' . $id
        );

        // Build Google Maps URL
        $destination = urlencode($order->delivery_address ?? $order->address);
        $mapsUrl = "https://www.google.com/maps/dir/?api=1&destination={$destination}";

        return redirect()->away($mapsUrl);
    }

    /**
     * Contact customer (placeholder for phone/SMS integration).
     */
    public function contactCustomer($id)
    {
        $order = Order::findOrFail($id);

        // Validate order belongs to this driver or is available
        if ($order->driver_id !== auth()->id() && $order->driver_id !== null) {
            return redirect()->back()->with('error', 'You do not have access to this order.');
        }

        // Log activity
        ActivityLog::log(
            'Contacted Customer',
            'Delivery',
            'Driver ' . auth()->user()->name . ' contacted customer for Order #' . $id
        );

        $phone = $order->phone ?? $order->customer->phone_number ?? null;

        if (!$phone) {
            return redirect()->back()->with('error', 'No phone number available for this customer.');
        }

        // Return tel: link for mobile devices
        return redirect("tel:{$phone}");
    }
}
