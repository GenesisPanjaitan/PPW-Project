<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        $isNewUser = false;

        if (! $user) {
            $user = User::create([
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Pengguna',
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(uniqid('google_', true)),
                'nim' => '',
                'study_program' => '',
                'class' => '',
                'image' => $googleUser->getAvatar() ?? '',
                'interest' => '',
                'field' => '',
                'current_field' => '',
                'graduation_year' => null,
                'contact' => '',
                'role' => 'mahasiswa',
                'login_method' => 'google',
            ]);
            $isNewUser = true;
        }

        Auth::login($user, true);

        // Check if profile is incomplete (only for new users)
        if ($isNewUser) {
            return redirect()->route('register')->with('info', 'Silakan lengkapi data diri Anda terlebih dahulu.');
        }

        return redirect()->intended(route('home'))->with('login_success', 'Anda berhasil login dengan google');
    }
}