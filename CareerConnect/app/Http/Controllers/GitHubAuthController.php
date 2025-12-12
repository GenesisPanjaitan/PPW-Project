<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GitHubAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $githubUser = Socialite::driver('github')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login dengan GitHub. Silakan coba lagi.');
        }

        $email = $githubUser->getEmail();
        
        // Cari user dengan email dan login_method yang sesuai
        $user = User::where('email', $email)->where('login_method', 'github')->first();

        // Jika tidak ada user dengan GitHub, cek apakah ada user dengan email yang sama tapi provider berbeda
        if (!$user) {
            $existingUser = User::where('email', $email)->first();
            
            // Jika ada user dengan email yang sama tapi login_method berbeda, tanyakan ke user
            if ($existingUser) {
                return redirect()->route('account-linking.show')
                    ->with([
                        'email' => $email,
                        'existing_method' => $existingUser->login_method,
                        'new_method' => 'github',
                        'provider_data' => [
                            'name' => $githubUser->getName() ?? $githubUser->getNickname() ?? 'Pengguna',
                            'avatar' => $githubUser->getAvatar() ?? '',
                        ]
                    ]);
            }
        }

        $isNewUser = false;

        if (! $user) {
            $user = User::create([
                'name' => $githubUser->getName() ?? $githubUser->getNickname() ?? 'Pengguna',
                'email' => $githubUser->getEmail(),
                'password' => Hash::make(uniqid('github_', true)),
                'nim' => '',
                'study_program' => '',
                'class' => '',
                'image' => $githubUser->getAvatar() ?? '',
                'interest' => '',
                'field' => '',
                'current_field' => '',
                'graduation_year' => null,
                'contact' => '',
                'role' => 'mahasiswa',
                'login_method' => 'github',
            ]);
            $isNewUser = true;
        }

        Auth::login($user, true);

        // Check if profile is incomplete (only for new users)
        if ($isNewUser) {
            return redirect()->route('register')->with([
                'info' => 'Anda login dengan GitHub (' . $githubUser->getEmail() . '). Pilih tipe akun (Mahasiswa/Alumni) dan lengkapi data.',
                'hide_oauth' => true,
            ]);
        }

        return redirect()->intended(route('home'))->with('login_success', 'Berhasil masuk dengan GitHub');
    }
}
