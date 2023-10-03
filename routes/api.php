<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\TheaterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// route login tạm
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot-password', [AuthController::class, 'sendMail']);
Route::post('reset-password/{token}', [AuthController::class, 'reset']);

// Route::middleware(['auth:api'])->group(function () {
Route::group([
    'prefix' => '',
    'as' => 'user.',
], function () {
});

//Routes admin
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth:api', 'apiIsAdmin'],
], function () {
    Route::get('/cities', [CityController::class, 'index']);
    Route::group(['prefix' => 'theaters'], function () {
        Route::get('/', [TheaterController::class, 'index']);
        Route::post('/', [TheaterController::class, 'store']);
        Route::get('/{id}', [TheaterController::class, 'show']);
        Route::put('/{id}', [TheaterController::class, 'update']);
        Route::delete('/{id}', [TheaterController::class, 'destroy']);
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });
});
