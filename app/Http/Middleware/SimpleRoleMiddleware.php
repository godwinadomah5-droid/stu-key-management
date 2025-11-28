<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SimpleRoleMiddleware
{
    /**
     * Simple role middleware for testing
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // Simple role check - you can enhance this later
        if (!$user->hasRole($role)) {
            abort(403, 'Unauthorized. Required role: ' . $role);
        }

        return $next($request);
    }
}
