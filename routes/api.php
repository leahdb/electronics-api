<?php

use App\Http\Controllers\Auth\shopUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\SecureFileController;
use App\Http\Controllers\Dashboard\Product\ProductController as DashboardProductController;
use App\Http\Controllers\Shop\Product\ProductController as ShopProductController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\PCB\GerberController;
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

// General shop APIs that doesn't require authentication
Route::resource('/products', ShopProductController::class);
Route::get('/shop-home', [ShopController::class, 'index']);
Route::post('/upload-gerber', [GerberController::class, 'uploadGerber'])->name('upload-gerber');
Route::get('/download/file/{token}', [SecureFileController::class, 'download']);


