<?php

use App\Http\Controllers\Auth\shopUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Product\ProductController as DashboardProductController;
use App\Models\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [RegistrationController::class, 'register']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [DashboardUserController::class, 'resetPassword']);
});

Route::group(['middleware' => 'auth:shop'], function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'getAuthenticatedUser']);
    });

    Route::prefix('dash')->group(function () {
        Route::group(['middleware' => 'shopRole:' . implode(',', [ShopUser::ROLE_SUPER_ADMIN])], function () {
            Route::resource('/products', DashboardProductController::class);
            Route::get('/shop-users', [ShopUserController::class, 'index']);
        });
    });

});



