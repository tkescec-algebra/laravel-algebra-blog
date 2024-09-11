<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthService
{
    public function authenticate(FormRequest $request)
    {
        $credentials = $request->safe(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'credentials' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(FormRequest $request)
    {
        try {
            $data = $request->safe(['first_name', 'last_name', 'email', 'password']);

            $user = User::create($data);
            $role = Role::where('name', 'User')->first()->getKey();
            $user->roles()->attach($role);

            Auth::login($user);

            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            Log::error($e);
            return back()->withErrors([
                'error' => 'An error occurred while registering the user.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
