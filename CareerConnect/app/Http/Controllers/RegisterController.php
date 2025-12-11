<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Check if user is already logged in (from Google OAuth)
        $isUpdatingProfile = Auth::check();
        $user = Auth::user();

        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'nim' => 'nullable|string|max:50',
            'study_program' => 'nullable|string|max:255',
            'class' => 'nullable|string|max:100',
            'interest' => 'nullable|string|max:255',
            'current_field' => 'nullable|string|max:255',
            'field' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|integer|min:2005|max:' . date('Y'),
        ];

        // Only validate email and password for new registrations
        if (!$isUpdatingProfile) {
            $rules['email'] = 'required|email|max:255|unique:user,email';
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        $data = $request->validate($rules);

        // determine role (default mahasiswa)
        $role = $request->input('role', 'mahasiswa');

        if ($isUpdatingProfile) {
            // Update existing user profile
            $user->update([
                'name' => $data['name'],
                'nim' => $request->input('nim', ''),
                'study_program' => $request->input('study_program', ''),
                'class' => $request->input('class', ''),
                'interest' => $request->input('interest', ''),
                'field' => $request->input('field', ''),
                'current_field' => $request->input('current_field', ''),
                'graduation_year' => $request->input('graduation_year', null),
                'contact' => $request->input('contact', ''),
                'role' => $role,
            ]);

            $roleName = $role === 'alumni' ? 'Alumni' : 'Mahasiswa';
            return redirect()->route('home')->with([
                'register_success' => true,
                'user_name' => $user->name,
                'user_role' => $roleName
            ]);
        } else {
            // Create new user with all fields explicitly set
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'nim' => $request->input('nim'),
                'study_program' => $request->input('study_program'),
                'class' => $request->input('class'),
                'image' => null,
                'interest' => $request->input('interest'),
                'field' => $request->input('field'),
                'current_field' => $request->input('current_field'),
                'graduation_year' => $request->input('graduation_year'),
                'contact' => $request->input('contact'),
                'experience' => null,
                'role' => $role,
            ]);

            // Auto-login after registration
            Auth::login($user);

            $roleName = $role === 'alumni' ? 'Alumni' : 'Mahasiswa';
            return redirect()->route('home')->with([
                'register_success' => true,
                'user_name' => $user->name,
                'user_role' => $roleName
            ]);
        }
    }
}