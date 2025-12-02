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
            'interest' => 'nullable|string|max:255',
            'current_field' => 'nullable|string|max:255',
            'field' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|integer|min:2005|max:' . date('Y'),
        ]);

        // determine role (default mahasiswa)
        $role = $request->input('role', 'mahasiswa');

        // Provide DB-safe defaults for columns that are NOT NULL in migration
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // migration requires these columns to be non-null; use empty string / 0 if absent
            'nim' => $request->input('nim', ''),
            'study_program' => $request->input('study_program', ''),
            'class' => $request->input('class', ''),
            'image' => $request->input('image', ''),
            'interest' => $request->input('interest', ''),
            'field' => $request->input('field', ''),
            'current_field' => $request->input('current_field', ''),
            'graduation_year' => $request->input('graduation_year', null),
            'contact' => $request->input('contact', 0),
            'role' => $role,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan masuk.');
    }
}
