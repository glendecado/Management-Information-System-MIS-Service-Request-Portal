<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MisStaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the authenticated user's role is 'admin'
            if (Auth::user()->role === 'misStaff') {
                return $next($request);
            } else {
                // If the user is not an admin, return a 403 Forbidden response
                return response()->json(['message' => 'Forbidden'], 403);
            }
        }

        // If the user is not authenticated, return a 401 Unauthorized response
        return response()->json(['message' => 'Unauthorized'], 401);
    
    }
}
