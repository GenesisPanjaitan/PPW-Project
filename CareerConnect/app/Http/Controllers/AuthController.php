<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Check if user is admin
            $adminEmails = ['kevin@admin.com', 'genesis@admin.com', 'tiffani@admin.com', 'ariela@admin.com'];
            $user = Auth::user();
            
            if (in_array($user->email, $adminEmails)) {
                // Redirect admin to admin dashboard
                return redirect()->route('admin.dashboard')->with('login_success', 'Selamat datang, Administrator!');
            }
            
            // Regular user redirect
            return redirect()->intended(route('home'))->with('login_success', 'Selamat datang!');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
