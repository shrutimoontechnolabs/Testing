<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is authenticated and has the 'Admin' role
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Redirect to 'emplayout' if user is not an admin
        return redirect()->route('user.userdashboard');
    }
}
