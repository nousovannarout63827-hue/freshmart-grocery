<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display comprehensive financial and driver reports.
     */
    public function index(Request $request)
    {
        [$dateFrom, $dateTo, $rangeStart, $rangeEnd] = $this->parseDateRange($request);

        // ==================== FINANCIAL METRICS ====================

        $financialTotalRevenue = Order::where('status', 'delivered')
            ->whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->sum('total_amount');

        // Previous period revenue for comparison
        $daysDiff = $rangeStart->diffInDays($rangeEnd);
        $prevRangeStart = (clone $rangeStart)->subDays($daysDiff + 1)->startOfDay();
        $prevRangeEnd = (clone $rangeStart)->subDay()->endOfDay();

        $previousRevenue = Order::where('status', 'delivered')
            ->whereBetween('created_at', [$prevRangeStart, $prevRangeEnd])
            ->sum('total_amount');

        $revenueGrowth = $previousRevenue > 0 
            ? round((($financialTotalRevenue - $previousRevenue) / $previousRevenue) * 100, 2) 
            : 0;

        // Total orders in date range
        $totalOrders = Order::whereBetween('created_at', [$rangeStart, $rangeEnd])->count();
        $previousOrders = Order::whereBetween('created_at', [$prevRangeStart, $prevRangeEnd])->count();
        $ordersGrowth = $previousOrders > 0 
            ? round((($totalOrders - $previousOrders) / $previousOrders) * 100, 2) 
            : 0;

        // Average order value
        $avgOrderValue = $totalOrders > 0 ? $financialTotalRevenue / $totalOrders : 0;

        // Revenue by payment method
        $revenueByPayment = Order::where('status', 'delivered')
            ->whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->select('payment_method', DB::raw('SUM(total_amount) as total, COUNT(*) as count'))
            ->groupBy('payment_method')
            ->get();

        // Daily revenue for chart
        $dailyRevenue = $this->getDailyRevenueData($rangeStart, $rangeEnd);

        // Monthly revenue comparison
        $monthlyRevenue = $this->getMonthlyRevenueData();

        // Revenue by category
        $revenueByCategory = $this->getRevenueByCategory($rangeStart, $rangeEnd);

        // Top selling products
        $topProducts = $this->getTopSellingProducts($rangeStart, $rangeEnd);

        // Order status distribution
        $orderStatusDistribution = $this->getOrderStatusDistribution($rangeStart, $rangeEnd);

        // ==================== DRIVER METRICS ====================
        $driverStats = $this->buildDriverStats($rangeStart, $rangeEnd);
        $drivers = User::where('role', 'driver')->get();

        // Sort by total deliveries
        // Top performing drivers
        $topDrivers = array_slice($driverStats, 0, 5);

        // Driver performance trend (weekly)
        $driverWeeklyPerformance = $this->getDriverWeeklyPerformance($rangeStart);

        // ==================== SUMMARY STATS ====================
        
        $summaryStats = [
            'total_revenue' => $financialTotalRevenue,
            'revenue_growth' => $revenueGrowth,
            'total_orders' => $totalOrders,
            'orders_growth' => $ordersGrowth,
            'avg_order_value' => $avgOrderValue,
            'total_drivers' => $drivers->count(),
            'active_drivers' => collect($driverStats)->where('active_orders', '>', 0)->count(),
            'total_deliveries' => collect($driverStats)->sum('total_deliveries'),
            'total_commission' => collect($driverStats)->sum('commission_earned'),
        ];

        return view('admin.reports.index', compact(
            'summaryStats',
            'dailyRevenue',
            'monthlyRevenue',
            'revenueByPayment',
            'revenueByCategory',
            'topProducts',
            'orderStatusDistribution',
            'driverStats',
            'topDrivers',
            'driverWeeklyPerformance',
            'dateFrom',
            'dateTo'
        ));
    }

    /**
     * Get daily revenue data for the chart.
     */
    private function getDailyRevenueData(Carbon $rangeStart, Carbon $rangeEnd)
    {
        $revenue = Order::where('status', 'delivered')
            ->whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as revenue, COUNT(*) as orders')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return $revenue->map(function($item) {
            return [
                'date' => $item->date,
                'label' => date('M d', strtotime($item->date)),
                'revenue' => round($item->revenue, 2),
                'orders' => $item->orders,
            ];
        });
    }

    /**
     * Get monthly revenue data for comparison.
     */
    private function getMonthlyRevenueData()
    {
        $lastMonthDate = now()->copy()->subMonth();

        $currentMonth = Order::where('status', 'delivered')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        $lastMonth = Order::where('status', 'delivered')
            ->whereMonth('created_at', $lastMonthDate->month)
            ->whereYear('created_at', $lastMonthDate->year)
            ->sum('total_amount');

        $currentMonthOrders = Order::where('status', 'delivered')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $lastMonthOrders = Order::where('status', 'delivered')
            ->whereMonth('created_at', $lastMonthDate->month)
            ->whereYear('created_at', $lastMonthDate->year)
            ->count();

        return [
            'current_month_revenue' => round($currentMonth, 2),
            'last_month_revenue' => round($lastMonth, 2),
            'current_month_orders' => $currentMonthOrders,
            'last_month_orders' => $lastMonthOrders,
            'revenue_growth' => $lastMonth > 0 
                ? round((($currentMonth - $lastMonth) / $lastMonth) * 100, 2) 
                : 0,
            'orders_growth' => $lastMonthOrders > 0 
                ? round((($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100, 2) 
                : 0,
        ];
    }

    /**
     * Get revenue by category.
     */
    private function getRevenueByCategory(Carbon $rangeStart, Carbon $rangeEnd)
    {
        $categoryRevenue = OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'delivered')
            ->whereBetween('orders.created_at', [$rangeStart, $rangeEnd])
            ->select('categories.name as category',
                     DB::raw('SUM(order_items.total) as revenue'),
                     DB::raw('SUM(order_items.quantity) as quantity_sold'))
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('revenue')
            ->get();

        return $categoryRevenue;
    }

    /**
     * Get top selling products.
     */
    private function getTopSellingProducts(Carbon $rangeStart, Carbon $rangeEnd)
    {
        $topProductStats = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'delivered')
            ->whereBetween('orders.created_at', [$rangeStart, $rangeEnd])
            ->select(
                'order_items.product_id',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.total) as revenue')
            )
            ->groupBy('order_items.product_id')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        if ($topProductStats->isEmpty()) {
            return collect();
        }

        $productIds = $topProductStats->pluck('product_id')->filter()->values();
        $products = Product::with('primaryImage')
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        return $topProductStats->map(function ($stat) use ($products) {
            $product = $products->get($stat->product_id);
            $imagePath = null;

            if ($product) {
                if (!empty($product->primaryImage?->image_path)) {
                    $imagePath = $product->primaryImage->image_path;
                } elseif (is_array($product->images) && !empty($product->images[0])) {
                    $imagePath = $product->images[0];
                } elseif (!empty($product->getRawOriginal('image'))) {
                    $imagePath = $product->getRawOriginal('image');
                }
            }

            return (object) [
                'id' => $stat->product_id,
                'name' => $product?->name ?? ('Product #' . $stat->product_id),
                'image' => $imagePath,
                'image_url' => $this->buildImageUrl($imagePath),
                'total_sold' => (int) $stat->total_sold,
                'revenue' => (float) $stat->revenue,
            ];
        });
    }

    /**
     * Build a browser-safe image URL from a stored path.
     */
    private function buildImageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        $normalized = trim($path);
        if ($normalized === '') {
            return null;
        }

        if (Str::startsWith($normalized, ['http://', 'https://', '//'])) {
            return $normalized;
        }

        if (Str::startsWith($normalized, ['/storage/', 'storage/'])) {
            return asset(ltrim($normalized, '/'));
        }

        return asset('storage/' . ltrim($normalized, '/'));
    }

    /**
     * Get order status distribution.
     */
    private function getOrderStatusDistribution(Carbon $rangeStart, Carbon $rangeEnd)
    {
        $statusData = Order::whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        $statusMap = [
            'pending' => ['label' => 'Pending', 'color' => '#f59e0b'],
            'confirmed' => ['label' => 'Confirmed', 'color' => '#3b82f6'],
            'preparing' => ['label' => 'Preparing', 'color' => '#8b5cf6'],
            'shipped' => ['label' => 'Shipped', 'color' => '#06b6d4'],
            'out_for_delivery' => ['label' => 'Out for Delivery', 'color' => '#f97316'],
            'delivered' => ['label' => 'Delivered', 'color' => '#10b981'],
            'cancelled' => ['label' => 'Cancelled', 'color' => '#ef4444'],
        ];

        return $statusData->map(function($item) use ($statusMap) {
            $status = $item->status;
            $info = $statusMap[$status] ?? ['label' => ucfirst($status), 'color' => '#64748b'];
            return [
                'status' => $status,
                'label' => $info['label'],
                'count' => $item->count,
                'color' => $info['color'],
            ];
        });
    }

    /**
     * Calculate average delivery time for a driver's orders.
     */
    private function calculateAvgDeliveryTime($orders)
    {
        if ($orders->isEmpty()) {
            return 'N/A';
        }

        $totalMinutes = 0;
        $count = 0;

        foreach ($orders as $order) {
            if ($order->created_at && $order->updated_at) {
                $diff = $order->created_at->diff($order->updated_at);
                $minutes = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;
                $totalMinutes += $minutes;
                $count++;
            }
        }

        if ($count === 0) {
            return 'N/A';
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
     * Calculate driver success rate.
     */
    private function calculateDriverSuccessRate($driverId, Carbon $rangeStart, Carbon $rangeEnd)
    {
        $total = Order::where('driver_id', $driverId)
            ->whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->count();

        $delivered = Order::where('driver_id', $driverId)
            ->where('status', 'delivered')
            ->whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->count();

        if ($total === 0) {
            return 0;
        }

        return round(($delivered / $total) * 100, 1);
    }

    /**
     * Calculate driver rating.
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
     * Get driver weekly performance data.
     */
    private function getDriverWeeklyPerformance(Carbon $rangeStart)
    {
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $data = [];
        $weekStart = (clone $rangeStart)->startOfWeek();

        foreach ($days as $index => $day) {
            $startOfDay = (clone $weekStart)->addDays($index)->startOfDay();
            $endOfDay = (clone $weekStart)->addDays($index)->endOfDay();

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
     * Build driver performance metrics for a date range.
     */
    private function buildDriverStats(Carbon $rangeStart, Carbon $rangeEnd): array
    {
        $drivers = User::where('role', 'driver')->get();
        $commissionRate = (float) config('app.driver_commission_rate', 0.10);
        $driverStats = [];

        foreach ($drivers as $driver) {
            $deliveredOrders = Order::where('driver_id', $driver->id)
                ->where('status', 'delivered')
                ->whereBetween('created_at', [$rangeStart, $rangeEnd])
                ->get();

            $totalDeliveries = $deliveredOrders->count();
            $driverRevenue = (float) $deliveredOrders->sum('total_amount');
            $codCollected = (float) $deliveredOrders->whereIn('payment_method', ['cash', 'cod'])->sum('total_amount');

            $driverStats[] = [
                'id' => $driver->id,
                'name' => $driver->name,
                'email' => $driver->email,
                'phone' => $driver->phone_number,
                'avatar' => $driver->avatar ?? $driver->profile_photo_path,
                'total_deliveries' => $totalDeliveries,
                'total_revenue' => $driverRevenue,
                'commission_earned' => $driverRevenue * $commissionRate,
                'cod_collected' => $codCollected,
                'avg_delivery_time' => $this->calculateAvgDeliveryTime($deliveredOrders),
                'success_rate' => $this->calculateDriverSuccessRate($driver->id, $rangeStart, $rangeEnd),
                'rating' => $this->calculateDriverRating($driver->id),
                'active_orders' => Order::where('driver_id', $driver->id)
                    ->whereIn('status', ['out_for_delivery', 'arrived'])
                    ->count(),
            ];
        }

        usort($driverStats, function ($a, $b) {
            return $b['total_deliveries'] <=> $a['total_deliveries'];
        });

        return $driverStats;
    }

    /**
     * Export financial report.
     */
    public function exportFinancial(Request $request)
    {
        [$dateFrom, $dateTo, $rangeStart, $rangeEnd] = $this->parseDateRange($request);

        $orders = Order::whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->with(['customer', 'driver'])
            ->orderBy('created_at')
            ->get();

        $totalOrders = $orders->count();
        $deliveredRevenue = (float) $orders->where('status', 'delivered')->sum('total_amount');
        $averageOrder = $totalOrders > 0 ? (float) $orders->avg('total_amount') : 0;
        $filename = "financial-report-{$dateFrom}-to-{$dateTo}.csv";

        return response()->streamDownload(function () use ($orders, $dateFrom, $dateTo, $totalOrders, $deliveredRevenue, $averageOrder) {
            $output = fopen('php://output', 'w');
            fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($output, ['Financial Report']);
            fputcsv($output, ['Period', $dateFrom . ' to ' . $dateTo]);
            fputcsv($output, ['Total Orders', $totalOrders]);
            fputcsv($output, ['Delivered Revenue', number_format($deliveredRevenue, 2, '.', '')]);
            fputcsv($output, ['Average Order Value', number_format($averageOrder, 2, '.', '')]);
            fputcsv($output, []);
            fputcsv($output, ['Order ID', 'Date', 'Customer', 'Driver', 'Status', 'Payment Method', 'Payment Status', 'Total Amount']);

            foreach ($orders as $order) {
                fputcsv($output, [
                    $order->id,
                    optional($order->created_at)->format('Y-m-d H:i:s'),
                    optional($order->customer)->name ?? 'N/A',
                    optional($order->driver)->name ?? 'Unassigned',
                    $order->status,
                    $order->payment_method ?? '',
                    $order->payment_status ?? '',
                    number_format((float) $order->total_amount, 2, '.', ''),
                ]);
            }

            fclose($output);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Cache-Control' => 'no-store, no-cache',
        ]);
    }

    /**
     * Export driver report.
     */
    public function exportDriver(Request $request)
    {
        [$dateFrom, $dateTo, $rangeStart, $rangeEnd] = $this->parseDateRange($request);
        $driverStats = $this->buildDriverStats($rangeStart, $rangeEnd);
        $filename = "driver-report-{$dateFrom}-to-{$dateTo}.csv";

        return response()->streamDownload(function () use ($driverStats, $dateFrom, $dateTo) {
            $output = fopen('php://output', 'w');
            fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($output, ['Driver Report']);
            fputcsv($output, ['Period', $dateFrom . ' to ' . $dateTo]);
            fputcsv($output, []);
            fputcsv($output, ['Driver Name', 'Email', 'Phone', 'Total Deliveries', 'Total Revenue', 'Commission Earned', 'COD Collected', 'Success Rate (%)', 'Rating', 'Active Orders', 'Avg Delivery Time']);

            foreach ($driverStats as $driver) {
                fputcsv($output, [
                    $driver['name'],
                    $driver['email'],
                    $driver['phone'] ?? '',
                    $driver['total_deliveries'],
                    number_format((float) $driver['total_revenue'], 2, '.', ''),
                    number_format((float) $driver['commission_earned'], 2, '.', ''),
                    number_format((float) $driver['cod_collected'], 2, '.', ''),
                    $driver['success_rate'],
                    $driver['rating'],
                    $driver['active_orders'],
                    $driver['avg_delivery_time'],
                ]);
            }

            fclose($output);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Cache-Control' => 'no-store, no-cache',
        ]);
    }

    /**
     * Export combined financial and driver report as PDF.
     */
    public function exportPdf(Request $request)
    {
        [$dateFrom, $dateTo, $rangeStart, $rangeEnd] = $this->parseDateRange($request);

        $orders = Order::whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->with(['customer', 'driver'])
            ->orderByDesc('created_at')
            ->get();

        $deliveredOrders = $orders->where('status', 'delivered');
        $driverStats = $this->buildDriverStats($rangeStart, $rangeEnd);
        $topDrivers = array_slice($driverStats, 0, 10);

        $revenueByPayment = Order::where('status', 'delivered')
            ->whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->select('payment_method', DB::raw('SUM(total_amount) as total'), DB::raw('COUNT(*) as count'))
            ->groupBy('payment_method')
            ->orderByDesc('total')
            ->get();

        $summary = [
            'total_orders' => $orders->count(),
            'delivered_orders' => $deliveredOrders->count(),
            'delivered_revenue' => (float) $deliveredOrders->sum('total_amount'),
            'average_order_value' => $orders->count() > 0 ? (float) $orders->avg('total_amount') : 0,
            'total_drivers' => count($driverStats),
            'total_deliveries' => (int) collect($driverStats)->sum('total_deliveries'),
            'total_commission' => (float) collect($driverStats)->sum('commission_earned'),
        ];

        $pdf = Pdf::loadView('admin.reports.pdf', [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'generatedAt' => now(),
            'summary' => $summary,
            'revenueByPayment' => $revenueByPayment,
            'topDrivers' => $topDrivers,
            'orders' => $orders->take(40),
        ])->setPaper('a4', 'portrait');

        return $pdf->download("reports-{$dateFrom}-to-{$dateTo}.pdf");
    }

    /**
     * Normalize and validate report date range.
     */
    private function parseDateRange(Request $request): array
    {
        $rawDateFrom = $request->get('date_from', now()->startOfMonth()->toDateString());
        $rawDateTo = $request->get('date_to', now()->toDateString());

        try {
            $rangeStart = Carbon::parse($rawDateFrom)->startOfDay();
        } catch (\Throwable $e) {
            $rangeStart = now()->startOfMonth()->startOfDay();
        }

        try {
            $rangeEnd = Carbon::parse($rawDateTo)->endOfDay();
        } catch (\Throwable $e) {
            $rangeEnd = now()->endOfDay();
        }

        if ($rangeStart->gt($rangeEnd)) {
            [$rangeStart, $rangeEnd] = [$rangeEnd, $rangeStart];
        }

        return [
            $rangeStart->toDateString(),
            $rangeEnd->toDateString(),
            $rangeStart,
            $rangeEnd,
        ];
    }
}
