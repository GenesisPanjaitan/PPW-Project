<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Halaman utama
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
// Halaman home
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/favorit', function () {
    return view('favorit');
});

// Halaman profile
Route::get('/profile', function () {
    return view('profile');
});

// Halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login'); // Ini untuk 'GET'

// =======================================================
// PERUBAHAN DI SINI
// =======================================================
// Proses login
Route::post('/login', function () {
    
    // Logika login Anda di sini...
    
    // Jika login berhasil:
    return redirect()->route('home')->with('login_success', 'Welcome, Anda telah berhasil login');

})->name('login'); // <-- Diubah dari 'login.submit' menjadi 'login'
// =======================================================


// Pilihan tipe akun
Route::get('/register', function () {
    return view('auth.registerselect');
})->name('register');

// Register Mahasiswa
Route::get('/register/student', function () {
    return view('auth.register-student'); 
})->name('register.student');

// Register Alumni
Route::get('/register/alumni', function () {
    return view('auth.register-alumni'); 
})->name('register.alumni');

// Proses register (umum)
Route::post('/register', function () {
})->name('register.submit');

// Halaman Akademik & Karir (profile)
Route::get('/profile/academic', function () {
    return view('profile_academic');
});

Route::get('/profile/settings', function () {
    return view('profile_pengaturan'); 
})->name('profile.settings');