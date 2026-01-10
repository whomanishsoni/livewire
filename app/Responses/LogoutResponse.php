<?php

namespace App\Responses;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request)
    {
        // Check if we're on a subdomain
        $host = $request->getHost();
        $mainDomain = parse_url(config('app.url'), PHP_URL_HOST) ?? 'localhost';
        if ($mainDomain === 'localhost' || filter_var($mainDomain, FILTER_VALIDATE_IP)) {
            $mainDomain = 'livewire.test';
        }

        $isOnSubdomain = str_contains($host, '.' . $mainDomain);

        if ($isOnSubdomain) {
            // On subdomain, redirect to subdomain login
            return redirect('/login');
        } else {
            // On main domain, redirect to main domain login
            return redirect(config('fortify.home', '/'));
        }
    }
}
