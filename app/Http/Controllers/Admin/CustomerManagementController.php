<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerManagementController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index(Request $request)
    {
        // Search by ID takes priority
        if ($request->filled('id')) {
            $customers = User::where('id', $request->id)
                ->where(function($q) {
                    $q->where('role', 'customer')->orWhereNull('role');
                })
                ->latest()
                ->paginate(15)
                ->appends($request->all());
        } else {
            $query = User::where(function($q) {
                $q->where('role', 'customer')->orWhereNull('role');
            });

            // Search by Name or Email
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
                });
            }

            // Filter by Status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $customers = $query->latest()->paginate(15)->appends($request->all());
        }

        $totalCustomers = User::where('role', 'customer')->orWhereNull('role')->count();
        $activeCustomers = User::where(function($q) {
                $q->where('role', 'customer')->orWhereNull('role');
            })
            ->where('status', 'active')
            ->count();

        return view('admin.customers.index', compact('customers', 'totalCustomers', 'activeCustomers'));
    }

    /**
     * Display the specified customer.
     */
    public function show($id)
    {
        // 1. Fetch user with their orders and items
        $user = User::with(['orders.orderItems.product'])->findOrFail($id);

        // 2. Get Statistics
        $totalOrders = $user->orders()->count();
        $pendingOrders = $user->orders()->whereIn('status', ['pending', 'confirmed', 'preparing'])->count();
        $completedOrders = $user->orders()->where('status', 'delivered')->count();
        $totalSpent = $user->orders()->where('status', 'delivered')->sum('total_amount');

        // 3. Get the paginated order history list
        $orders = $user->orders()->latest()->paginate(10);

        return view('admin.customers.show', compact('user', 'totalOrders', 'pendingOrders', 'completedOrders', 'totalSpent', 'orders'));
    }

    /**
     * Toggle customer status (active/suspended).
     */
    public function toggleStatus($id)
    {
        $customer = User::where('id', $id)
            ->where(function($q) {
                $q->where('role', 'customer')->orWhereNull('role');
            })
            ->firstOrFail();
        
        // Toggle the status
        $customer->status = $customer->status === 'active' ? 'inactive' : 'active';
        $customer->save();

        $statusLabel = $customer->status === 'active' ? 'Activated' : 'Suspended';

        // Log this action
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'customer_status_change',
            'module' => 'Customer Management',
            'description' => "{$statusLabel} customer account: {$customer->email}",
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', "Customer account has been {$statusLabel}.");
    }

    /**
     * Update customer role.
     */
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:customer,staff',
        ]);

        $customer = User::where('id', $id)
            ->where(function($q) {
                $q->where('role', 'customer')->orWhereNull('role');
            })
            ->firstOrFail();
        
        $oldRole = $customer->role ?? 'customer';
        $customer->role = $request->role;
        $customer->save();

        // Log this action
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'customer_role_change',
            'module' => 'Customer Management',
            'description' => "Changed role from {$oldRole} to {$request->role} for: {$customer->email}",
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', "Customer role updated to {$request->role}.");
    }

    /**
     * Delete customer account.
     */
    public function destroy($id)
    {
        $customer = User::where('id', $id)
            ->where(function($q) {
                $q->where('role', 'customer')->orWhereNull('role');
            })
            ->firstOrFail();
        
        // Check if customer has orders
        $orderCount = DB::table('orders')->where('customer_id', $id)->count();
        
        if ($orderCount > 0) {
            return back()->with('error', "Cannot delete customer with {$orderCount} order(s).");
        }
        
        $customerName = $customer->name;
        $customer->delete();

        // Log this action
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'customer_deleted',
            'module' => 'Customer Management',
            'description' => "Deleted customer account: {$customerName}",
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', "Customer account has been deleted.");
    }
}
