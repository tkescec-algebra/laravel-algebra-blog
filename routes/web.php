<?php

use App\Http\Controllers\AuthController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('auth/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('auth/login', [AuthController::class, 'authenticate'])->name('post.login');

Route::get('auth/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('auth/register', [AuthController::class, 'register'])->name('post.register');

Route::get('dashboard', function () {
    dd(auth()->user());
})->middleware('auth')->name('dashboard');
