<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validate the incoming form data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt to log the user in (and check if they clicked "Remember me")
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // Check if the account is suspended
            if ($user->status === 'suspended') {
                Auth::logout();
                // Clear any intended URL to prevent redirect loops
                $request->session()->forget('url.intended');
                return redirect('/login')->withErrors([
                    'email' => 'Your account has been suspended. Please contact admin for assistance.'
                ])->withInput($request->only('email'));
            }

            // Check if a customer is trying to use admin login
            if ($user->isCustomer()) {
                Auth::logout();
                $request->session()->forget('url.intended');
                return redirect('/customer/login')->with('info', 'You are logging in with a customer account. Please use the customer login portal.');
            }

            // Security best practice: prevent session fixation attacks
            $request->session()->regenerate();

            // 3. Set session variables for role tracking
            $request->session()->put([
                'user_role' => $user->role,
                'user_type' => $this->getUserType($user->role),
                'login_time' => now(),
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
            ]);

            // 4. The Magic: Check the role and redirect!
            return $this->authenticated($request, Auth::user());
        }

        // 4. If login fails, send them right back with the red error message
        return redirect('/login')->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email')); // Keeps the email so they don't have to retype it!
    }

    /**
     * Get user type based on role.
     */
    protected function getUserType($role)
    {
        return match($role) {
            'admin', 'super_user' => 'admin',
            'driver' => 'driver',
            'staff' => 'staff',
            'customer' => 'customer',
            default => 'customer',
        };
    }

    /**
     * Handle role-based redirection after successful login.
     * Acts as a traffic cop directing users to their correct dashboard.
     */
    protected function authenticated(Request $request, $user)
    {
        $role = $user->role;

        // 1. Admin or Super User -> Admin Dashboard
        if (in_array($role, ['admin', 'super_user'])) {
            return redirect()->intended(route('admin.dashboard'));
        }

        // 2. Driver -> Driver Dashboard (delivery map, orders)
        if ($role === 'driver') {
            return redirect()->intended(route('driver.dashboard'));
        }

        // 3. Staff -> Admin Dashboard (inventory management)
        if ($role === 'staff') {
            return redirect()->intended(route('admin.dashboard'));
        }

        // 4. Default fallback
        return redirect('/');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,driver',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'avatar' => $avatarPath,
        ]);

        Auth::login($user);

        // Use the same role-based redirection logic
        return $this->authenticated($request, $user);
    }

    public function logout(Request $request)
    {
        // Log logout action before destroying session
        if (auth()->check()) {
            $user = auth()->user();
            \App\Models\ActivityLog::create([
                'user_id' => auth()->id(),
                'module' => 'Auth',
                'action' => 'Logged Out',
                'description' => $user->name . ' logged out',
            ]);
            
            // Check if user is a customer
            $isCustomer = $user->isCustomer();
        } else {
            $isCustomer = false;
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect customers to customer login, others to admin login
        if ($isCustomer) {
            return redirect()->route('customer.login');
        }

        return redirect()->route('login');
    }
}
