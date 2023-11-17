<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// use App\Http\Middleware\AuthenticateWithToken;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\CustomerApiController;

/*Start Version V1*/
Route::group(['middleware' => ['api', 'api.key', 'cors'], 'prefix' => 'v1'], function(){

    /*User API*/
    Route::controller(AuthController::class)->group(function () {
        Route::post('customer/register', 'register')->name('register');
        Route::post('auth/login', 'login')->name('login');//email & password
    });

    Route::post('/category', [CategoryApiController::class, 'index'])->name('category');

    Route::group(['middleware' => ['AuthenticateWithToken', 'throttle:60,1'], 'prefix' => 'v1'], function(){

        /*Category API*/
        // Route::post('/category', [CategoryApiController::class, 'index'])->name('category');

    });

});



/*End Version V1*/




