<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// use App\Http\Middleware\AuthenticateWithToken;
use App\Http\Controllers\BackendApi\AdminAuthController;
use App\Http\Controllers\BackendApi\AdminApiCategoryController;
use App\Http\Controllers\BackendApi\AdminApiBookController;
use App\Http\Controllers\BackendApi\AdminApiMemberController;
use App\Http\Controllers\BackendApi\AdminApiIssuesController;

/*Start Version V1*/
// Route::group(['middleware' => ['admin', 'api.key'], 'prefix' => 'v1'], function(){

//     /*User API*/

//     Route::post('/login', [AuthController::class, 'login'])->name('login');

//     Route::group(['middleware' => ['AuthenticateWithToken', 'throttle:60,1'], 'prefix' => 'v1'], function(){

//         /*Category API*/
//     	Route::post('/category', [AdminApiCategoryController::class, 'index'])->name('category');
//         // Route::post('/category', [CategoryApiController::class, 'index'])->name('category');

//     });

// });

Route::group(['middleware' => ['admin', 'api.key'], 'prefix' => 'v1'], function(){
    Route::post('login', [AdminAuthController::class, 'login']);

    Route::middleware(['admin-api.auth'])->group(function () {
        Route::post('logout', [AdminAuthController::class, 'logout']);
        
        Route::post('/category', [AdminApiCategoryController::class, 'index'])->name('category');
        Route::post('/category/create', [AdminApiCategoryController::class, 'store'])->name('categoryCreate');
        Route::post('/books', [AdminApiBookController::class, 'index'])->name('books');
        Route::post('/books/create', [AdminApiBookController::class, 'store'])->name('booksCreate');
        Route::post('/books/detail', [AdminApiBookController::class, 'show'])->name('booksShow');

        Route::post('/issues', [AdminApiIssuesController::class, 'index'])->name('issues');
        Route::post('/issues/create', [AdminApiIssuesController::class, 'store'])->name('issuesCreate');
        Route::post('/issues/detail', [AdminApiIssuesController::class, 'show'])->name('issuesShow');
    });
});


/*End Version V1*/




