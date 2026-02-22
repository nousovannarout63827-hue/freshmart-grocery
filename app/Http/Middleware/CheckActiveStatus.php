<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveStatus
{
    /**
     * Handle an incoming request.
     * 
     * Checks if the authenticated user's account is active.
     * If disabled, logs them out and redirects to login with error.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if the user is logged in
        if (Auth::check()) {
            
            // 2. Check if their account has been deactivated
            if (Auth::user()->status === 'disabled' || Auth::user()->status === 'inactive') {
                
                // 3. Kick them out! (Destroy session and log out)
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // 4. Send them back to the login page with a red error message
                return redirect('/login')->with('error', '⛔ Your account has been deactivated. Please contact the Super Admin.');
            }
        }

        // If they are active, let them proceed normally
        return $next($request);
    }
}
