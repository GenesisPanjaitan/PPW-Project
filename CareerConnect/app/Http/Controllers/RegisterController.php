<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function select()
    {
        return view('auth.registerselect');
    }

    public function student()
    {
        return view('auth.register-student');
    }

    public function alumni()
    {
        return view('auth.register-alumni');
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:user,email',
            'password' => 'required|string|min:6|confirmed',
            'nim' => 'nullable|string|max:50',
            'study_program' => 'nullable|string|max:255',
            'class' => 'nullable|string|max:100',
        ]);

        // determine role (default mahasiswa)
        $role = $request->input('role', 'mahasiswa');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nim' => $data['nim'] ?? null,
            'study_program' => $data['study_program'] ?? null,
            'class' => $data['class'] ?? null,
            'image' => null,
            'interest' => null,
            'field' => null,
            'contact' => null,
            'role' => $role,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan masuk.');
    }
}
