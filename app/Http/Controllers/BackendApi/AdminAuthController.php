<?php

namespace App\Http\Controllers\BackendApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Http\Middleware\AuthenticateWithToken;

// use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\User;
use Carbon\Carbon;

class AdminAuthController extends Controller
{

    /*
    *
    * Auth Status Codes
    * 200 = Register Success
    * 422 = Validation Error
    * 201 = Alredy Logged In
    * 202 = Wrong Credentials
    * 203 = Logout Success
    * 204 = Login Success
    * 205 = Not Logged In
    * 206 = Request Success
    *
    */

    public function __construct()
    {

        // $this->middleware('AuthenticateWithToken', ['except' => ['login']]);
    }


/*
    public function login(Request $request)
    {
        $inputs = $request->all();

        $validation = Validator::make($inputs, [
            'email' => 'required|string|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => "Email is required",
            'email.email' => "Email is not valid",
            'password.required' => "Password is required",
            'password.min' => "Password is at least 8 characters",
        ]);

        if ($validation->fails()) {

            $error_data = [];
            $verror = $validation->errors()->toArray();

            foreach($verror as $ekey =>$eval) { 
                $error_data[$ekey] = $eval[0];
            }

            return response()->json([ 
                'statusCode' => apires_code('VALIDATE_ERROR'),
                'message' => apires_message('VALIDATE_ERROR'),
                'result' => [
                    'data' => $error_data
                ]
            ], apires_code('VALIDATE_ERROR'));
        }

        $user = User::where('email', '=', $request->email)->get()[0];
        
        if(!$user || empty($user))
        {
            return response()->json([
                'message' => "Username Doesn't exit!",
                'status' => 202,
                'data' => null
            ], 202);
        }

        $getPasswordHash = $user['password'];

        if (Hash::check($request->password, $getPasswordHash)) {
            $user = array(
                "id" => $user['id'],
                "name" => $user['name'],
                "email" => $user['email'],
                "phone" => $user['phone'],
                "device_token" => $user['device_token'],
                "created_at" => strtotime($user['created_at']),
                "updated_at" => strtotime($user['updated_at']),
            );

            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => array(
                        'token' => $user->createToken('ApiToken')->plainTextToken,
                        'type' => 'bearer'
                    )
                ]
            ],apires_code('SUCCESS'));
        }
        else {
            return response()->json([
                'statusCode' => apires_code('UNAUTHORIZED'),
                'message' => apires_message('UNAUTHORIZED'),
                'result' => [
                    'data' => []
                ]
            ], apires_code('UNAUTHORIZED'));
        }

        return response()->json([
            'statusCode' => apires_code('UNAUTHORIZED'),
            'message' => apires_message('INVALID_CREDENTIAL'),
            'result' => [
                'data' => []
            ]
        ], apires_code('UNAUTHORIZED'));
    }
*/


/*   public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }
*/


    public function login(Request $request)
    {
        $inputs = $request->all();

        if(empty($inputs)) {
            return response()->json([
                'message' => 'Invalid Your Data',
                'state' => 000,
                'data' => $request->all()
            ]);
        }

        $validation = Validator::make($inputs, [
            'email'         => 'required|email',
            'password'      => 'required|min:6',
        ], [
            'email.required'     => "Email is required",
            'email.email'        => "Email is not valid",
            'password.required'  => "Password is required",
            // 'password.confirmed' => "Password Doesn't Match!",
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'state' => 422,
                'data' => $validation->errors()
            ]);
        }

        $user = User::where('email', '=', $inputs['email'])->get()[0];
        $getPasswordHash = $user['password'];

        if (Hash::check($inputs['password'], $getPasswordHash)) 
        {
            if(!empty($user['api_token']))
            {
                $api_token = $user['api_token'];
            }
            else
            {

                $api_token = generateRandomString(50);

                $user->api_token = $api_token;
                $user->save();
            }
            

            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => ['token'=> $api_token]
                ]
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'unauthenticated',
                'state' => 403,
                'data' => []
            ]);
        }
    }

    public function logout(Request $request){
        $token = $request->header('Token');
        $user = User::where('api_token', $token)->first();
        if($user){
            $user->api_token = NULL;
            $user->save();

            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS_LOGOUT'),
                'result' => [
                    'data' => []
                ]
            ]);
        }
        else{
            return response()->json([
                'message' => 'user not found',
                'state' => 401,
                'data' => null,
            ]);
        }
    }

    public function refresh()
    {
        return response()->json([
            'statusCode' => apires_code('REFRESH'),
            'message' => apires_message('REFRESH'),
            'result' => [
                // 'user' => Auth::user(), //check user
                'data' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
            ]
        ]);
    }


    
}


