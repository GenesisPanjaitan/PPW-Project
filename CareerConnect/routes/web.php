<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RegisterController;

// Halaman utama
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
// Public pages
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

// Auth routes (login/register)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'select'])->name('register');
Route::get('/register/student', [RegisterController::class, 'student'])->name('register.student');
Route::get('/register/alumni', [RegisterController::class, 'alumni'])->name('register.alumni');
Route::post('/register', [RegisterController::class, 'submit'])->name('register.submit');

// Group routes that require authentication
Route::middleware('auth')->group(function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::get('/favorit', [FavoriteController::class, 'index'])->name('favorit');
	Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
	Route::get('/profile/academic', [ProfileController::class, 'academic'])->name('profile.academic');
	Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
	Route::get('/recruitment', [RecruitmentController::class, 'index'])->name('recruitment');
	Route::get('/recruitment/detail', [RecruitmentController::class, 'detail'])->name('recruitment.detail');
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
// End of routes