<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\PasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
     * Show the forgot password form.
     */
    public function showForgotPassword()
    {
        return view('customer.auth.forgot-password');
    }

    /**
     * Handle forgot password form submission.
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // Only send reset email for customer accounts
        if (!$user->isCustomer()) {
            return back()->withErrors(['email' => 'Please use the admin password reset portal.'])
                ->withInput($request->only('email'));
        }

        // Generate reset token
        $token = Str::random(60);

        // Store or update the password reset token
        PasswordResetToken::updateOrCreate(
            ['email' => $request->email],
            [
                'token' => hash('sha256', $token),
                'created_at' => now(),
            ]
        );

        // Build reset URL
        $resetUrl = route('customer.reset-password.form', ['token' => $token, 'email' => $request->email]);

        // Send email
        try {
            Mail::send('emails.password-reset', [
                'user' => $user,
                'email' => $request->email,
                'resetUrl' => $resetUrl,
            ], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Reset Your Password - FreshMart');
            });

            return redirect()->route('customer.forgot-password')
                ->with('success', 'We\'ve sent a password reset link to your email address.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send reset email. Please try again later.'])
                ->withInput($request->only('email'));
        }
    }

    /**
     * Show the reset password form.
     */
    public function showResetPassword(Request $request, $token)
    {
        return view('customer.auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Handle password reset.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Verify token
        $resetToken = PasswordResetToken::where('email', $request->email)
            ->where('token', hash('sha256', $request->token))
            ->first();

        if (!$resetToken) {
            return redirect()->route('customer.forgot-password')
                ->with('error', 'Invalid or expired reset token. Please request a new password reset.');
        }

        // Check if token is expired (60 minutes)
        if ($resetToken->created_at->addMinutes(60)->isPast()) {
            $resetToken->delete();
            return redirect()->route('customer.forgot-password')
                ->with('error', 'Your reset link has expired. Please request a new password reset.');
        }

        // Update password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the used token
        $resetToken->delete();

        return redirect()->route('customer.login')
            ->with('success', 'Your password has been reset successfully! You can now log in with your new password.');
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
     * Download PDF invoice for an order.
     */
    public function downloadInvoice($orderId)
    {
        // SECURITY: Customers can ONLY download their own orders
        $order = \App\Models\Order::where('id', $orderId)
            ->where('customer_id', Auth::id())
            ->with('orderItems.product', 'customer')
            ->firstOrFail();

        // Generate PDF using DomPDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('customer.orders.invoice-pdf', compact('order'));

        // Download the file with a clean name
        return $pdf->download('FreshMart-Invoice-' . $order->id . '.pdf');
    }

    /**
     * Cancel an order (customer can only cancel if status is pending).
     */
    public function cancelOrder(Request $request, $orderId)
    {
        $request->validate([
            'cancellation_reason' => 'required|string|max:1000',
        ]);

        // SECURITY: Customers can ONLY cancel their own orders
        $order = Order::where('id', $orderId)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        // Check if order can be cancelled (only if status is pending)
        if ($order->status !== 'pending') {
            return back()->with('error', 'Sorry, this order cannot be cancelled. Orders can only be cancelled before they are confirmed by our staff.');
        }

        // Update order status and cancellation reason
        $order->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->cancellation_reason,
        ]);

        // Create notification for the customer
        $order->customer->notifications()->create([
            'id' => \Illuminate\Support\Str::orderedUuid(),
            'type' => 'order_cancelled',
            'data' => [
                'title' => 'Order Cancelled',
                'message' => "Your order #{$order->id} has been cancelled successfully.",
                'reason' => $request->cancellation_reason,
                'order_id' => $order->id,
                'cancelled_by' => 'You',
            ],
        ]);

        return redirect()->route('customer.order.details', $orderId)
            ->with('success', 'Your order has been cancelled successfully.');
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
