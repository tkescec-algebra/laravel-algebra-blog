<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        return view('login');
    }

    public function authenticate(LoginRequest $request)
    {
        return $this->authService->authenticate($request);
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        return $this->authService->register($request);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout( $request);
    }
}
