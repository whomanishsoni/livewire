<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SubdomainContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $mainDomain = parse_url(config('app.url'), PHP_URL_HOST);

        // Check if this is a subdomain request
        if (str_contains($host, '.' . $mainDomain)) {
            $subdomain = str_replace('.' . $mainDomain, '', $host);

            // Find the school by domain
            $school = \App\Models\School::where('domain', $subdomain)->first();

            if ($school) {
                // Set the current school in the session/app context
                app()->instance('current_school', $school);
                session(['current_school_id' => $school->id]);

                // If user is authenticated and doesn't have a school_id set,
                // or if they belong to a different school, redirect to main domain
                $user = Auth::user();
                if ($user && $user->school_id && $user->school_id !== $school->id) {
                    return redirect()->away(config('app.url') . $request->getRequestUri());
                }
            } else {
                // Invalid subdomain, redirect to main domain
                return redirect()->away(config('app.url') . $request->getRequestUri());
            }
        }

        return $next($request);
    }
}
