<?php

use App\Http\Controllers\AuthController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('auth/login', [AuthController::class, 'login'])->name('login');
Route::post('auth/login', [AuthController::class, 'authenticate'])->name('post.login');
