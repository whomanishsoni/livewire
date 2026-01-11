<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectSchoolUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If user is logged in, belongs to a school, and is accessing the central domain
        if ($user && $user->school_id && $user->school) {
            // Check if we are already on the correct domain to avoid infinite loops
            $currentHost = $request->getHost();
            $targetUrl = $user->school->getDomainUrl();
            $targetHost = parse_url($targetUrl, PHP_URL_HOST);

            if ($currentHost !== $targetHost) {
                return redirect($targetUrl . '/dashboard');
            }
        }

        return $next($request);
    }
}
