<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group(['middleware' => 'guest', 'prefix' => 'auth'], function () {
    Route::get('login', [AuthController::class, 'login'])->name('showLogin');
    Route::post('login', [AuthController::class, 'authenticate'])->name('post.login');

    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('post.register');
});


Route::group(['middleware' => AuthMiddleware::class], function () {
    Route::get('auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'admin'], function (){
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('posts', PostController::class);
    });
});

Route::get('test', function () {
    dd(AuthController::class);
});
