<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
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

// public route
// problem #1
Route::get('/gapwithfiveexclusion/{start_number}/{end_number}', [TaskController::class, 'ReturnGapWithFiveExclusion'])
->where(['start_number' => '[-]?[0-9]+', 'end_number'=> '[-]?[0-9]+']);
// Problem #2
Route::get('/alpha/convert/{input_alpha}', [TaskController::class, 'ConvertAlphaToDecimal'])
->whereAlpha('input_alpha');
// Problem #3
// Route::get('/', [TaskController::class, '']);

// User public routes 
Route::post('users/register', [AuthController::class, 'Register']);
Route::post('users/login', [AuthController::class, 'Login']);

// User protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/users', UsersController::class, ['except'=> ['store']]);
    Route::post('/users/logout', [AuthController::class, 'Logout']);
});