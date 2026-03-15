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
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:fixed,percent,percentage,free_delivery',
            'value' => 'required|numeric|min:0|max:999999.99',
            'scope' => 'nullable|in:all_products,specific_products,specific_categories',
            'category_ids' => 'nullable|array',
            'product_ids' => 'nullable|array',
            'target_type' => 'nullable|in:all_customers,specific_customers',
            'customer_ids' => 'nullable|array',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after:valid_from',
            'usage_limit' => 'nullable|integer|min:0',
            'min_purchase' => 'nullable|numeric|min:0|max:999999.99',
            'status' => 'required|boolean',
            'auto_apply' => 'nullable|boolean',
            'expires_at' => 'nullable|date|after:today',
        ]);

        // Normalize 'percentage' to 'percent' for database
        $type = $request->type === 'percentage' ? 'percent' : $request->type;

        Coupon::create([
            'code' => strtoupper(trim($request->code)),
            'name' => $request->name,
            'description' => $request->description,
            'type' => $type,
            'value' => $request->value,
            'scope' => $request->scope ?? 'all_products',
            'category_ids' => $request->category_ids,
            'product_ids' => $request->product_ids,
            'target_type' => $request->target_type ?? 'all_customers',
            'customer_ids' => $request->customer_ids,
            'valid_from' => $request->valid_from ? Carbon::parse($request->valid_from) : null,
            'valid_until' => $request->valid_until ? Carbon::parse($request->valid_until) : null,
            'usage_limit' => $request->usage_limit ?? 0,
            'min_purchase' => $request->min_purchase ?? 0,
            'status' => $request->status,
            'auto_apply' => $request->auto_apply ?? false,
            'created_by' => auth()->id(),
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
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:fixed,percent,percentage,free_delivery',
            'value' => 'required|numeric|min:0|max:999999.99',
            'scope' => 'nullable|in:all_products,specific_products,specific_categories',
            'category_ids' => 'nullable|array',
            'product_ids' => 'nullable|array',
            'target_type' => 'nullable|in:all_customers,specific_customers',
            'customer_ids' => 'nullable|array',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after:valid_from',
            'usage_limit' => 'nullable|integer|min:0',
            'min_purchase' => 'nullable|numeric|min:0|max:999999.99',
            'status' => 'required|boolean',
            'auto_apply' => 'nullable|boolean',
            'expires_at' => 'nullable|date|after:today',
        ]);

        // Normalize 'percentage' to 'percent' for database
        $type = $request->type === 'percentage' ? 'percent' : $request->type;

        $coupon->update([
            'code' => strtoupper(trim($request->code)),
            'name' => $request->name,
            'description' => $request->description,
            'type' => $type,
            'value' => $request->value,
            'scope' => $request->scope ?? 'all_products',
            'category_ids' => $request->category_ids,
            'product_ids' => $request->product_ids,
            'target_type' => $request->target_type ?? 'all_customers',
            'customer_ids' => $request->customer_ids,
            'valid_from' => $request->valid_from ? Carbon::parse($request->valid_from) : null,
            'valid_until' => $request->valid_until ? Carbon::parse($request->valid_until) : null,
            'usage_limit' => $request->usage_limit ?? 0,
            'min_purchase' => $request->min_purchase ?? 0,
            'status' => $request->status,
            'auto_apply' => $request->auto_apply ?? false,
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
