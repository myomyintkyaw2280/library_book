<?php

use Carbon\Carbon;
// use URL;

/*
* Base Url Setup
*/

if(!function_exists('base_url')){
	function base_url($url=""){
		if($_SERVER["REMOTE_ADDR"] == "127.0.0.1"){
			$local = True;
		}else{

		    $local = False;
		}
		if ($local) {
		    // You are in the local development environment
		    if($url !="" && file_exists($url)){
				$base_url = asset($url);
			}else{
				$base_url = asset('/public/'.$url);
			}
		} else {
		    // You are in the production environment
			if($url !="" && file_exists($url)){
				$base_url = asset('public/'.$url);
			}else{
				$base_url = asset('public').'/';
			}
		}
		return $base_url;
	}
}

/*
* DataTable PerPageRow
*/

if(!function_exists('getTableRow')){
	function getTableRow(){
		return 25;
	}
}


if(!function_exists('generateRandomString'))
{
	function generateRandomString($length = 30) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+<>?|}{';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}


/*
* OTP Code API Setup
*/

if(!function_exists('verifiedOtpCode')){
	function verifiedOtpCode($otp_code){

		//OTP Code Verify Process
		if($otp_code === "111111"){
			return true;
		}

		return false;
	}
}


/*
* Language Translate
*/

if(!function_exists('translate')){
	function translate($text){

		$lang = [
			'app_name' 			=> "Library Book Management System",
			'app_name_short'	=> "LBMS",
			'dashboard' 		=> "Dashboard",
			'welcome_to' 		=> "Welcome to",
			'english' 			=> "EN",
			'myanmar' 			=> "MM",
			
			'customers' 		=> "Customers",
			
			'permission' 		=> "Permissions",
			'admin_setting' 	=> "Admin Setting",
			'admin_panel'		=> "Admin Dashboard",
			'admin_login'		=> "Admin Login",

			// Default Column Lable
			'created_at' => "Created Date",
			'updated_at' => "Updated Date",
			'id' 		 => "ID",
			'name' 		 => "Name",
			'status' 	 => "Status",

			//Button Label
			'backBtn'		=> "Back",
			'editBtn'		=> "Edit",
			'addnewBtn'  	=> "Add New",
			'saveBtn'	 	=> "Save",
			'cancelBtn'  	=> "Cancel",
			'closeBtn' 	 	=> "Close",
			'updateBtn'  	=> "Update",
			'deleteBtn'  	=> "Delete",
			'action' 	 	=> "Action",
			'loginBtn' 		=> "Log In",

			//Text Button
			'remember_me' 	=> "Remember Me",
			'home'			=> "Home",

			//Form Label
			'email_address' 	=> "Email Address",
			'password' 			=> "Password",
			'confirm_password' 	=> "Confirm Password",

			// Title
			'welcome_back' 		  => "Welcome Back!",
			'sign_in_as' 		  => "Sign in as Admin to",
			'are_you_sure_delete' => "Are you sure you want to delete:",
			'title_customers' 	  => "Customers",
			'title_admin_users'   => "Admin Users",
			'add_new_user' 		  => "Add New Admin User",
			'edit_admin_user' 	  => "Edit Admin User",
			'edit_admin_role' 	  => "Edit Admin Role",

			//Admin User
			'add_new_user' 		=> "Add New Admin User",
			'admin_users'  		=> "Admin Users",
			'admin_users_list' 	=> "Admin Users List",
			'admin_id' 			=> "Admin User ID",
			'admin_name' 		=> "Admin User Name",
			'admin_email' 		=> "Admin User Email",
			'admin_role' 		=> "Admin User role",

			//Roles
			'roles' 			=> "Roles",
			'roles_list' 		=> "Roles List",

			//Country

			
			'active'		=> "Active",
			'not_active'	=> "Not Active",
			'image'			=> "Image",

			// Delete Title
			
			'delete_customer_title'  	=> "Delete Customer",
			'delete_role_title' 		=> "Delete Role",
			'delete_permission_title' 	=> "Delete Permission",

			
			'customer_title'  	=> "Customer Title",
			'role_title' 		=> "Role Title",
			'permission_title' 	=> "Permission Title",

            //Category
            'categories' 		=> "Categories",
            'category'			=> "Categories",
            'category_name'		=> "Category Name",
			'category_list'		=> "Category List",
			'category_image'	=> "Category Images",
			'category_url'		=> "Category Link",


			 //Books
            'books' 		=> "Books",
            'books_name'	=> "Books Title",
			'books_list'	=> "Books List",
			'books_image'	=> "Cover Images",
			"book_isbn_no" => "ISBN No.",




		];

		return isset($lang[$text])? $lang[$text]: ucwords(str_replace('_', ' ', $text));
	}
}


/*
* Custom Date Format
*/

if(!function_exists('custom_date_format')){
	function custom_date_format($param){
		$cus_format = "";
		if($param){
			// $cus_format = Carbon::createFromFormat('Y-m-d H:i:s', $param)->format('d-M-Y');
			// $cus_format = date_format($param,'d-M-Y');
			// $cus_format = date_format(strtotime($param), 'd-m-Y');
			$date = new DateTime($param);

			// Format the date using the date_format method
			$cus_format = $date->format('d-m-Y');

		}
		return $cus_format;
	}
}


/*
* Api Response Status Code
*/

if(!function_exists('apires_code')){
	function apires_code($statusCode){

	    $statusCodeData = array(
	    	'SUCCESS' 					=> 200,
	    	'SUCCESS_LOGIN'				=> 201,
	    	'SUCCESS_LOGOUT'			=> 202,
	    	'DATA_NOT_FOUND'			=> 203,

	    	'BAD_REQUEST' 				=> 400,
	    	'UNAUTHORIZED' 				=> 401,
	    	'PAYMENT_REQUIRED' 			=> 402,
	    	'FORBIDDEN' 				=> 403,
	    	'NOT_FOUND' 				=> 404,
	    	'METHOD_NOT_ALLOWED'		=> 405,
	    	'REQUEST_TIMEOUT'			=> 408,
	    	'ERROR' 					=> 409,
	    	'UNSUPPORTED_MEDIA_TYPE'	=> 415,
	    	'VALIDATE_ERROR' 			=> 422,
	    	'ACCOUNT_LOCKED'			=> 423,
	    	'TOO_MANY_REQUEST' 			=> 429,

	    	'INTERNAL_SERVER_ERROR'		=> 500,
	    	'BAD_GATEWAY'			 	=> 502,
	    	'SERVICE_UNAVAILABLE'	 	=> 503,
	    	'GATEWAY_TIMEOUT'		 	=> 504,
	    	'HTTP_VERSION_NOT_SUPPORT' 	=> 505,
	    	'INSUFFICIENT_STORAGE'	 	=> 507,
	    );

		return $statusCodeData[$statusCode];
	}
}


/*
* Api Response Message
*/

if(!function_exists('apires_message')){
	function apires_message($statusCode){
		$successCodeData = array(
	    	'SUCCESS' 					=> 'Success',	//200
	    	'SUCCESS_NO_DATA'			=> 'Success : There is no data available',	//200 // DOES NOT HAVE DATA
	    	'SUCCESS_IMAGE'				=> 'Successfully saved profile image',
	    	'ERROR_IMAGE'				=> 'Profile image is empty',
	    	'DATA_NOT_FOUND'			=> 'User data not found',
	    	'SUCCESS_CREATE_USER' 		=> 'Successfully created account',
	    	'ERROR_UPDATE' 				=> 'Fail to update customer data',
	    	'SUCCESS_LOGIN'				=> 'Successfully account loggin',
	    	'SUCCESS_LOGOUT'			=> 'Successfully account logout',
	    	'PHONE_EXISTS'				=> 'Phone number is already register',
	    	'OTP_CODE_VERIFY_ERROR'		=> 'Fail to verify OTP code',
	    	'OTP_CODE_VERIFY_SUCCESS' 	=> 'OTP code is successfully verified',
	    	'SEND_OTP_SUCCESS' 			=> 'OTP code is successfully sent',
	    	'RESEND_OTP_SUCCESS' 		=> 'OTP code is successfully resent',
	    	'INVALID_OTP_CODE'		 	=> 'OTP code is not valid',
	    	'USER_NOT_FOUND'			=> 'User not found',
	    	'ERROR_INVALID_CUSTOMER_ID'	=> 'Invalid Customer ID',

	    	'BAD_REQUEST' 				=> 'BAD_REQUEST',	//400
	    	'UNAUTHORIZED' 				=> 'Unauthenticated',	//401
	    	'INVALID_CREDENTIAL' 		=> 'Invalid credentials',
	    	'PAYMENT_REQUIRED' 			=> 'PAYMENT_REQUIRED',	//402
	    	'FORBIDDEN' 				=> 'FORBIDDEN',	//403
	    	'NOT_FOUND' 				=> 'NOT_FOUND',	//404
	    	'METHOD_NOT_ALLOWED'		=> 'METHOD_NOT_ALLOWED',	//405
	    	'REQUEST_TIMEOUT'			=> 'REQUEST_TIMEOUT',	//408
	    	'ERROR' 					=> 'Error',	//409
	    	'CREATE_ERROR' 				=> 'New data fails to create',	//409
	    	'UPDATE_ERROR' 				=> 'Fail to update category',	//409
	    	'UPLOAD_ERROR' 				=> 'Image does not have to upload',
	    	'UNSUPPORTED_MEDIA_TYPE'	=> 'UNSUPPORTED_MEDIA_TYPE',	//415
	    	'VALIDATE_ERROR' 			=> 'VALIDATE_ERROR',	//422
	    	'ACCOUNT_LOCKED'			=> 'ACCOUNT_LOCKED',	//423
	    	'TOO_MANY_REQUEST' 			=> 'TOO_MANY_REQUEST',	//429

	    	'INTERNAL_SERVER_ERROR'		=> 'INTERNAL_SERVER_ERROR',	//500
	    	'BAD_GATEWAY'			 	=> 'BAD_GATEWAY',	//502
	    	'SERVICE_UNAVAILABLE'	 	=> 'SERVICE_UNAVAILABLE',	//503
	    	'GATEWAY_TIMEOUT'		 	=> 'GATEWAY_TIMEOUT',	//504
	    	'HTTP_VERSION_NOT_SUPPORT' 	=> 'HTTP_VERSION_NOT_SUPPORT',	//505
	    	'INSUFFICIENT_STORAGE'	 	=> 'INSUFFICIENT_STORAGE',	//507
	    );

		return ucfirst(str_replace('_', ' ', $successCodeData[$statusCode]));
	}
}
