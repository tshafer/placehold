<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RateLimitHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Laravel's throttle middleware already sets these headers internally.
        // We normalize them to the X-RateLimit-* convention for API consumers.
        $limit = $response->headers->get('X-RateLimit-Limit');
        $remaining = $response->headers->get('X-RateLimit-Remaining');
        $retryAfter = $response->headers->get('Retry-After');

        if ($limit !== null) {
            $response->headers->set('X-RateLimit-Limit', $limit);
            $response->headers->set('X-RateLimit-Remaining', $remaining ?? '0');
        }

        if ($retryAfter !== null) {
            $response->headers->set('X-RateLimit-Reset', (string) (time() + (int) $retryAfter));
        }

        return $response;
    }
}
