<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddCacheHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $routeName = $request->route()?->getName();
        if (! $routeName) {
            return $response;
        }

        $header = config("cache_headers.headers.{$routeName}");
        if ($header) {
            $response->headers->set('Cache-Control', $header);
        }

        return $response;
    }
}
