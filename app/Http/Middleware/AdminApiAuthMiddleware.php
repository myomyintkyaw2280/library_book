<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class AdminApiAuthMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('token');

        $user = User::where('api_token', $token)->first();
        // dd($user);
        if($user)
        {
            // $hasPermission = $user->hasPermissionTo('category-list');

            // if ($user && $hasPermission){
            //     // return response()->json(['response' => 'User Not Found!'], 401);

            //     return response()->json([
            //         'statusCode' => apires_code('UNAUTHORIZED'),
            //         'message' => apires_message('UNAUTHORIZED'),
            //         'result' => [
            //             'data' => []
            //         ]
            //     ], apires_code('UNAUTHORIZED'));
            // }

            if ($user->user_type_id == 0){
                return response()->json(['response' => 'User Not Found!'], 401);
            }

            // Pass validations
            return $next($request);
        } else {
            return response()->json(['response' => 'User Not Found!'], 401);
        }

        return response()->json(['response' => 'Invalid Token'], 401);
    }
    
    /*public function handle($request, Closure $next)
    {
        // dd($request);
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user || !$user->isAdmin()) {
                return response()->json(['error' => 'Unauthorized for admin.'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        return $next($request);
    }*/
}

