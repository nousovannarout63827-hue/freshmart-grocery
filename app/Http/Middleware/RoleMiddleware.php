<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  Accepts multiple roles like 'admin', 'staff', 'super_user'
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Double-check they are actually logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Grab the user's role
        $userRole = Auth::user()->role;

        // 3. Check if their role is in the list of allowed roles for this route
        if (!in_array($userRole, $roles)) {
            // Kick them out with a 403 Access Denied error!
            abort(403, 'Unauthorized Access. You do not have permission to view this page.');
        }

        // 4. If they pass the check, allow the request to continue
        return $next($request);
    }
}
