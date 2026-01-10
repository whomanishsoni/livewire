<?php

namespace App\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Symfony\Component\HttpFoundation\Response;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request)
    {
        $user = $request->user();

        // If user belongs to a school and has a domain, redirect to subdomain with auth token
        if ($user && $user->school && $user->school->domain) {
            $subdomainUrl = $user->school->getDomainUrl();
            if ($subdomainUrl) {
                // Generate auth token for cross-domain login
                $token = $user->generateAuthToken();
                // Redirect to subdomain auth endpoint with token
                return redirect($subdomainUrl . '/auth/token?token=' . $token);
            }
        }

        // Fallback to default dashboard for global admins or users without school domains
        return redirect(config('fortify.home', '/dashboard'));
    }
}
