<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverPerformanceController extends Controller
{
    /**
     * Display driver performance and activity dashboard.
     */
    public function index(Request $request)
    {
        // Get all drivers
        $drivers = User::where('role', 'driver')
            ->orderBy('name')
            ->get();

        // Selected driver filter
        $selectedDriverId = $request->get('driver_id');

        // Base query for driver activities
        $activityQuery = ActivityLog::with('user')
            ->whereHas('user', function($q) {
                $q->where('role', 'driver');
            });

        // Filter by specific driver
        if ($selectedDriverId) {
            $activityQuery->where('user_id', $selectedDriverId);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $activityQuery->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $activityQuery->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by action type
        if ($request->filled('action')) {
            $activityQuery->where('action', $request->action);
        }

        $activities = $activityQuery->latest()->paginate(50)->withQueryString();

        // Driver Statistics with enhanced metrics
        $driverStats = [];
        foreach ($drivers as $driver) {
            $totalDeliveries = Order::where('driver_id', $driver->id)
                ->where('status', 'delivered')
                ->count();
            
            $totalRevenue = Order::where('driver_id', $driver->id)
                ->where('status', 'delivered')
                ->sum('total_amount');
            
            $codOrders = Order::where('driver_id', $driver->id)
                ->where('status', 'delivered')
                ->where('payment_method', 'cash')
                ->count();
            
            $onlineOrders = Order::where('driver_id', $driver->id)
                ->where('status', 'delivered')
                ->whereNotIn('payment_method', ['cash', 'cod'])
                ->count();

            $driverStats[$driver->id] = [
                'total_deliveries' => $totalDeliveries,
                'deliveries_today' => Order::where('driver_id', $driver->id)
                    ->where('status', 'delivered')
                    ->whereDate('updated_at', today())
                    ->count(),
                'deliveries_this_week' => Order::where('driver_id', $driver->id)
                    ->where('status', 'delivered')
                    ->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])
                    ->count(),
                'deliveries_this_month' => Order::where('driver_id', $driver->id)
                    ->where('status', 'delivered')
                    ->whereMonth('updated_at', now()->month)
                    ->whereYear('updated_at', now()->year)
                    ->count(),
                'deliveries_last_month' => Order::where('driver_id', $driver->id)
                    ->where('status', 'delivered')
                    ->whereMonth('updated_at', now()->copy()->subMonth()->month)
                    ->whereYear('updated_at', now()->year)
                    ->count(),
                'total_revenue' => $totalRevenue,
                'total_earnings' => $totalRevenue * 0.10, // 10% commission
                'cod_orders' => $codOrders,
                'online_orders' => $onlineOrders,
                'active_orders' => Order::where('driver_id', $driver->id)
                    ->whereIn('status', ['out_for_delivery', 'arrived'])
                    ->count(),
                'cancelled_deliveries' => Order::where('driver_id', $driver->id)
                    ->where('status', 'cancelled')
                    ->count(),
                'avg_delivery_time' => $this->calculateAverageDeliveryTime($driver->id),
                'customer_rating' => $this->calculateDriverRating($driver->id),
                'success_rate' => $totalDeliveries > 0 ? round(($totalDeliveries / ($totalDeliveries + Order::where('driver_id', $driver->id)->where('status', 'cancelled')->count())) * 100, 1) : 0,
            ];
        }

        // Get actions for filter
        $actions = ActivityLog::whereHas('user', function($q) {
            $q->where('role', 'driver');
        })->selectRaw('DISTINCT action')->pluck('action');

        // Overall statistics
        $overallStats = [
            'total_drivers' => $drivers->count(),
            'active_drivers' => Order::whereIn('status', ['out_for_delivery', 'arrived'])
                ->select('driver_id')
                ->distinct()
                ->count(),
            'total_deliveries_today' => Order::where('status', 'delivered')
                ->whereDate('updated_at', today())
                ->count(),
            'total_activities' => ActivityLog::whereHas('user', function($q) {
                $q->where('role', 'driver');
            })->count(),
            'total_revenue_today' => Order::where('status', 'delivered')
                ->whereDate('updated_at', today())
                ->sum('total_amount'),
        ];

        // Weekly comparison data
        $weeklyData = $this->getWeeklyDeliveryData();
        
        // Monthly comparison data
        $monthlyData = $this->getMonthlyDeliveryData();
        
        // Top performers
        $topPerformers = $this->getTopPerformers($driverStats);

        return view('admin.driver-performance.index', compact(
            'drivers',
            'driverStats',
            'activities',
            'actions',
            'overallStats',
            'selectedDriverId',
            'weeklyData',
            'monthlyData',
            'topPerformers'
        ));
    }

    /**
     * Calculate average delivery time for a driver.
     */
    private function calculateAverageDeliveryTime($driverId)
    {
        $deliveredOrders = Order::where('driver_id', $driverId)
            ->where('status', 'delivered')
            ->whereNotNull('updated_at')
            ->whereNotNull('created_at')
            ->limit(50)
            ->get();

        if ($deliveredOrders->isEmpty()) {
            return 'N/A';
        }

        $totalMinutes = 0;
        $count = 0;

        foreach ($deliveredOrders as $order) {
            $diff = $order->created_at->diff($order->updated_at);
            $minutes = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;
            $totalMinutes += $minutes;
            $count++;
        }

        $avgMinutes = round($totalMinutes / $count);

        if ($avgMinutes < 60) {
            return $avgMinutes . ' min';
        } else {
            $hours = floor($avgMinutes / 60);
            $mins = $avgMinutes % 60;
            return $hours . 'h ' . $mins . 'm';
        }
    }

    /**
     * Calculate customer rating for a driver.
     */
    private function calculateDriverRating($driverId)
    {
        $deliveredCount = Order::where('driver_id', $driverId)
            ->where('status', 'delivered')
            ->count();
        
        if ($deliveredCount === 0) {
            return 0;
        }
        
        $baseRating = 4.0;
        
        $onTimeCount = Order::where('driver_id', $driverId)
            ->where('status', 'delivered')
            ->whereRaw('TIMESTAMPDIFF(MINUTE, created_at, updated_at) <= 120')
            ->count();
        
        $onTimeBonus = ($onTimeCount / $deliveredCount) * 0.5;
        $volumeBonus = min($deliveredCount / 100, 0.5);
        
        $rating = min(5.0, $baseRating + $onTimeBonus + $volumeBonus);
        
        return round($rating, 1);
    }

    /**
     * Get weekly delivery data for charts.
     */
    private function getWeeklyDeliveryData()
    {
        $data = [];
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        
        foreach ($days as $index => $day) {
            $startOfDay = now()->startOfWeek()->addDays($index)->startOfDay();
            $endOfDay = now()->startOfWeek()->addDays($index)->endOfDay();
            
            $deliveries = Order::where('status', 'delivered')
                ->whereBetween('updated_at', [$startOfDay, $endOfDay])
                ->count();
            
            $revenue = Order::where('status', 'delivered')
                ->whereBetween('updated_at', [$startOfDay, $endOfDay])
                ->sum('total_amount');
            
            $data[] = [
                'day' => $day,
                'deliveries' => $deliveries,
                'revenue' => round($revenue, 2),
            ];
        }
        
        return $data;
    }

    /**
     * Get monthly delivery data for charts.
     */
    private function getMonthlyDeliveryData()
    {
        $currentMonth = Order::where('status', 'delivered')
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->count();
        
        $lastMonth = Order::where('status', 'delivered')
            ->whereMonth('updated_at', now()->copy()->subMonth()->month)
            ->whereYear('updated_at', now()->year)
            ->count();
        
        $currentRevenue = Order::where('status', 'delivered')
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->sum('total_amount');
        
        $lastRevenue = Order::where('status', 'delivered')
            ->whereMonth('updated_at', now()->copy()->subMonth()->month)
            ->whereYear('updated_at', now()->year)
            ->sum('total_amount');
        
        return [
            'current_month_deliveries' => $currentMonth,
            'last_month_deliveries' => $lastMonth,
            'current_month_revenue' => round($currentRevenue, 2),
            'last_month_revenue' => round($lastRevenue, 2),
            'growth_percentage' => $lastMonth > 0 ? round((($currentMonth - $lastMonth) / $lastMonth) * 100, 1) : 0,
        ];
    }

    /**
     * Get top performers leaderboard.
     */
    private function getTopPerformers($driverStats)
    {
        $performers = [];
        
        foreach ($driverStats as $driverId => $stats) {
            $driver = User::find($driverId);
            $performers[] = [
                'id' => $driverId,
                'name' => $driver->name,
                'avatar_initial' => strtoupper(substr($driver->name, 0, 1)),
                'deliveries' => $stats['deliveries_this_month'],
                'revenue' => $stats['total_revenue'],
                'earnings' => $stats['total_earnings'],
                'rating' => $stats['customer_rating'],
                'success_rate' => $stats['success_rate'],
            ];
        }
        
        usort($performers, function($a, $b) {
            return $b['deliveries'] <=> $a['deliveries'];
        });
        
        return array_slice($performers, 0, 5);
    }

    /**
     * Show detailed performance for a specific driver.
     */
    public function show($driverId)
    {
        $driver = User::where('role', 'driver')->findOrFail($driverId);

        $driverOrders = Order::where('driver_id', $driverId)
            ->with(['customer', 'orderItems'])
            ->latest()
            ->paginate(20);

        $driverActivities = ActivityLog::where('user_id', $driverId)
            ->latest()
            ->paginate(30);

        $totalDeliveries = Order::where('driver_id', $driverId)
            ->where('status', 'delivered')
            ->count();
        
        $totalRevenue = Order::where('driver_id', $driverId)
            ->where('status', 'delivered')
            ->sum('total_amount');

        $stats = [
            'total_deliveries' => $totalDeliveries,
            'total_earnings' => $totalRevenue * 0.10,
            'avg_delivery_time' => $this->calculateAverageDeliveryTime($driverId),
            'customer_rating' => $this->calculateDriverRating($driverId),
        ];

        $cancellations = Order::where('driver_id', $driverId)
            ->where('status', 'cancelled')
            ->whereNotNull('cancellation_reason')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.driver-performance.show', compact(
            'driver',
            'driverOrders',
            'driverActivities',
            'stats',
            'cancellations'
        ));
    }

    /**
     * Export driver performance report.
     */
    public function export(Request $request)
    {
        $driverId = $request->get('driver_id');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $activities = ActivityLog::with('user')
            ->whereHas('user', function($q) use ($driverId) {
                if ($driverId) {
                    $q->where('id', $driverId);
                }
                $q->where('role', 'driver');
            });

        if ($dateFrom) {
            $activities->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $activities->whereDate('created_at', '<=', $dateTo);
        }

        $activities = $activities->latest()->get();

        return response()->json([
            'activities' => $activities,
            'total' => $activities->count(),
            'period' => [
                'from' => $dateFrom,
                'to' => $dateTo,
            ]
        ]);
    }
}
