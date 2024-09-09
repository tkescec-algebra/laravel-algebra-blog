<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('auth/login', [AuthController::class, 'login'])->name('showLogin')->middleware('guest');
Route::post('auth/login', [AuthController::class, 'authenticate'])->name('post.login');

Route::get('auth/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('auth/register', [AuthController::class, 'register'])->name('post.register');

Route::group(['middleware' => AuthMiddleware::class], function () {
    Route::get('auth/logout', fn() => Auth::logout())->name('logout');
    Route::get('dashboard', function () {
        dd(request());
    })->name('dashboard');
});

Route::get('test', function () {
    Log::info('Test log');
});
