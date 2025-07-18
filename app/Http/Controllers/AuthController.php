<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
    $credentials = $request->only('username', 'password');

    $user = User::where('username', $credentials['username'])->first();

    if ($user && Hash::check($credentials['password'], $user->password)) {
        Auth::login($user);

        if ($user->role === 'operator') {
            return redirect()->intended('/operator/dashboard');
        } elseif ($user->role === 'supervisor') {
            return redirect()->intended('/supervisor/dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }
    }

    return back()->withErrors(['login_error' => 'Username atau password salah.']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
