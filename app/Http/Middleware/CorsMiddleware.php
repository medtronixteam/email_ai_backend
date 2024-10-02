<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:3000');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');

        // For preflight (OPTIONS) requests, return 200 response
        if ($request->getMethod() === "OPTIONS") {
            $response->setStatusCode(200);
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            $response->headers->set('Access-Control-Max-Age', '86400'); // Cache preflight request for 1 day
        }

        return $response;
    }
}
