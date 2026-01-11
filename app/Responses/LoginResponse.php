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
        \Illuminate\Support\Facades\Log::info('LoginResponse: User logged in', ['id' => $user->id, 'school_id' => $user->school_id]);

        // If user belongs to a school, redirect to subdomain with auth token
        if ($user && $user->school) {
            $subdomainUrl = $user->school->getDomainUrl();
            \Illuminate\Support\Facades\Log::info('LoginResponse: School found', ['url' => $subdomainUrl]);
            
            // Only redirect if we are not already on that domain
            $currentHost = $request->getHost();
            $targetHost = parse_url($subdomainUrl, PHP_URL_HOST);
            
            \Illuminate\Support\Facades\Log::info('LoginResponse: Host check', ['current' => $currentHost, 'target' => $targetHost]);

            if ($subdomainUrl && $currentHost !== $targetHost) {
                // Generate auth token for cross-domain login
                $token = $user->generateAuthToken();
                \Illuminate\Support\Facades\Log::info('LoginResponse: Redirecting to subdomain', ['token' => $token]);
                // Redirect to subdomain auth endpoint with token
                return redirect($subdomainUrl . '/auth/token?token=' . $token);
            }
        }

        // Fallback to default dashboard for global admins or users without school domains
        return redirect(config('fortify.home', '/dashboard'));
    }
}
