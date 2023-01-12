<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/employee', [ApiController::class, 'employee']);


Route::group([
    'middleware' => 'auth:api',
], function ($router) {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'userProfile']);
    Route::get('/loan/list', [ApiController::class, 'listLoan']);
    Route::post('/loan/create', [ApiController::class, 'createLoan']);
    Route::post('/user/ekyc', [ApiController::class, 'ekyc']);
    Route::post('/user/cmnd', [ApiController::class, 'cmnd']);
    Route::post('/user/withdrawal', [ApiController::class, 'withdrawal']);
    Route::post('/user/history', [ApiController::class, 'history']);


});
