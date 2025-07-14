<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEmployeePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();

        // Allow admins unconditionally
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Allow employees only if they are verified
        if ($user->isEmployee() && $user->is_verified) {
            return $next($request);
        }

        // If an employee is not verified, log them out and redirect with an error
        if ($user->isEmployee() && !$user->is_verified) {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors(['email' => 'Your account is not verified. Please contact the administrator.']);
        }

        // For any other case, deny access
        abort(403, 'Unauthorized action.');
    }
}
