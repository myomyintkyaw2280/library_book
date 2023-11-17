<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateWithToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if (!Auth::guard('admin')->check()) {
        //     return response()->json(['statusCode' => apires_code('UNAUTHORIZED'), 'message' => apires_message('UNAUTHORIZED')], 401);
        // }

        // $bearerToken = $request->bearerToken();
        // $token = PersonalAccessToken::findToken($bearerToken)->count();
        // dd($token);
        // if($token<=0){
        //      return response()->json(['statusCode' => 401, 'message' => 'Unauthenticated. '.$bearerToken], 401);
        // }

        return $next($request);
    }
}
