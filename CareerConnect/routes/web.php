<?php

use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman home
Route::get('/home', function () {
    return view('home');
});

// Halaman about
Route::get('/about', function () {
    return view('about');
});

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
})->name('login');

// Proses login
Route::post('/login', function () {
})->name('login.submit');


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