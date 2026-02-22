<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if the user is logged in at all
        if (auth()->check()) {
            
            // 2. Check if their role is admin or staff
            if (auth()->user()->role === 'admin' || auth()->user()->role === 'staff') {
                // Let them pass through to the dashboard
                return $next($request); 
            }
            
            // 3. If they are just a "customer", log them out and redirect to customer login
            auth()->logout();
            return redirect()->route('customer.login')->with('error', 'You do not have permission to access the Admin panel. Please log in with your customer account.');
        }

        // If not logged in at all, send to login page
        return redirect('/login');
    }
}
