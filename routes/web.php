<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => '',
    'as' => 'user.'
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login_post');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register_post');
    Route::get('confirm', [AuthController::class, 'confirm'])->name('confirm');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware(['auth', 'is_verify_email']); //snake_case
    Route::get('account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user_verify');
    // reset password
    Route::get('forgotpassword', [AuthController::class, 'forgotpassword'])->name('forgotpassword');
    Route::post('post-forgotpassword', [AuthController::class, 'postforgotpassword'])->name('post_forgotpassword');
    Route::get('resetpassword/{token}', [AuthController::class, 'verifyPasswordReset'])->name('link_resetpassword');
});


// users 
Route::resource('users', UserController::class);
// test send mail spam
Route::get('/send-mail', [SendEmailController::class, 'getSendEmail'])->name('get_send_email');
Route::post('/send-mail', [SendEmailController::class, 'postSendEmail'])->name('post_send_email');
