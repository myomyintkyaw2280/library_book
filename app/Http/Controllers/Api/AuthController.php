<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Http\Middleware\AuthenticateWithToken;
use App\Models\Member;
use Carbon\Carbon;

class AuthController extends Controller
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
        // $this->middleware('auth:sanctum', ['except' => ['login', 'register', 'loginWithPhone', 'get_otpcode', 'resend_otpcode', 'verify_otpcode', 'createAndSendOtp']]);
        // $this->middleware('auth:sanctum', ['except' => ['login', 'register', 'test_api']]);
        $this->middleware('AuthenticateWithToken')->only('index');
    }
    
    public function loginWithPhone_1(Request $request)
    {
        $inputs = $request->all();

        // echo json_encode($inputs);
        // exit();
        $validation = Validator::make($inputs, [
            "phone_code" => "required|exists:countries,phone_code|min:1|max:3",
            'phone' => 'required|regex:/(09)[0-9]{9}/|min:11|max:11|unique:customers',
            // 'phone' => ['required', new PhoneNumberExists]
        ], [
            'phone.required' => "Phone number is required",
            'phone.regex'    => "Phone number is not valid format. Please use (09xxxxxxxxx)",
            'phone.unique'   => "PHONE_EXISTS",
        ]);

        if ($validation->fails()) 
        {
            $error_data = [];
            $verror = $validation->errors()->toArray();

            foreach($verror as $ekey =>$eval) { 
                $error_data[$ekey] = $eval[0];
            }

            // dd($error_data);
            if(array_key_exists('phone', $error_data) && $error_data['phone'] == "PHONE_EXISTS")
            {
                $customer = Customer::where('phone', '=', $request->phone)->get()[0];
                

                /*Send OTP Code to phone sms*/
                $otp_code = $this->createAndSendOtp($request->phone);

                // $otp_code = 111111;
                /*Send OTP Code to phone sms*/

                return response()->json([
                    'statusCode' => apires_code('PHONE_EXISTS'),
                    'message' => apires_message('PHONE_EXISTS'),
                    'result' => [
                        'data' => [
                            'token'     => $customer->createToken('ApiToken')->plainTextToken,
                            'type'      => 'bearer',
                            'is_create' => false,
                            'otp_code'  => $otp_code,
                        ],
                    ]
                ], apires_code('PHONE_EXISTS'));
            }

            return response()->json([
                'statusCode' => apires_code('VALIDATE_ERROR'),
                'message' => apires_message('VALIDATE_ERROR'),
                'result' => [
                    'data' => $error_data
                ]
            ], apires_code('VALIDATE_ERROR'));
        }

        $data = array(
            'name'              => $request->name,
            'email'             => empty($request->email)?"":$request->email,
            'phone'             => $request->phone,
            'password'          => empty($request->password)? Hash::make($request->phone): Hash::make($request->password),
            'device_ipaddress'  => empty($request->device_ipaddress)? "":$request->device_ipaddress,
            'device_name'       => empty($request->device_name)?"":$request->device_name,
            'device_token'      => empty($request->device_token)?"":$request->device_token,
            'otp_code'          => $otp_code, // default 111111
        );


        $user = Customer::create($data);

        $customer = [];
        if($user){
            $customer = array(
                "id" => $user['id'],
                "name" => $user['name'],
                "email" => $user['email'],
                "phone" => $user['phone'],
                "device_token" => $user['device_token'],
                // "email_verified_at" => $user['email_verified_at'],
                "created_at" => strtotime($user['created_at']),
                "updated_at" => strtotime($user['updated_at']),
            );
            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => [
                        'token'     => $customer->createToken('ApiToken')->plainTextToken,
                        'type'      => 'bearer',
                        'is_create' => true,
                        'otp_code'  => $otp_code, // default 111111
                    ]
                ]
            ], apires_code('SUCCESS'));
        }

        return response()->json([
            'statusCode' => apires_code('ERROR'),
            'message' => apires_message('ERROR'),
            'result' => [
                'data' => []
            ]
        ], apires_code('ERROR'));
    }
    
    public function createAndSendOtp($phone)
    {
        
        $otp_code = "000000";

        /*Send OTP Code Process*/
            $otp_code = rand(100000, 999999);

            /*Send Email OR SMS Process*/
            
            /*Send Email OR SMS Process*/

        /*End Send OTP Code Process*/

        if($phone != ""){
            $otp_code = 111111;
            $otp_code = rand(100000, 999999);
            return $otp_code;
        }
        
        $otp_code = rand(100000, 999999);

        return $otp_code;
    }

    public function get_otpcode(Request $request)
    {
        $inputs = $request->all();

        $validation = Validator::make($inputs, [
            "phone_code" => "required|string|numeric|min:1",
            "phone" => 'required|string|numeric|regex:/^[0-9]{1,15}$/',
        ], [
            'phone_code.required' => "Phone code is required",
            'phone.required'      => "Phone number is required",
        ]);

        if ($validation->fails()) 
        {
            $error_data = [];
            $verror = $validation->errors()->toArray();

            foreach($verror as $ekey =>$eval) { 
                $error_data[$ekey] = $eval[0];
            }

            // dd($error_data);
            return response()->json([
                'statusCode' => apires_code('VALIDATE_ERROR'),
                'message' => apires_message('VALIDATE_ERROR'),
                'result' => [
                    'data' => $error_data
                ]
            ], apires_code('VALIDATE_ERROR'));
        }

        $phone_code = $request->phone_code;
        $phone      = $request->phone;

        $phoneCode = Country::find($phone_code);
        $phone_number = $phoneCode->phone_code.$phone;
        //Send OTP Code to phone sms
        $otp_code = $this->createAndSendOtp($phone_number);

        return response()->json([
            'statusCode' => apires_code('SUCCESS'),
            'message'    => apires_message('SEND_OTP_SUCCESS'),
            'result' => [
                'data' => [
                    'phone' => $phone_number,
                    'otp_code'  => $otp_code, // default 111111
                ]
            ]
        ], apires_code('SUCCESS'));
    }

    public function resend_otpcode(Request $request)
    {
        $inputs = $request->all();

        $validation = Validator::make($inputs, [
            "phone_code" => "required|string|numeric|min:1",
            "phone" => 'required|string|numeric|regex:/^[0-9]{1,15}$/',
        ], [
            'phone_code.required' => "Phone code is required",
            'phone.required'      => "Phone number is required",
        ]);

        if ($validation->fails()) 
        {
            $error_data = [];
            $verror = $validation->errors()->toArray();

            foreach($verror as $ekey =>$eval) { 
                $error_data[$ekey] = $eval[0];
            }

            // dd($error_data);
            return response()->json([
                'statusCode' => apires_code('VALIDATE_ERROR'),
                'message' => apires_message('VALIDATE_ERROR'),
                'result' => [
                    'data' => $error_data
                ]
            ], apires_code('VALIDATE_ERROR'));
        }

        $phone_code = $request->phone_code;
        $phone      = $request->phone;

        $phoneCode = Country::find($phone_code);
        $phone_number = $phoneCode->phone_code.$phone;
        //Send OTP Code to phone sms
        $otp_code = $this->createAndSendOtp($phone_number);

        return response()->json([
            'statusCode' => apires_code('SUCCESS'),
            'message'    => apires_message('RESEND_OTP_SUCCESS'),
            'result' => [
                'data' => [
                    'phone' => $phone_number,
                    'otp_code'  => $otp_code, // default 111111
                ]
            ]
        ], apires_code('SUCCESS'));
    }

    public function verify_otpcode(Request $request)
    {
        $inputs = $request->all();
        // dd($inputs);
        $validation = Validator::make($inputs, [
            'otp_code' => 'required|numeric|regex:/[0-9]{6}/',
        ], [
            'otp_code.required' => "OTP code is required.",
            'otp_code.regex'    => "OTP code must be numeric 6 digits",
            'otp_code.numeric'  => "OTP code must be numeric",
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

        $phone_verified = verifiedOtpCode($request->otp_code);
        
        if($phone_verified)
        {   
            $verify_at = Carbon::now();
            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('OTP_CODE_VERIFY_SUCCESS'),
                'result' => [
                    'data' => [
                        // 'token' => $bearerToken,
                        // 'type' => 'bearer',
                        'phone_verified_date' => $verify_at,
                    ]
                ]
            ], apires_code('SUCCESS'));  
        }


        return response()->json([
            'statusCode' => apires_code('ERROR'),
            'message' => apires_message('INVALID_OTP_CODE'),
            'result' => [
                'data' => [
                    // 'token' => $bearerToken,
                    // 'type' => 'bearer',
                ]
            ]
        ], apires_code('ERROR'));
    }


    public function loginWithPhone(Request $request)
    {
        $inputs = $request->all();

        $validation = Validator::make($inputs, [
            "phone_code" => "required|string|numeric|min:1",
            "phone" => 'required|string|numeric|regex:/^[0-9]{1,15}$/',
        ], [
            'phone_code.required' => "Phone code is required",
            'phone.required'      => "Phone number is required",
        ]);

        if ($validation->fails()) 
        {
            $error_data = [];
            $verror = $validation->errors()->toArray();

            foreach($verror as $ekey =>$eval) { 
                $error_data[$ekey] = $eval[0];
            }

            // dd($error_data);
            return response()->json([
                'statusCode' => apires_code('VALIDATE_ERROR'),
                'message' => apires_message('VALIDATE_ERROR'),
                'result' => [
                    'data' => $error_data
                ]
            ], apires_code('VALIDATE_ERROR'));
        }

        $phone_code = $request->phone_code;
        $phone_no   = $request->phone;
        $customer = Customer::where('phone_code_id', '=', $phone_code)->where('phone', '=', $phone_no)->get();
        
        //Send OTP Code to phone sms
        // $otp_code = $this->createAndSendOtp($phone_no);
        
        if(count($customer) > 0 )
        {
            $user = $customer[0];
            if($user->name != "" || $user->email != ""){
                $is_create = false;
            }
            else{
                $is_create = true;
            }
            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message'    => apires_message('SUCCESS'),
                'result' => [
                    'data' => [
                        'token'     => $user->createToken('ApiToken')->plainTextToken,
                        'type'      => 'bearer',
                        'is_create' => $is_create,
                        'customer_id' => $user->id,
                        // 'otp_code'  => $otp_code, // default 111111
                    ]
                ]
            ], apires_code('SUCCESS'));

        }
        else
        {
            $data = array(
                'name'              => empty($request->name)?"":$request->name,
                'email'             => empty($request->email)?"":$request->email,
                'phone_code_id'     => $request->phone_code,
                'phone'             => $request->phone,
                'password'          => empty($request->password)? Hash::make($request->phone): Hash::make($request->password),
                'device_ipaddress'  => empty($request->device_ipaddress)? "":$request->device_ipaddress,
                'device_name'       => empty($request->device_name)?"":$request->device_name,
                'device_token'      => empty($request->device_token)?"":$request->device_token,
                // 'otp_code'          => $otp_code, // default 111111
            );

            $customers = Customer::create($data);
            
            if($customers){
                $user = $customers;

                return response()->json([
                    'statusCode' => apires_code('SUCCESS'),
                    'message'    => apires_message('SUCCESS'),
                    'result' => [
                        'data' => [
                            'token'     => $user->createToken('ApiToken')->plainTextToken,
                            'type'      => 'bearer',
                            'is_create' => true,
                            'customer_id' => $user->id,
                            // 'otp_code'  => $otp_code, // default 111111
                        ]
                    ]
                ], apires_code('SUCCESS'));
            }
            
        }

        return response()->json([
            'statusCode' => apires_code('ERROR'),
            'message'    => apires_message('ERROR'),
            'result' => [
                'data' => []
            ]
        ], apires_code('ERROR'));
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

        $customer = Customer::where('email', '=', $request->email)->get()[0];
        
        if(!$customer || empty($customer))
        {
            return response()->json([
                'message' => "Username Doesn't exit!",
                'status' => 202,
                'data' => null
            ], 202);
        }

        $getPasswordHash = $customer['password'];

        if (Hash::check($request->password, $getPasswordHash)) {
            $user = array(
                "id" => $customer['id'],
                "name" => $customer['name'],
                "email" => $customer['email'],
                "phone" => $customer['phone'],
                "device_token" => $customer['device_token'],
                // "email_verified_at" => $customer['email_verified_at'],
                "created_at" => strtotime($customer['created_at']),
                "updated_at" => strtotime($customer['updated_at']),
            );

            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => array(
                        'token' => $customer->createToken('ApiToken')->plainTextToken,
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

    public function register(Request $request)
    {
        $inputs = $request->all();

        $validation = Validator::make($inputs, [
            "name"      => "required|string|max:35",
            // "email"     => "string|unique:customers",
            "phone_code"=> "required|string|numeric|min:1",
            "phone"     => 'required|string|numeric|regex:/^[0-9]{1,15}$/|unique:customers',
        ], [
            'name.required'       => "Customer name is required",
            'phone_code.required' => "Phone code is required",
            'phone.required'      => "Phone number is required",
            'phone.unique'        => "Phone number is already register",
            // 'email.unique'        => "Email address is already register",
        ]);

        if ($validation->fails()) {
            $error_data = [];
            $verror = $validation->errors()->toArray();

            foreach($verror as $ekey =>$eval) { 
                $error_data[$ekey] = $eval[0];
            }
            // dd($error_data);
            /*
                if(array_key_exists('phone', $error_data) && $error_data['phone'] == "PHONE_EXISTS"){
                    $customer = Customer::where('phone', '=', $request->phone)->get()[0];
                    
                    return response()->json([
                        'message' => 'PHONE_EXISTS',
                        'statusCode' => 201,
                        'result' => [
                            'data' => [
                                'token' => $customer->createToken('ApiToken')->plainTextToken,
                                'type' => 'bearer',
                            ]
                        ],
                    ]);
                }
            */
            return response()->json([
                'statusCode' => apires_code('VALIDATE_ERROR'),
                'message' => apires_message('VALIDATE_ERROR'),
                'result' => [
                    'data' => $error_data
                ]
            ]);
        }

        $data = array(
            'name'          => $request->name,
            'email'         => empty($request->email)?"":$request->email,
            'phone_code_id' => $request->phone_code,
            'phone'         => $request->phone,
            'password'      => empty($request->password)? "": Hash::make($request->password),
            'device_ipaddress' => empty($request->device_ipaddress)? "":$request->device_ipaddress,
            'device_name'   => empty($request->device_name)?"":$request->device_name,
            'device_token'  => empty($request->device_token)?"":$request->device_token,
        );
        $user = Customer::create($data);

        $customer = [];
        if($user){

            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message'    => apires_message('SUCCESS_CREATE_USER'),
                'result' => [
                    'data' => [
                        'token'     => $user->createToken('ApiToken')->plainTextToken,
                        'type'      => 'bearer',
                        'userdata'  => $data,
                        'is_create' => true,
                        // 'otp_code'  => $otp_code, // default 111111
                    ]
                ]
            ], apires_code('SUCCESS'));
        }

        return response()->json([
            'message' => 'Customer fails to create',
            'data' => null
        ], 202);
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


