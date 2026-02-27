<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderTrackingController extends Controller
{
    /**
     * Show order tracking page for customer
     */
    public function track($orderId)
    {
        $order = Order::with(['customer', 'driver', 'orderItems.product'])
            ->where('id', $orderId)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        if (!$order) {
            abort(403, 'Order not found or you do not have permission to view this order.');
        }

        // Redirect to order details if already delivered
        if ($order->status === 'delivered') {
            return redirect()->route('customer.order.details', $orderId)
                ->with('info', 'This order has been delivered. View order details instead.');
        }

        return view('customer.order-tracking', compact('order'));
    }

    /**
     * Get order tracking data (API for live updates)
     */
    public function getTrackingData($orderId)
    {
        $order = Order::with(['customer', 'driver', 'orderItems.product'])
            ->where('id', $orderId)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $driverLocation = null;
        if ($order->driver && $order->driver->latitude && $order->driver->longitude) {
            $driverLocation = [
                'latitude' => (float)$order->driver->latitude,
                'longitude' => (float)$order->driver->longitude,
                'name' => $order->driver->name,
                'phone' => $order->driver->phone_number,
                'updated_at' => $order->driver->location_updated_at?->diffForHumans(),
            ];
        }

        return response()->json([
            'order' => [
                'id' => $order->id,
                'status' => str_replace('_', ' ', $order->status),
                'delivery_address' => $order->delivery_address,
                'customer_latitude' => $order->latitude,
                'customer_longitude' => $order->longitude,
                'estimated_time' => $order->created_at->addMinutes(30)->diffForHumans(),
            ],
            'driver' => $driverLocation,
            'progress' => $this->getOrderProgress($order->status),
        ]);
    }

    /**
     * Get order progress percentage based on status
     */
    private function getOrderProgress($status)
    {
        $progress = [
            'pending' => 10,
            'preparing' => 25,
            'ready_for_pickup' => 40,
            'out_for_delivery' => 60,
            'arrived' => 85,
            'delivered' => 100,
            'cancelled' => 0,
        ];

        return $progress[$status] ?? 0;
    }
}
