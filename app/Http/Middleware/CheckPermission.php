<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     * The $permission variable is passed directly from our web.php routes file!
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        // 1. Ensure the user is actually logged in first
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Use the global function we wrote in the User Model!
        if (!auth()->user()->hasPermission($permission)) {
            // If they don't have the checkbox ticked, stop them instantly.
            abort(403, 'Unauthorized Access: You do not have the required permissions.');
        }

        // 3. If they pass the check, let them through to the page
        return $next($request);
    }
}
