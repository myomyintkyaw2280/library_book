<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
// use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Middleware\AuthenticateWithToken;

use App\Models\Customer;
use App\Models\FileUpload;
use Carbon\Carbon;

class CustomerApiController extends Controller
{
    protected $uploadFolder = "users";

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['verify_otpcode']]);
    }

    public function logout(Request $request)
    {
        // $customer = Auth::guard('sanctum')->customer();
        // Auth::guard('user')->user()->tokens()->delete();
        // // $customer->tokens()->delete(); // Revoke all tokens for the customer

        // return response()->json([
        //     'statusCode' => apires_code('SUCCESS_LOGOUT'),
        //     'message' => apires_code('SUCCESS_LOGOUT'),
        //     'result' => [
        //         'data' => []
        //     ]

        // ], apires_code('SUCCESS'));

        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            
            // Revoke tokens for the user
            $user->tokens()->delete();
            
            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS_LOGOUT'),
                // 'result' => [
                //     'data' => []
                // ]

            ], apires_code('SUCCESS'));
            
            // return response()->json(['message' => 'Logged out successfully']);
        } else {
            // return response()->json(['message' => 'User is not authenticated'], 401);

            return response()->json([
                'statusCode' => apires_code('UNAUTHORIZED'), 
                'message' => apires_message('UNAUTHORIZED')
            ], apires_code('UNAUTHORIZED'));
        }
    }

    public function profile_ori(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $customer_id = $token->tokenable_id;

        if($customer_id >= 1){
            $customer = Customer::with('country')->where('id', '=', $customer_id)->get()[0];
            // $customer = Customer::find($customer_id);

            if(!$customer || empty($customer))
            {
                return response()->json([
                    'statusCode' => apires_code('DATA_NOT_FOUND'),
                    'message' => apires_message('DATA_NOT_FOUND'),
                    'result' => [
                        'data' => $customer
                    ]
                ]);
            }

            $user = array(
                "id" => $customer['id'],
                "name" => $customer['name'],
                "email" => $customer['email'],
                "phone" => $customer['phone'],
                "phone_code" => $customer->country->phone_code,
                "device_token" => $customer['device_token'],
                // "email_verified_at" => $customer['email_verified_at'],
                "created_at" => strtotime($customer['created_at']),
                "updated_at" => strtotime($customer['updated_at']),
            );

            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => $user
                ]
            ], apires_code('SUCCESS'));
        }
        else{
            return response()->json([
                'statusCode' => apires_code('ERROR'),
                'message' => apires_message('ERROR'),
                'result' => [
                    'data' => $user
                ]
            ], apires_code('ERROR'));
        }
    }

    public function profile(Request $request)
    {
        // $token = PersonalAccessToken::findToken($request->bearerToken());
        // $customer_id = $token->tokenable_id;
        $inputs = $request->all();
        $validation = Validator::make($inputs, [
            'customer_id' => 'required|numeric',
        ], [
            'customer_id.required' => "Customer ID is required.",
            'customer_id.numeric'  => "Customer ID must be numeric",
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

        $customer_id = $request->customer_id;

        if($customer_id >= 1){
            $customer = new Customer();
            $user = $customer->getCustomerApi($customer_id);

            return response()->json([
                'statusCode' => apires_code('SUCCESS'),
                'message' => apires_message('SUCCESS'),
                'result' => [
                    'data' => $user
                ]
            ], apires_code('SUCCESS'));
        }
        else{
            return response()->json([
                'statusCode' => apires_code('ERROR'),
                'message' => apires_message('ERROR'),
                'result' => [
                    'data' => $user
                ]
            ], apires_code('ERROR'));
        }
    } 

    public function change_profile(Request $request)
    {
        $inputs = $request->all();
        
        $validation = Validator::make($inputs, [
            'customer_id' => 'required|numeric',
            'image'        => 'required|mimes:png|max:2048', //2M
        ], [
            'customer_id.required' => "Customer ID is required.",
            'customer_id.numeric'  => "Customer ID must be numeric",
        ]);

        if ($validation->fails()) 
        {
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


        if($request->hasFile('image'))
        {
            $allowedfileExtension=['png'];
            $profile_img    = $request->file('image');
            $customer_id    = $request->customer_id;

            if ($profile_img) {
                $uploaded_path  = FileUpload::upload($profile_img, $this->uploadFolder);
                $data['image']  =   $uploaded_path;
                $customer       = Customer::find($customer_id);
                
                $update_user    = $customer->update($data);

                if($update_user){
                    return response()->json([
                        'statusCode'    => apires_code('SUCCESS'),
                        'message'       => apires_message('SUCCESS_IMAGE'),
                        'result'        => [
                            'data' => base_url($data['image'])
                        ]
                    ], apires_code('SUCCESS'));
                }else{
                    return response()->json([
                        'statusCode' => apires_code('ERROR'),
                        'message' => apires_message('ERROR_UPDATE'),
                        'result' => []
                    ], apires_code('ERROR'));
                }
            }
            else{
                return response()->json([
                    'statusCode' => apires_code('ERROR'),
                    'message' => apires_message('ERROR_IMAGE'),
                    'result' => []
                ], apires_code('ERROR'));
            }
        }
        else
        {
            return response()->json([
                'statusCode' => apires_code('ERROR'),
                'message' => apires_message('ERROR_IMAGE'),
                'result' => []
            ], apires_code('ERROR'));
        }

    }

    public function saveUser(Request $request)
    {
        $inputs = $request->all();

        $validation = Validator::make($inputs, [
            'username'  => 'required|string|max:255',
            'email'     => 'max:255'
        ], [
            'username.required' => "Customer name is required",
            // 'email.email'    => "Invalid email format",
            // 'email.unique'    => "Email address must be a unique",
        ]);

        if ($validation->fails()) 
        {
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


        $bearerToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($bearerToken);
        $customer_id = $token->tokenable_id;

        if($customer_id >= 1){
            $customer = Customer::find($customer_id);

            if (!$customer) {
                return response()->json([
                    'statusCode' => apires_code('ERROR'),
                    'message' => apires_message('USER_NOT_FOUND'),
                    'result' => [
                        'data' => []
                    ]
                ], apires_code('ERROR'));
            }

            $save_user = $customer->update([
                'name'  => $request->username,
                'email' => $request->email,
            ]);

            if($save_user){
                $customer->image = ($customer->image)?base_url($customer->image):"";
                return response()->json([
                    'statusCode'    => apires_code('SUCCESS'),
                    'message'       => apires_message('SUCCESS'),
                    'result'        => [
                        'data'  => $customer
                    ]
                ], apires_code('SUCCESS'));
            }
        }

        return response()->json([
            'statusCode' => apires_code('ERROR'),
            'message' => apires_message('ERROR'),
            'result' => [
                'data' => [
                    'username' => $inputs->username,
                    'email' => $inputs->email
                ]
            ]
        ], apires_code('ERROR'));
    }


    public function change_user(Request $request)
    {
        $inputs = $request->all();

        $validation = Validator::make($inputs, [
            'customer_id'   => 'required|numeric',
            'username'      => 'required|string|max:255',
            'email'         => 'max:255'
        ], [
            'username.required' => "Customer name is required",
            'customer_id.required' => "Customer ID is required.",
            'customer_id.numeric'  => "Customer ID must be numeric",
            // 'email.email'    => "Invalid email format",
            // 'email.unique'    => "Email address must be a unique",
        ]);

        if ($validation->fails()) 
        {
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

        $bearerToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($bearerToken);
        $customerId = $token->tokenable_id;

        $customer_id    = $request->customer_id;
        if($customerId == $customer_id)
        {
            $customer = Customer::find($customer_id);

            if (!$customer) {
                return response()->json([
                    'statusCode' => apires_code('ERROR'),
                    'message' => apires_message('USER_NOT_FOUND'),
                    'result' => [
                        'data' => []
                    ]
                ], apires_code('ERROR'));
            }

            $save_user = $customer->update([
                'name'  => $request->username,
                'email' => ($request->email)?$request->email:"",
            ]);

            if($save_user){
                $customer->image = base_url($customer->image);
                return response()->json([
                    'statusCode'    => apires_code('SUCCESS'),
                    'message'       => apires_message('SUCCESS'),
                    'result'        => [
                        'data'  => $customer
                    ]
                ], apires_code('SUCCESS'));
            }
        }

        return response()->json([
            'statusCode' => apires_code('ERROR'),
            'message' => apires_message('ERROR_INVALID_CUSTOMER_ID'),
            'result' => [
                'data' => [
                    'username' => $inputs->username,
                    'email' => $inputs->email
                ]
            ]
        ], apires_code('ERROR'));
    }


    public function verify_otpcode1(Request $request)
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

        $bearerToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($bearerToken);
        $customer_id = $token->tokenable_id;

        $customer = Customer::where('id', '=', $customer_id)->get();

        if(count($customer) >0 && $customer[0]->otp_code == $request->otp_code)
        {   
            $user = Customer::find($customer[0]->id);
            $verify_at = Carbon::now();

            $phone_verified = $user->update([
                'phone_verified_at' => $verify_at,
            ]);

            if($phone_verified)
            {
                return response()->json([
                    'statusCode' => apires_code('SUCCESS'),
                    'message' => apires_message('OTP_CODE_VERIFY_SUCCESS'),
                    'result' => [
                        'data' => [
                            'token' => $bearerToken,
                            'type' => 'bearer',
                            'phone_verified_date' => $verify_at,
                        ]
                    ]
                ], apires_code('SUCCESS'));                
            }
            else{
                return response()->json([
                    'statusCode' => apires_code('ERROR'),
                    'message' => apires_message('OTP_CODE_VERIFY_ERROR'),
                    'result' => [
                        'data' => [
                            'token' => $bearerToken,
                            'type' => 'bearer',
                        ]
                    ]
                ], apires_code('ERROR'));
            }

        }


        return response()->json([
            'statusCode' => apires_code('ERROR'),
            'message' => apires_message('INVALID_OTP_CODE'),
            'result' => [
                'data' => [
                    'token' => $bearerToken,
                    'type' => 'bearer',
                ]
            ]
        ], apires_code('ERROR'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
