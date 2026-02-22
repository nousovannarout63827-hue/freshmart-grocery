<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        // Issue a token with "abilities" based on the user's role
        $token = $user->createToken('auth_token', [$user->role])->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'role' => $user->role,
            'user' => $user->name
        ]);
    }
}
