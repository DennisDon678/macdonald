<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in as admin
        // if (!Auth::guard('admin')->check()) {
        //     // For API requests, return a JSON response
        //     if ($request->expectsJson()) {
        //         return response()->json([
        //             'message' => 'Unauthenticated. Admin access required.',
        //         ], 401);
        //     }
            
        //     // For web requests, redirect to admin login
        //     return redirect()->route('admin.login')
        //         ->with('error', 'Please login to access the admin panel.');
        // }

        // If authenticated as admin, proceed with the request
        return $next($request);
    }
}
