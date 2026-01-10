<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\RedirectResponse;
use Laravel\Fortify\Fortify;

class RedirectAfterLogin implements RedirectResponse
{
    /**
     * Get the redirect path for the authenticated user.
     */
    public function to(Request $request): string
    {
        $user = $request->user();

        // If user belongs to a school and has a domain, redirect to subdomain
        if ($user && $user->school && $user->school->domain) {
            // For subdomain redirect, we need to use a full URL
            $subdomainUrl = $user->school->getDomainUrl();
            if ($subdomainUrl) {
                // Return full URL for subdomain redirect
                return $subdomainUrl . '/dashboard';
            }
        }

        // Fallback to default dashboard for global admins or users without school domains
        return config('fortify.home', '/dashboard');
    }
}
