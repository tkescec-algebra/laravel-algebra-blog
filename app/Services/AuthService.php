<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function authenticate(FormRequest $request)
    {
        $credentials = $request->safe(['email', 'password']);

        if (Auth::attempt($credentials)) {
           $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'credentials' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(FormRequest $request)
    {
        $data = $request->safe(['first_name', 'last_name', 'email', 'password']);
        $user = User::create($data);
        Auth::login($user);

        return redirect()->intended('dashboard');
    }
}
