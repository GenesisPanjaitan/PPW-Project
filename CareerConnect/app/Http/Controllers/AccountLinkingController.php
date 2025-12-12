<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountLinkingController extends Controller
{
    public function select(Request $request): RedirectResponse
    {
        $email = $request->input('email');
        $action = $request->input('action');
        $newMethod = $request->input('new_method');
        $providerData = json_decode($request->input('provider_data'), true);

        if ($action === 'login') {
            // Login dengan akun lama
            $user = User::where('email', $email)->first();
            
            if ($user) {
                Auth::login($user, true);
                return redirect()->intended(route('home'))->with('login_success', 
                    'Berhasil masuk dengan akun ' . ucfirst($user->login_method) . '');
            }
            
            return redirect()->route('login')->with('error', 'Akun tidak ditemukan');
        } 
        elseif ($action === 'new') {
            // Buat akun baru dengan provider baru (biarkan role dipilih di halaman berikutnya)
            $user = User::create([
                'name' => $providerData['name'] ?? 'Pengguna',
                'email' => $email,
                'password' => Hash::make(uniqid($newMethod . '_', true)),
                'nim' => '',
                'study_program' => '',
                'class' => '',
                'image' => $providerData['avatar'] ?? '',
                'interest' => '',
                'field' => '',
                'current_field' => '',
                'graduation_year' => null,
                'contact' => '',
                // Set default role to satisfy NOT NULL constraint; user will choose role on next page
                'role' => 'mahasiswa',
                'login_method' => $newMethod,
            ]);

            Auth::login($user, true);

            return redirect()->route('register')->with([
                'info' => 'Anda login dengan ' . ucfirst($newMethod) . ' (' . $email . '). Pilih tipe akun (Mahasiswa/Alumni) dan lengkapi data.',
                'hide_oauth' => true,
            ]);
        }

        return redirect()->route('login')->with('error', 'Aksi tidak valid');
    }
}
