<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    /**
     * Display a listing of coupons.
     */
    public function index()
    {
        $coupons = Coupon::latest()->paginate(15);
        
        // 1. Total Coupons
        $totalCoupons = Coupon::count();
        
        // 2. Disabled Coupons (Turned off manually)
        $disabledCount = Coupon::where('status', 0)->count();
        
        // 3. Expired Coupons (Turned ON, but the date is in the past)
        $expiredCount = Coupon::where('status', 1)
                              ->whereNotNull('expires_at')
                              ->whereDate('expires_at', '<', Carbon::today())
                              ->count();
                              
        // 4. Truly Active Coupons (Turned ON, AND date is valid or never expires)
        $activeCount = Coupon::where('status', 1)
                             ->where(function($query) {
                                 $query->whereNull('expires_at')
                                       ->orWhereDate('expires_at', '>=', Carbon::today());
                             })
                             ->count();

        $stats = [
            'total' => $totalCoupons,
            'active' => $activeCount,
            'expired' => $expiredCount,
            'disabled' => $disabledCount,
        ];

        return view('admin.coupons.index', compact('coupons', 'stats'));
    }

    /**
     * Show the form for creating a new coupon.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created coupon in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0|max:999999.99',
            'min_purchase' => 'nullable|numeric|min:0|max:999999.99',
            'status' => 'required|boolean',
            'expires_at' => 'nullable|date|after:today',
        ]);

        Coupon::create([
            'code' => strtoupper(trim($request->code)),
            'type' => $request->type,
            'value' => $request->value,
            'min_purchase' => $request->min_purchase ?? 0,
            'status' => $request->status,
            'expires_at' => $request->expires_at ? Carbon::parse($request->expires_at) : null,
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully!');
    }

    /**
     * Show the form for editing the specified coupon.
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified coupon in storage.
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code,' . $id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0|max:999999.99',
            'min_purchase' => 'nullable|numeric|min:0|max:999999.99',
            'status' => 'required|boolean',
            'expires_at' => 'nullable|date|after:today',
        ]);

        $coupon->update([
            'code' => strtoupper(trim($request->code)),
            'type' => $request->type,
            'value' => $request->value,
            'min_purchase' => $request->min_purchase ?? 0,
            'status' => $request->status,
            'expires_at' => $request->expires_at ? Carbon::parse($request->expires_at) : null,
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully!');
    }

    /**
     * Remove the specified coupon from storage.
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully!');
    }
}
