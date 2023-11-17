<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// use App\Models\ApiKey;

class ApiKeyCheck
{
    public function handle(Request $request, Closure $next)
    {
        // Assuming the API key is sent in the "X-Api-Key" header
        $apiKey = $request->header('X-Api-Key'); 

        // Check if the API key is valid
        if ($apiKey !== config('app.api_key')) {
            // return response()->json(['message' => 'Unauthorized'], 401);
            return response()->json(['statusCode' => apires_code('UNAUTHORIZED'), 'message' => apires_message('UNAUTHORIZED')], 401);
        }

        return $next($request);
    }
}
