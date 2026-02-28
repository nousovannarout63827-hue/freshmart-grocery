<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PromotionController extends Controller
{
    /**
     * Display a listing of coupons/promotions.
     */
    public function index(Request $request)
    {
        $query = Coupon::latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Search by code or name
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('code', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        }

        $coupons = $query->paginate(15);

        $stats = [
            'total' => Coupon::count(),
            'active' => Coupon::where('status', true)->count(),
            'expired' => Coupon::where('expires_at', '<', now())->orWhere('status', false)->count(),
            'usage' => 0, // Not available in current schema
        ];

        return view('admin.promotions.index', compact('coupons', 'stats'));
    }

    /**
     * Show the form for creating a new coupon.
     */
    public function create()
    {
        $customers = User::where('role', 'customer')->get();
        $products = Product::all();
        $categories = Category::all();

        return view('admin.promotions.create', compact('customers', 'products', 'categories'));
    }

    /**
     * Store a newly created coupon in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'type' => 'required|in:percentage,fixed,free_delivery',
            'value' => 'required|numeric|min:0',
            'scope' => 'required|in:all_products,specific_products,specific_categories',
            'product_ids' => 'nullable|array',
            'category_ids' => 'nullable|array',
            'target_type' => 'required|in:all_customers,specific_customers',
            'customer_ids' => 'nullable|array',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after:valid_from',
            'usage_limit' => 'nullable|integer|min:0',
            'min_purchase_amount' => 'nullable|numeric|min:0',
            'status' => 'boolean',
            'auto_apply' => 'boolean',
        ]);

        $validated['product_ids'] = $validated['scope'] === 'specific_products' 
            ? json_encode($request->product_ids ?? []) 
            : null;

        $validated['category_ids'] = $validated['scope'] === 'specific_categories' 
            ? json_encode($request->category_ids ?? []) 
            : null;

        $validated['customer_ids'] = $validated['target_type'] === 'specific_customers' 
            ? json_encode($request->customer_ids ?? []) 
            : null;

        $validated['status'] = $request->has('status');
        $validated['auto_apply'] = $request->has('auto_apply');
        $validated['created_by'] = auth()->id();
        
        // Map new fields to existing database columns
        $validated['min_purchase'] = $validated['min_purchase_amount'] ?? 0;
        $validated['expires_at'] = $validated['valid_until'] ?? null;

        Coupon::create($validated);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion created successfully!');
    }

    /**
     * Display the specified coupon.
     */
    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.promotions.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified coupon.
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        $customers = User::where('role', 'customer')->get();
        $products = Product::all();
        $categories = Category::all();

        // Decode JSON fields
        $coupon->product_ids = json_decode($coupon->product_ids, true) ?? [];
        $coupon->category_ids = json_decode($coupon->category_ids, true) ?? [];
        $coupon->customer_ids = json_decode($coupon->customer_ids, true) ?? [];

        return view('admin.promotions.edit', compact('coupon', 'customers', 'products', 'categories'));
    }

    /**
     * Update the specified coupon in storage.
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code,' . $id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'type' => 'required|in:percentage,fixed,free_delivery',
            'value' => 'required|numeric|min:0',
            'scope' => 'required|in:all_products,specific_products,specific_categories',
            'product_ids' => 'nullable|array',
            'category_ids' => 'nullable|array',
            'target_type' => 'required|in:all_customers,specific_customers',
            'customer_ids' => 'nullable|array',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after:valid_from',
            'usage_limit' => 'nullable|integer|min:0',
            'min_purchase_amount' => 'nullable|numeric|min:0',
            'status' => 'boolean',
            'auto_apply' => 'boolean',
        ]);

        $validated['product_ids'] = $validated['scope'] === 'specific_products' 
            ? json_encode($request->product_ids ?? []) 
            : null;

        $validated['category_ids'] = $validated['scope'] === 'specific_categories' 
            ? json_encode($request->category_ids ?? []) 
            : null;

        $validated['customer_ids'] = $validated['target_type'] === 'specific_customers' 
            ? json_encode($request->customer_ids ?? []) 
            : null;

        $validated['status'] = $request->has('status');
        $validated['auto_apply'] = $request->has('auto_apply');
        
        // Map new fields to existing database columns
        $validated['min_purchase'] = $validated['min_purchase_amount'] ?? 0;
        $validated['expires_at'] = $validated['valid_until'] ?? null;

        $coupon->update($validated);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion updated successfully!');
    }

    /**
     * Remove the specified coupon from storage.
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion deleted successfully!');
    }

    /**
     * Give promotion to selected customers via notification.
     */
    public function giveToCustomers(Request $request)
    {
        $validated = $request->validate([
            'coupon_id' => 'required|exists:coupons,id',
            'customer_ids' => 'nullable|array',
            'target_all' => 'boolean',
            'message' => 'nullable|string|max:500',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $coupon = Coupon::findOrFail($request->coupon_id);

        // Get target customers
        if ($request->target_all) {
            $customers = User::where('role', 'customer')->get();
        } else {
            $customers = User::whereIn('id', $request->customer_ids ?? [])
                ->where('role', 'customer')
                ->get();
        }

        if ($customers->isEmpty()) {
            return back()->with('error', 'No customers selected.');
        }

        // Create notifications for each customer
        $count = 0;
        $expiresAt = $validated['expires_at'] ?? null;
        foreach ($customers as $customer) {
            \DB::table('notifications')->insert([
                'id' => \Str::uuid(),
                'type' => 'promotion',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => $customer->id,
                'data' => json_encode([
                    'title' => '🎉 Special Discount Just for You!',
                    'message' => $request->message ?? "You've received a special discount: {$coupon->code} - {$coupon->name}",
                    'coupon_id' => $coupon->id,
                    'coupon_code' => $coupon->code,
                    'discount_value' => $coupon->value,
                    'discount_type' => $coupon->type,
                    'expires_at' => $expiresAt,
                    'expires_formatted' => $expiresAt ? \Carbon\Carbon::parse($expiresAt)->format('M d, Y \a\t g:i A') : 'No expiry',
                ]),
                'read_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $count++;
        }

        return back()->with('success', "Promotion sent to {$count} customer(s) successfully!" . ($expiresAt ? " Expires: " . \Carbon\Carbon::parse($expiresAt)->format('M d, Y') : ''));
    }

    /**
     * Create a flash sale (time-limited discount for all customers).
     */
    public function createFlashSale(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'discount_percent' => 'required|numeric|min:1|max:100',
            'duration_hours' => 'required|numeric|min:1|max:168', // Max 1 week
            'scope' => 'required|in:all_products,specific_products,specific_categories',
            'product_ids' => 'nullable|array',
            'category_ids' => 'nullable|array',
            'min_purchase_amount' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $now = now();
            $validUntil = $now->copy()->addHours($validated['duration_hours']);

            // Create coupon
            $coupon = Coupon::create([
                'code' => 'FLASH_' . strtoupper(substr(md5(time()), 0, 8)),
                'name' => $validated['name'],
                'description' => "Flash Sale: {$validated['discount_percent']}% OFF for {$validated['duration_hours']} hours!",
                'type' => 'percentage',
                'value' => $validated['discount_percent'],
                'scope' => $validated['scope'],
                'product_ids' => $validated['scope'] === 'specific_products' 
                    ? json_encode($validated['product_ids'] ?? []) 
                    : null,
                'category_ids' => $validated['scope'] === 'specific_categories' 
                    ? json_encode($validated['category_ids'] ?? []) 
                    : null,
                'target_type' => 'all_customers',
                'customer_ids' => null,
                'valid_from' => $now,
                'valid_until' => $validUntil,
                'usage_limit' => 0, // Unlimited
                'usage_count' => 0,
                'min_purchase_amount' => $validated['min_purchase_amount'] ?? 0,
                'is_active' => true,
                'auto_apply' => false,
                'created_by' => auth()->id(),
            ]);

            // Update products if specific products selected
            if ($validated['scope'] === 'specific_products' && !empty($validated['product_ids'])) {
                Product::whereIn('id', $validated['product_ids'])
                    ->update([
                        'is_on_sale' => true,
                        'discount_percent' => $validated['discount_percent'],
                        'discount_price' => DB::raw("price * (1 - {$validated['discount_percent']} / 100)"),
                        'discount_start' => $now,
                        'discount_end' => $validUntil,
                        'sale_label' => "⚡ Flash Sale",
                    ]);
            }

            // Notify all customers
            $customers = User::where('role', 'customer')->get();
            foreach ($customers as $customer) {
                \DB::table('notifications')->insert([
                    'id' => \Str::uuid(),
                    'type' => 'flash_sale',
                    'notifiable_type' => 'App\\Models\\User',
                    'notifiable_id' => $customer->id,
                    'data' => json_encode([
                        'title' => '⚡ Flash Sale Alert!',
                        'message' => "Get {$validated['discount_percent']}% OFF for the next {$validated['duration_hours']} hours! Use code: {$coupon->code}",
                        'coupon_id' => $coupon->id,
                        'coupon_code' => $coupon->code,
                        'discount_percent' => $validated['discount_percent'],
                        'valid_until' => $validUntil->toDateTimeString(),
                    ]),
                    'read_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return redirect()->route('admin.promotions.index')
                ->with('success', "Flash sale created! Valid for {$validated['duration_hours']} hours. Notified {$customers->count()} customers.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create flash sale: ' . $e->getMessage());
        }
    }

    /**
     * Toggle coupon active status.
     */
    public function toggleStatus($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update(['status' => !$coupon->status]);

        return back()->with('success', 'Promotion status updated successfully!');
    }

    /**
     * Display customer-specific promotions.
     */
    public function customerPromotions(Request $request)
    {
        $query = \DB::table('notifications')
            ->where('type', 'promotion')
            ->where('notifiable_type', 'App\\Models\\User')
            ->join('users', 'notifications.notifiable_id', '=', 'users.id')
            ->select('notifications.*', 'users.name as customer_name', 'users.email as customer_email')
            ->orderBy('notifications.created_at', 'desc');

        // Filter by customer
        if ($request->filled('customer_id')) {
            $query->where('notifications.notifiable_id', $request->customer_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'expired') {
                $query->whereRaw('JSON_EXTRACT(data, "$.expires_at") < ?', [now()]);
            } elseif ($request->status === 'active') {
                $query->whereRaw('(JSON_EXTRACT(data, "$.expires_at") IS NULL OR JSON_EXTRACT(data, "$.expires_at") > ?)', [now()]);
            }
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('users.name', 'like', '%' . $request->search . '%')
                  ->orWhere('users.email', 'like', '%' . $request->search . '%');
            });
        }

        $promotions = $query->paginate(20);

        $customers = User::where('role', 'customer')->get();
        $stats = [
            'total' => \DB::table('notifications')->where('type', 'promotion')->count(),
            'active' => \DB::table('notifications')->where('type', 'promotion')
                ->whereRaw('(JSON_EXTRACT(data, "$.expires_at") IS NULL OR JSON_EXTRACT(data, "$.expires_at") > ?)', [now()])->count(),
            'expired' => \DB::table('notifications')->where('type', 'promotion')
                ->whereRaw('JSON_EXTRACT(data, "$.expires_at") < ?', [now()])->count(),
        ];

        return view('admin.customer-promotions.index', compact('promotions', 'customers', 'stats'));
    }

    /**
     * Revoke a customer-specific promotion.
     */
    public function revokeCustomerPromotion($id)
    {
        \DB::table('notifications')->where('id', $id)->delete();
        return back()->with('success', 'Promotion revoked successfully!');
    }
}
