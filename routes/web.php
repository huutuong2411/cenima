<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AuthAdminController;
use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\AdminMovieController;
use App\Http\Controllers\NotificationSendController;

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
    Route::get('/', [HomeController::class, 'index'])->name('home'); //snake_case;
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login_post');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register_post');
    Route::get('confirm', [AuthController::class, 'confirm'])->name('confirm');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user_verify');
    // reset password
    Route::get('forgotpassword', [AuthController::class, 'forgotpassword'])->name('forgotpassword');
    Route::post('post-forgotpassword', [AuthController::class, 'postforgotpassword'])->name('post_forgotpassword');
    Route::get('account/resetpassword/{token}', [AuthController::class, 'verifyPasswordReset'])->name('link_resetpassword');
    Route::get('resetpassword/{id}', [AuthController::class, 'resetpassword'])->name('resetpassword');
    Route::post('resetpassword/{id}', [AuthController::class, 'updatepassword'])->name('post_resetpassword');
});


// users 
Route::resource('users', UserController::class);
// test send mail spam
Route::get('/send-mail', [SendEmailController::class, 'getSendEmail'])->name('get_send_email');
Route::post('/send-mail', [SendEmailController::class, 'postSendEmail'])->name('post_send_email');


Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get("/home", function () {
        return view("admin.home");
    });

    Route::post('/store-token', [NotificationSendController::class, 'updateDeviceToken'])->name('store.token');
    Route::get('/send-web-notification', [NotificationSendController::class, 'sendNotification'])->name('send_web_notification');

    Route::get('/login', [AuthAdminController::class, 'index'])->name('login');
    Route::post('/login', [AuthAdminController::class, 'login'])->name('login.post');
    Route::get('/logout', [AuthAdminController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('dashboard'); //snake_case;
    Route::group([
        'prefix' => 'movie',
    ], function () {
        Route::get('/', [AdminMovieController::class, 'index'])->name('movie');
        Route::get('/add', [AdminMovieController::class, 'create'])->name('create_movie');
        Route::post('/store', [AdminMovieController::class, 'store'])->name('store_movie');
    });
});
