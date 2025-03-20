<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogExecutionTime
{
    public function handle(Request $request, Closure $next)
    {
        $startTime = microtime(true);
        $response = $next($request);
        $duration = microtime(true) - $startTime;
        Log::info('Request [' . $request->method() . ' ' . $request->path() . '] executed in ' . number_format($duration, 3) . ' seconds.');
        return $response;
    }
}
