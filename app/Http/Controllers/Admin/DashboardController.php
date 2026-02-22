<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch counts for the sidebar and dashboard cards
        $categoriesCount = Category::count();
        $productsCount = Product::count();
        $usersCount = User::where('role', 'customer')->count();
        $totalOrders = Order::count();

        // 1. Get ONLY items with 0 stock (Critical)
        $outOfStockItems = Product::with('category')->where('stock', 0)->take(10)->get();
        $outOfStockCount = Product::where('stock', 0)->count(); // Better to query the total count directly

        // 2. Get ONLY items between 1 and 10 (Warning)
        $lowStockItems = Product::with('category')
            ->where('stock', '>', 0)
            ->where('stock', '<=', 10) // Hardcoded to 10 to match our new database setup
            ->take(10)
            ->get();
        $lowStockCount = Product::where('stock', '>', 0)->where('stock', '<=', 10)->count();

        // Calculate order statistics
        $deliveredItems = Order::where('status', 'delivered')->count();
        $pendingItems = Order::whereIn('status', ['pending', 'ready_for_pickup'])->count();
        $canceledOrders = Order::where('status', 'cancelled')->count();
        
        // Calculate Monthly Revenue for the chart
        $monthlySales = Order::selectRaw('SUM(total_amount) as sum, MONTHNAME(created_at) as month')
            ->where('status', 'delivered')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderByRaw('MIN(created_at)')
            ->get();

        $labels = $monthlySales->pluck('month');
        $data = $monthlySales->pluck('sum');
        $soldAmount = Order::where('status', 'delivered')->sum('total_amount'); // Total for sold amount card

        // Weekly Sales Data (Last 7 days)
        $weeklySales = [];
        $weeklyLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dayLabel = $date->format('D');
            $daySales = Order::where('status', 'delivered')
                ->whereDate('created_at', $date)
                ->sum('total_amount');
            $weeklySales[] = $daySales;
            $weeklyLabels[] = $dayLabel;
        }

        // Order Status Distribution for Pie Chart
        $orderStatusData = [
            'pending' => Order::where('status', 'pending')->count(),
            'confirmed' => Order::where('status', 'confirmed')->count(),
            'preparing' => Order::where('status', 'preparing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'out_for_delivery' => Order::whereIn('status', ['out_for_delivery', 'out for delivery'])->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        // Fetch the top 5 customers based on their total successful spending
        $topCustomers = User::where('role', 'customer')
            ->orWhereNull('role')
            ->withCount(['orders as total_spent' => function($query) {
                $query->where('status', 'delivered')->select(DB::raw('SUM(total_amount)'));
            }])
            ->orderByDesc('total_spent')
            ->take(5)
            ->get();

        // Calculate feedbacks count (assuming you have a feedbacks table)
        $feedbacksCount = 3; // Replace with actual query when feedbacks table exists

        return view('admin.dashboard', compact(
            'categoriesCount',
            'productsCount',
            'usersCount',
            'totalOrders',
            'deliveredItems',
            'pendingItems',
            'canceledOrders',
            'outOfStockItems',
            'outOfStockCount',
            'lowStockItems',
            'lowStockCount',
            'soldAmount',
            'labels',
            'data',
            'weeklyLabels',
            'weeklySales',
            'orderStatusData',
            'feedbacksCount',
            'topCustomers'
        ));
    }

    public function products(Request $request)
    {
        // Start the product query with eager loading to prevent N+1 query problem
        $query = \App\Models\Product::with('category')->latest();

        // 1. Text Search Filter
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 2. Category Filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 3. Set a default title
        $pageTitle = 'All Products';

        // 4. Out of Stock Filter (EXACTLY 0 stock)
        if ($request->filled('out_of_stock')) {
            $query->where('quantity', 0);
            $pageTitle = 'Out of Stock Products';
        }

        // 5. Low Stock Filter (between 1 and min_stock_level)
        // Only applies if out_of_stock is not set (they are mutually exclusive)
        if ($request->filled('low_stock') && !$request->filled('out_of_stock')) {
            $query->whereColumn('quantity', '<=', 'min_stock_level')
                  ->where('quantity', '>', 0); // Exclude out of stock items
            $pageTitle = 'Low Stock Products';
        }

        $products = $query->paginate(10)->appends($request->all());

        // Return Partial HTML for AJAX
        if ($request->ajax()) {
            return view('admin.products.partials.table-rows', compact('products'))->render();
        }

        $categories = \App\Models\Category::all();

        // NEW: Always count the total low stock and out of stock items for the badges
        $outOfStockCount = Product::where('quantity', 0)->count();
        $lowStockCount = Product::where('quantity', '>', 0)
            ->whereColumn('quantity', '<=', 'min_stock_level')
            ->count();

        // Pass those two new variables to your view
        return view('admin.products.index', compact('products', 'categories', 'pageTitle', 'outOfStockCount', 'lowStockCount'));
    }

    public function destroyProduct($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product moved to trash!');
    }

    public function driverPerformance()
    {
        // Fetch all drivers and calculate their stats
        $drivers = \App\Models\User::where('role', 'driver')
            ->withCount(['assignedOrders as deliveries_count' => function ($query) {
                $query->where('status', 'delivered');
            }])
            ->withSum(['assignedOrders as total_earned' => function ($query) {
                $query->where('status', 'delivered');
            }], 'total_amount')
            ->get();

        return view('admin.reports.drivers', compact('drivers'));
    }

    public function createProduct()
    {
        // Fetch categories for the dropdown menu
        $categories = \App\Models\Category::all();
        
        return view('admin.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        \App\Models\Product::create([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'quantity' => $data['stock'],
            'image' => $imagePath,
            'min_stock_level' => 5,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    public function editProduct($id)
    {
        // Find the specific product we want to edit
        $product = Product::findOrFail($id);
        
        // Fetch categories for the dropdown menu
        $categories = Category::all();
        
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // 1. Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Handle Image Replacement
        if ($request->hasFile('image')) {
            // If the product already has an image, delete it from the server first!
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            // Save the new image
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // 3. Update the Product Record
        $product->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'quantity' => $validated['stock'],
            'image' => $validated['image'] ?? $product->image,
        ]);

        // 4. Redirect back with a success message
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully!');
    }

    public function trashedProducts()
    {
        // Fetch ONLY the products that were soft-deleted
        $trashedProducts = \App\Models\Product::onlyTrashed()->with('category')->latest()->paginate(10);
        return view('admin.products.trash', compact('trashedProducts'));
    }

    public function restoreProduct($id)
    {
        $product = \App\Models\Product::withTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('admin.products.index')->with('success', 'Product restored!');
    }

    public function bulkDelete(Request $request)
    {
        // Ensure we actually received an array of IDs
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:products,id'
        ]);

        // Get all the products matching these IDs
        $products = Product::whereIn('id', $request->ids)->get();

        foreach ($products as $product) {
            // Soft delete - just marks the product as deleted
            // Image is preserved in case the product is restored later
            $product->delete();
        }

        // Return a JSON success response back to our JavaScript
        return response()->json([
            'success' => true, 
            'message' => 'Products moved to trash successfully.'
        ]);
    }

    public function bulkRestore(Request $request)
    {
        $ids = $request->ids;

        if (!$ids || count($ids) == 0) {
            return redirect()->back()->with('error', 'Please select at least one product to restore.');
        }

        // onlyTrashed() ensures we only try to restore things that are actually in the trash
        \App\Models\Product::onlyTrashed()->whereIn('id', $ids)->restore();

        return redirect()->route('admin.products.index')->with('success', 'Selected products have been restored!');
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        // Delete the image from the server forever
        if ($product->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
        }

        // Permanently delete the database record
        $product->forceDelete();

        return redirect()->route('admin.products.trashed')->with('success', 'Product permanently deleted!');
    }

    public function exportPDF()
    {
        $products = \App\Models\Product::with('category')->get();

        // Load a specific view for the PDF
        $pdf = Pdf::loadView('admin.reports.inventory', compact('products'));

        return $pdf->download('inventory-report.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function createStaff()
    {
        return view('admin.staff.create');
    }

    public function staffIndex(Request $request)
    {
        $query = User::query();

        // ================= SECURITY FIX =================
        // If the logged-in user is NOT an admin, hide all 'admin' roles from the list
        if (auth()->user()->role !== 'admin') {
            $query->where('role', '!=', 'admin');
        }
        // ================================================

        // Only show staff, drivers, and admins (exclude customers)
        $query->whereIn('role', ['admin', 'staff', 'driver', 'super_user']);

        // Search by name or email
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Exclude the currently logged-in admin
        $staffMembers = $query->where('id', '!=', auth()->id())
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.staff.index', compact('staffMembers'));
    }

    public function showStaff($id)
    {
        $staff = User::findOrFail($id);
        
        // Get assigned orders for drivers
        $assignedOrders = null;
        if ($staff->role === 'driver') {
            $assignedOrders = \App\Models\Order::where('driver_id', $id)
                ->with('customer')
                ->latest()
                ->paginate(10);
        }
        
        // Get activity logs for this user
        $activityLogs = \App\Models\ActivityLog::where('user_id', $id)
            ->latest()
            ->take(20)
            ->get();
        
        return view('admin.staff.show', compact('staff', 'assignedOrders', 'activityLogs'));
    }

    public function storeStaff(Request $request)
    {
        // 1. Validate the new data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:staff,driver',
            'permissions' => 'nullable|array',
            'profile_photo_base64' => 'nullable|string',
            // New demographic fields
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'nullable|in:Male,Female',
            'dob' => 'nullable|date',
            'pob' => 'nullable|string|max:255',
            'current_address' => 'nullable|string',
            'bio' => 'nullable|string',
        ]);

        // 2. Handle the Base64 Cropped Image
        $imagePath = null;
        if ($request->filled('profile_photo_base64')) {
            try {
                // Decode the base64 string
                $image_parts = explode(";base64,", $request->profile_photo_base64);
                $image_base64 = base64_decode($image_parts[1]);
                
                // Generate a random file name
                $fileName = 'profile-photos/' . \Illuminate\Support\Str::uuid() . '.png';
                
                // Save to storage
                \Illuminate\Support\Facades\Storage::disk('public')->put($fileName, $image_base64);
                $imagePath = $fileName;
            } catch (\Exception $e) {
                // If cropping fails, continue without image
                $imagePath = null;
            }
        }

        // 3. Create the new user
        $user = \App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
            'role' => $data['role'],
            'permissions' => $data['permissions'] ?? [],
            'status' => 'active',
            'profile_photo_path' => $imagePath,
            // New demographic fields
            'phone_number' => $data['phone_number'] ?? null,
            'gender' => $data['gender'] ?? null,
            'dob' => $data['dob'] ?? null,
            'pob' => $data['pob'] ?? null,
            'current_address' => $data['current_address'] ?? null,
            'bio' => $data['bio'] ?? null,
        ]);
        
        // 4. Log the action
        \App\Models\ActivityLog::log('Created', 'Staff Profile', "Created new account for: {$user->name}");

        // 5. Redirect to the list with a success message
        return redirect()->route('admin.staff.index')->with('success', 'New team member added successfully!');
    }

    public function editStaff($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Bouncer Check: Prevent staff from hacking the URL to edit an admin
        if ($user->role === 'admin' && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized: You do not have permission to edit Super Admin accounts.');
        }
        
        return view('admin.staff.edit', compact('user'));
    }

    public function updateStaff(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Bouncer Check: Prevent staff from modifying admin accounts
        if ($user->role === 'admin' && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized: You do not have permission to modify Super Admin accounts.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:staff,driver',
            'password' => 'nullable|string|min:8',
            'permissions' => 'nullable|array',
            // Note: Email is NOT validated here because it's disabled in the form
        ]);

        // Update basic info
        $user->name = $validated['name'];
        $user->role = $validated['role'];

        // OVERWRITE PERMISSIONS - If no checkboxes checked, default to empty array
        $user->permissions = $request->permissions ?? [];

        // Did the SuperAdmin type a new password?
        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($validated['password']);

            // Log this high-security action!
            \App\Models\ActivityLog::log('Updated', 'Staff Security', "SuperAdmin performed an emergency password reset for: {$user->name}");
        }

        $user->save();

        // Log the permission change!
        \App\Models\ActivityLog::log('Updated', 'Staff Profile', "Updated roles/permissions for: {$user->name}");

        return redirect()->route('admin.staff.index')->with('success', 'Staff member updated successfully!' . ($request->filled('password') ? ' Password has been reset.' : ''));
    }

    public function deactivateStaff($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Bouncer Check: Prevent staff from deactivating admin accounts
        if ($user->role === 'admin' && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized: You do not have permission to deactivate Super Admin accounts.');
        }
        
        // Prevent deactivating yourself
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot deactivate your own account!');
        }
        
        // Prevent deactivating other admins
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Super Admin accounts cannot be deactivated.');
        }

        // Toggle logic: if active -> disabled, if disabled -> active
        $user->status = ($user->status === 'active' || $user->status === null) ? 'disabled' : 'active';
        $user->save();
        
        $action = ($user->status === 'disabled') ? 'Deactivated' : 'Reactivated';
        
        // Log this action!
        \App\Models\ActivityLog::log('Updated', 'Staff Security', "{$action} account for: {$user->name}");

        return redirect()->back()->with('success', "Account has been {$user->status} successfully.");
    }

    public function deleteStaff($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Bouncer Check: Prevent staff from deleting admin accounts
        if ($user->role === 'admin' && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized: You do not have permission to delete Super Admin accounts.');
        }
        
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account!');
        }
        
        // Prevent deleting other admins
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Super Admin accounts cannot be deleted.');
        }

        $userName = $user->name;
        $user->delete();
        
        // Log this action!
        \App\Models\ActivityLog::log('Deleted', 'Staff Security', "Permanently deleted account: {$userName}");

        return redirect()->route('admin.staff.index')->with('success', 'Staff member permanently removed.');
    }

    /**
     * Change a staff member's role and log it in history.
     */
    public function changeRole(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Bouncer Check: Prevent staff from changing admin roles
        if ($user->role === 'admin' && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized: You do not have permission to change Super Admin roles.');
        }
        
        $oldRole = $user->role;

        $validated = $request->validate([
            'new_role' => 'required|in:staff,driver',
            'reason' => 'nullable|string|max:500',
        ]);

        // Update the role
        $user->update(['role' => $validated['new_role']]);

        // Create history record
        \App\Models\RoleHistory::create([
            'user_id' => $user->id,
            'changed_by' => auth()->id(),
            'old_role' => $oldRole,
            'new_role' => $validated['new_role'],
            'reason' => $validated['reason'],
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Role updated successfully! Changed from "' . ucwords(str_replace('_', ' ', $oldRole)) . '" to "' . ucwords(str_replace('_', ' ', $validated['new_role'])) . '".');
    }

    /**
     * View role history for a specific staff member.
     */
    public function staffHistory($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Bouncer Check: Prevent staff from viewing admin history
        if ($user->role === 'admin' && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized: You do not have permission to view Super Admin history.');
        }
        
        $histories = \App\Models\RoleHistory::where('user_id', $id)
            ->with('changedBy')
            ->latest()
            ->paginate(20);

        return view('admin.staff.history', compact('user', 'histories'));
    }
}
