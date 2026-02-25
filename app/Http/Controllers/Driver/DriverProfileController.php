<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverProfileController extends Controller
{
    /**
     * Show driver profile information and earnings history.
     */
    public function show()
    {
        $user = auth()->user();
        $commissionRate = (float) config('app.driver_commission_rate', 0.10);

        $deliveredBase = Order::where('driver_id', $user->id)
            ->where('status', 'delivered');

        $totalDeliveries = (clone $deliveredBase)->count();
        $totalRevenue = (float) (clone $deliveredBase)->sum('total_amount');
        $totalEarnings = $totalRevenue * $commissionRate;

        $monthRevenue = (float) (clone $deliveredBase)
            ->whereYear('updated_at', now()->year)
            ->whereMonth('updated_at', now()->month)
            ->sum('total_amount');

        $weekRevenue = (float) (clone $deliveredBase)
            ->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('total_amount');

        $todayRevenue = (float) (clone $deliveredBase)
            ->whereDate('updated_at', today())
            ->sum('total_amount');

        $monthlyRows = (clone $deliveredBase)
            ->whereDate('updated_at', '>=', now()->copy()->subMonths(5)->startOfMonth()->toDateString())
            ->selectRaw('YEAR(updated_at) as year_num, MONTH(updated_at) as month_num, COUNT(*) as deliveries, COALESCE(SUM(total_amount), 0) as revenue')
            ->groupBy('year_num', 'month_num')
            ->orderBy('year_num')
            ->orderBy('month_num')
            ->get()
            ->keyBy(function ($row) {
                return sprintf('%04d-%02d', $row->year_num, $row->month_num);
            });

        $earningsHistory = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->copy()->subMonths($i);
            $monthKey = $month->format('Y-m');
            $row = $monthlyRows->get($monthKey);
            $revenue = (float) ($row->revenue ?? 0);

            $earningsHistory[] = [
                'label' => $month->format('M'),
                'month_label' => $month->format('M Y'),
                'deliveries' => (int) ($row->deliveries ?? 0),
                'revenue' => $revenue,
                'earnings' => $revenue * $commissionRate,
            ];
        }

        $maxHistoryEarnings = max(1, max(array_column($earningsHistory, 'earnings')));

        $recentEarnings = (clone $deliveredBase)
            ->with('customer')
            ->latest('updated_at')
            ->take(10)
            ->get();

        $stats = [
            'total_deliveries' => $totalDeliveries,
            'total_earnings' => $totalEarnings,
            'month_earnings' => $monthRevenue * $commissionRate,
            'week_earnings' => $weekRevenue * $commissionRate,
            'today_earnings' => $todayRevenue * $commissionRate,
            'avg_earnings_per_delivery' => $totalDeliveries > 0 ? ($totalEarnings / $totalDeliveries) : 0,
        ];

        return view('driver.profile', compact(
            'user',
            'commissionRate',
            'stats',
            'earningsHistory',
            'maxHistoryEarnings',
            'recentEarnings'
        ));
    }

    /**
     * Update basic driver information.
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'gender' => ['nullable', 'in:male,female,other'],
            'dob' => ['nullable', 'date'],
            'current_address' => ['nullable', 'string', 'max:500'],
            'bio' => ['nullable', 'string', 'max:1000'],
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone'] ?? null,
            'gender' => $data['gender'] ?? null,
            'dob' => $data['dob'] ?? null,
            'current_address' => $data['current_address'] ?? null,
            'bio' => $data['bio'] ?? null,
        ]);

        ActivityLog::log(
            'Updated Profile',
            'Driver Profile',
            'Driver ' . $user->name . ' updated profile information'
        );

        return redirect()->route('driver.profile')->with('success', 'Profile information updated successfully.');
    }

    /**
     * Update driver profile photo.
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $user = auth()->user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $path = $request->file('photo')->store('profile-photos', 'public');

        $user->update([
            'avatar' => $path,
            'profile_photo_path' => $path,
        ]);

        ActivityLog::log(
            'Updated Profile Photo',
            'Driver Profile',
            'Driver ' . $user->name . ' updated profile photo'
        );

        return redirect()->route('driver.profile')->with('success', 'Profile photo updated successfully.');
    }
}
