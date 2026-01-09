<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SchoolContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // If user is authenticated and has a school context (not a global admin)
        if ($user && $user->school_id) {
            // Set the current school in the session/app context
            app()->instance('current_school', $user->school);
            session(['current_school_id' => $user->school_id]);

            // Check if user's school has an active subscription
            $activeSubscription = $user->school->activeSubscription();
            if (!$activeSubscription) {
                // Redirect to subscription required page or show message
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'No active subscription found'], 403);
                }

                return redirect()->route('dashboard')->with('error', 'Your school does not have an active subscription. Please contact your administrator.');
            }

            // Check if subscription is expired
            if ($activeSubscription->isExpired()) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Subscription expired'], 403);
                }

                return redirect()->route('dashboard')->with('error', 'Your subscription has expired. Please renew your subscription.');
            }
        }
        // Global admins (users without school_id) can access everything

        return $next($request);
    }
}
