<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerAuthController extends Controller
{
    /**
     * Show customer login form.
     */
    public function showLogin()
    {
        return view('customer.auth.login');
    }

    /**
     * Handle customer login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            
            // Check if the account is suspended
            if ($user->status === 'suspended') {
                Auth::logout();
                // Clear any intended URL to prevent redirect loops
                $request->session()->forget('url.intended');
                return redirect('/customer/login')->withErrors([
                    'email' => 'Your account has been suspended. Please contact admin for assistance.'
                ])->withInput($request->only('email'));
            }

            // Check if user is a customer
            if ($user->isCustomer()) {
                $request->session()->regenerate();
                return redirect()->intended(route('customer.profile'));
            }

            // Non-customers trying to use customer login - redirect to admin login
            Auth::logout();
            $request->session()->forget('url.intended');
            return redirect('/login')->with('info', 'Please use the staff/admin login portal.');
        }

        return redirect('/customer/login')->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Show customer registration form.
     */
    public function showRegister()
    {
        return view('customer.auth.register');
    }

    /**
     * Handle customer registration.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'customer',
            'phone_number' => $data['phone'] ?? null,
        ]);

        Auth::login($user);

        return redirect()->route('customer.profile')
            ->with('success', 'Welcome to FreshMart! Your account has been created.');
    }

    /**
     * Show customer profile/dashboard.
     */
    public function profile()
    {
        $user = Auth::user();
        
        // Get user's orders with items (using customer_id column)
        $orders = \App\Models\Order::where('customer_id', $user->id)
            ->with('orderItems.product')
            ->latest()
            ->paginate(10);
        
        // Get statistics
        $totalOrders = \App\Models\Order::where('customer_id', $user->id)->count();
        $pendingOrders = \App\Models\Order::where('customer_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed', 'preparing'])
            ->count();
        $completedOrders = \App\Models\Order::where('customer_id', $user->id)
            ->where('status', 'delivered')
            ->count();
        $totalSpent = \App\Models\Order::where('customer_id', $user->id)
            ->where('status', 'delivered')
            ->sum('total_amount');

        return view('customer.profile.index', compact('user', 'orders', 'totalOrders', 'pendingOrders', 'completedOrders', 'totalSpent'));
    }

    /**
     * Show order details.
     */
    public function orderDetails($orderId)
    {
        $order = \App\Models\Order::where('id', $orderId)
            ->where('customer_id', Auth::id())
            ->with('orderItems.product', 'customer', 'driver')
            ->firstOrFail();

        return view('customer.profile.order-details', compact('order'));
    }

    /**
     * Show invoice for an order.
     */
    public function invoice($orderId)
    {
        // SECURITY: Customers can ONLY view their own orders
        $order = \App\Models\Order::where('id', $orderId)
            ->where('customer_id', Auth::id())
            ->with('orderItems.product', 'customer')
            ->firstOrFail();

        return view('frontend.orders.invoice', compact('order'));
    }

    /**
     * Update customer profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date',
            'current_address' => 'nullable|string|max:500',
            'bio' => 'nullable|string|max:1000',
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

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update customer password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        
        $data = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    /**
     * Upload profile photo.
     */
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = Auth::user();

        // Delete old photo if exists
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('photo')->store('profile-photos', 'public');

        $user->update([
            'avatar' => $path,
        ]);

        return back()->with('success', 'Profile photo updated successfully!');
    }

    /**
     * Logout customer.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.login');
    }
}
