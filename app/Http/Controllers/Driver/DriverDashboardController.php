<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverDashboardController extends Controller
{
    /**
     * Display the driver dashboard with all order states.
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');
        $driverId = auth()->id();
        $commissionRate = (float) config('app.driver_commission_rate', 0.10);
        
        // Available Orders: Orders ready for pickup (approved by admin/staff, no driver assigned)
        $availableOrders = Order::whereNull('driver_id')
            ->where('status', 'ready_for_pickup')
            ->with(['customer', 'orderItems.product'])
            ->latest()
            ->get();

        // Orders assigned to THIS driver (ready to pickup at store)
        $myToPickupOrders = Order::where('driver_id', $driverId)
            ->where('status', 'ready_for_pickup')
            ->with(['customer', 'orderItems.product'])
            ->latest()
            ->get();

        // Active deliveries (driver has accepted and is delivering)
        $myActiveOrders = Order::where('driver_id', $driverId)
            ->whereIn('status', ['out_for_delivery', 'arrived'])
            ->with(['customer', 'orderItems.product'])
            ->latest()
            ->get();

        // Completed deliveries today
        $completedToday = Order::where('driver_id', $driverId)
            ->where('status', 'delivered')
            ->whereDate('updated_at', today())
            ->with(['customer'])
            ->latest()
            ->get();

        // Delivery history (all time)
        $deliveryHistory = Order::where('driver_id', $driverId)
            ->where('status', 'delivered')
            ->with(['customer', 'orderItems'])
            ->latest()
            ->take(10)
            ->get();

        // Earnings history (daily last 14 days)
        $dailyRows = Order::where('driver_id', $driverId)
            ->where('status', 'delivered')
            ->whereDate('updated_at', '>=', now()->copy()->subDays(13)->toDateString())
            ->selectRaw('DATE(updated_at) as period_date, COUNT(*) as deliveries, COALESCE(SUM(total_amount), 0) as revenue')
            ->groupBy('period_date')
            ->orderBy('period_date')
            ->get()
            ->keyBy('period_date');

        $dailyEarningsHistory = [];
        for ($i = 13; $i >= 0; $i--) {
            $date = now()->copy()->subDays($i);
            $dateKey = $date->toDateString();
            $row = $dailyRows->get($dateKey);
            $revenue = (float) ($row->revenue ?? 0);

            $dailyEarningsHistory[] = [
                'date' => $dateKey,
                'label' => $date->format('M d'),
                'deliveries' => (int) ($row->deliveries ?? 0),
                'revenue' => $revenue,
                'earnings' => $revenue * $commissionRate,
            ];
        }

        // Earnings history (monthly last 6 months)
        $monthlyRows = Order::where('driver_id', $driverId)
            ->where('status', 'delivered')
            ->whereDate('updated_at', '>=', now()->copy()->subMonths(5)->startOfMonth()->toDateString())
            ->selectRaw('YEAR(updated_at) as year_num, MONTH(updated_at) as month_num, COUNT(*) as deliveries, COALESCE(SUM(total_amount), 0) as revenue')
            ->groupBy('year_num', 'month_num')
            ->orderBy('year_num')
            ->orderBy('month_num')
            ->get()
            ->keyBy(function ($row) {
                return sprintf('%04d-%02d', $row->year_num, $row->month_num);
            });

        $monthlyEarningsHistory = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->copy()->subMonths($i);
            $monthKey = $month->format('Y-m');
            $row = $monthlyRows->get($monthKey);
            $revenue = (float) ($row->revenue ?? 0);

            $monthlyEarningsHistory[] = [
                'month' => $monthKey,
                'label' => $month->format('M Y'),
                'deliveries' => (int) ($row->deliveries ?? 0),
                'revenue' => $revenue,
                'earnings' => $revenue * $commissionRate,
            ];
        }

        // Performance leaderboard (day and month)
        $todayLeaderboard = $this->buildLeaderboardForPeriod('day', $commissionRate);
        $monthLeaderboard = $this->buildLeaderboardForPeriod('month', $commissionRate);

        $todayRank = $todayLeaderboard->search(function ($driver) use ($driverId) {
            return (int) $driver['id'] === (int) $driverId;
        });
        $monthRank = $monthLeaderboard->search(function ($driver) use ($driverId) {
            return (int) $driver['id'] === (int) $driverId;
        });

        $myTodayStats = $todayLeaderboard->firstWhere('id', $driverId) ?? [
            'deliveries' => 0,
            'earnings' => 0,
        ];
        $myMonthStats = $monthLeaderboard->firstWhere('id', $driverId) ?? [
            'deliveries' => 0,
            'earnings' => 0,
        ];

        $performanceReport = [
            'daily_history' => $dailyEarningsHistory,
            'daily_max_earnings' => max(1, max(array_column($dailyEarningsHistory, 'earnings'))),
            'monthly_history' => $monthlyEarningsHistory,
            'monthly_max_earnings' => max(1, max(array_column($monthlyEarningsHistory, 'earnings'))),
            'today' => [
                'leaderboard' => $todayLeaderboard->take(5)->values(),
                'top_driver' => $todayLeaderboard->first(),
                'my_rank' => $todayRank === false ? null : $todayRank + 1,
                'my_deliveries' => (int) ($myTodayStats['deliveries'] ?? 0),
                'my_earnings' => (float) ($myTodayStats['earnings'] ?? 0),
            ],
            'month' => [
                'leaderboard' => $monthLeaderboard->take(5)->values(),
                'top_driver' => $monthLeaderboard->first(),
                'my_rank' => $monthRank === false ? null : $monthRank + 1,
                'my_deliveries' => (int) ($myMonthStats['deliveries'] ?? 0),
                'my_earnings' => (float) ($myMonthStats['earnings'] ?? 0),
            ],
        ];

        // Stats
        $stats = [
            'available' => $availableOrders->count(),
            'to_pickup' => $myToPickupOrders->count(),
            'active' => $myActiveOrders->count(),
            'completed_today' => $completedToday->count(),
            'total_earnings' => $completedToday->sum('total_amount') * $commissionRate,
            'month_deliveries' => $performanceReport['month']['my_deliveries'],
        ];

        return view('driver.dashboard', compact(
            'availableOrders',
            'myToPickupOrders',
            'myActiveOrders',
            'completedToday',
            'deliveryHistory',
            'stats',
            'filter',
            'performanceReport'
        ));
    }

    /**
     * Build a delivery leaderboard for all drivers by day or month.
     */
    private function buildLeaderboardForPeriod(string $period, float $commissionRate)
    {
        $query = User::query()
            ->where('role', 'driver')
            ->leftJoin('orders as delivered_orders', function ($join) use ($period) {
                $join->on('users.id', '=', 'delivered_orders.driver_id')
                    ->where('delivered_orders.status', '=', 'delivered');

                if ($period === 'day') {
                    $join->whereDate('delivered_orders.updated_at', today());
                } else {
                    $join->whereYear('delivered_orders.updated_at', now()->year)
                        ->whereMonth('delivered_orders.updated_at', now()->month);
                }
            })
            ->select(
                'users.id',
                'users.name',
                DB::raw('COUNT(delivered_orders.id) as deliveries'),
                DB::raw('COALESCE(SUM(delivered_orders.total_amount), 0) as revenue')
            )
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('deliveries')
            ->orderByDesc('revenue')
            ->orderBy('users.name');

        return $query->get()->map(function ($driver) use ($commissionRate) {
            $revenue = (float) $driver->revenue;

            return [
                'id' => (int) $driver->id,
                'name' => $driver->name,
                'deliveries' => (int) $driver->deliveries,
                'revenue' => $revenue,
                'earnings' => $revenue * $commissionRate,
            ];
        });
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
        $order = Order::with(['customer', 'driver', 'orderItems.product.productImages'])->findOrFail($id);

        // Validate order belongs to this driver or is available to accept
        if ($order->driver_id !== auth()->id() && $order->driver_id === null) {
            // Allow viewing available orders before accepting
        } elseif ($order->driver_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You do not have access to this order.');
        }

        return view('driver.order-details', compact('order'));
    }

    /**
     * Get directions to delivery location using Google Maps.
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

        // Build Google Maps URL - Use coordinates if available, otherwise use address
        if ($order->latitude && $order->longitude) {
            // Use exact GPS coordinates for precise navigation
            $mapsUrl = "https://www.google.com/maps/dir/?api=1&destination={$order->latitude},{$order->longitude}";
        } else {
            // Fallback to address if coordinates not available
            $destination = urlencode($order->delivery_address ?? $order->address);
            $mapsUrl = "https://www.google.com/maps/dir/?api=1&destination={$destination}";
        }

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

    /**
     * Update order status through guided workflow.
     */
    public function updateStatus(Request $request, $id)
    {
        // 1. Find the order
        $order = Order::findOrFail($id);

        // 2. Validate that the submitted status is one of our allowed options
        $request->validate([
            'status' => 'required|in:picked_up,out_for_delivery,completed',
        ]);

        // 3. Check if driver is authorized to update this order
        if ($order->driver_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not assigned to this order.');
        }

        // 4. Validate status transitions (prevent skipping steps)
        $allowedTransitions = [
            'pending' => ['picked_up'],
            'preparing' => ['picked_up'],
            'picked_up' => ['out_for_delivery'],
            'out_for_delivery' => ['completed', 'arrived'],
            'arrived' => ['completed', 'out_for_delivery'],
        ];

        $currentStatus = $order->status;
        $newStatus = $request->status;

        // Allow the transition if it's in the allowed list
        if (!in_array($newStatus, $allowedTransitions[$currentStatus] ?? [])) {
            return redirect()->back()->with('error', 'Invalid status transition. Please follow the correct order flow.');
        }

        // 5. Update the order status
        $order->status = $newStatus;
        
        // If marking as completed, update payment status too
        if ($newStatus === 'completed') {
            $order->payment_status = 'paid';
        }
        
        $order->save();

        // 6. Log the activity
        $statusLabels = [
            'picked_up' => 'Picked Up',
            'out_for_delivery' => 'Out for Delivery',
            'completed' => 'Delivered',
            'arrived' => 'Arrived at Destination',
        ];
        
        ActivityLog::log(
            'Status Updated',
            'Delivery',
            'Driver ' . auth()->user()->name . ' marked Order #' . $id . ' as ' . ($statusLabels[$newStatus] ?? $newStatus)
        );

        // 7. Customize the success message based on the status
        $message = 'Order status updated successfully!';
        if ($newStatus == 'out_for_delivery') {
            $message = '🛵 You are now out for delivery! Drive safely.';
        } elseif ($newStatus == 'completed') {
            $message = '🎉 Great job! Order delivered successfully.';
        } elseif ($newStatus == 'picked_up') {
            $message = '📦 Order picked up! Head to the delivery location.';
        }

        // 8. Redirect back with success flash message
        return redirect()->back()->with('success', $message);
    }
}
