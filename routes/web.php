<?php

use App\Http\Controllers\shopUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('test');
});


Route::prefix('auth')->group(function () {
    Route::post('/login', [shopUserController::class, 'authenticate']);

});
