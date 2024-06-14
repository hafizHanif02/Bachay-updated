<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

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

        // Log request method and headers for debugging
        Log::info('Request Method: ' . $request->getMethod());
        Log::info('Request Headers: ' . json_encode($request->headers->all()));

        // Set CORS headers
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        if ($request->getMethod() === 'OPTIONS') {
            $response->setStatusCode(200);
        }

        // Log response headers for debugging
        Log::info('Response Headers: ' . json_encode($response->headers->all()));

        return $response;
    }
}
