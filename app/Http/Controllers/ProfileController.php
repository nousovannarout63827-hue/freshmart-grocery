<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the account settings page.
     */
    public function edit()
    {
        // Get the currently logged-in user
        $user = auth()->user();
        
        // Get only this user's recent actions
        $recentActivities = ActivityLog::where('user_id', $user->id)
                                       ->latest()
                                       ->take(10) // Show last 10 actions
                                       ->get();

        return view('profile.edit', compact('user', 'recentActivities'));
    }

    /**
     * Update Profile Information (Name, Email, Photo, Phone, Address).
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'photo' => ['nullable', 'image', 'max:2048'], // Max 2MB image
            'phone' => ['nullable', 'string', 'max:20'],
            'current_address' => ['nullable', 'string', 'max:500'],
        ]);

        // Handle Photo Upload
        if ($request->hasFile('photo')) {
            // 1. Delete old photo if it exists (check both avatar and profile_photo_path)
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            // 2. Store new photo in 'avatar' column (primary field)
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->avatar = $path;
            $user->profile_photo_path = $path; // Also update secondary field for compatibility
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone;
        $user->current_address = $request->current_address;
        $user->save();

        // Log the activity
        ActivityLog::create([
            'user_id' => $user->id,
            'module' => 'Profile',
            'action' => 'profile_updated',
            'description' => 'Updated profile information',
        ]);

        return back()->with('success', 'Profile information updated successfully!');
    }

    /**
     * Update Password Securely.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'], // Laravel checks if this matches actual DB password
            'password' => ['required', 'confirmed', Password::defaults()], // Checks for confirmation field and security strength
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully!');
    }

    /**
     * Upload Profile Photo separately.
     */
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:2048'], // Max 2MB image
        ]);

        $user = auth()->user();

        // 1. Delete old photo if it exists (check both fields)
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // 2. Store new photo in both fields for compatibility
        $path = $request->file('photo')->store('profile-photos', 'public');
        $user->avatar = $path;
        $user->profile_photo_path = $path;
        $user->save();

        // Log the activity
        ActivityLog::create([
            'user_id' => $user->id,
            'module' => 'Profile',
            'action' => 'profile_photo_updated',
            'description' => 'Updated profile photo',
        ]);

        // Return JSON for AJAX requests
        if ($request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'message' => 'Profile photo updated successfully!',
                'photo_url' => asset('storage/' . $path),
            ]);
        }

        return back()->with('success', 'Profile photo updated successfully!');
    }
}
