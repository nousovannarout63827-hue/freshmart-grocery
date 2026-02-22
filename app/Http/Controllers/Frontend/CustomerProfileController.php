<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CustomerProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $user = auth()->user();
        return view('frontend.profile.edit', compact('user'));
    }

    /**
     * Update the profile and handle image upload.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // 1. Validate the input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Ensure email is unique, ignoring the current user's ID
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            // Validate image: must be an image file, max 2MB
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // 2. Handle Image Upload Logic
        if ($request->hasFile('image')) {
            // A. Delete old image if it exists to save server space
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // B. Store the new image in a 'profile-photos' folder
            $path = $request->file('image')->store('profile-photos', 'public');
            
            // C. Update user model with new path
            $user->avatar = $path;
        }

        // 3. Update text fields and save
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
