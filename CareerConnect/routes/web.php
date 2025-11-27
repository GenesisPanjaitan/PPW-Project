<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RegisterController;

/**
 * Public (unauthenticated) routes
 * Keep only login and registration public. All other pages are protected.
 */
// Public landing page (visible to guests). Clicking the logo should go here.
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [RegisterController::class, 'select'])->name('register');
Route::get('/register/student', [RegisterController::class, 'student'])->name('register.student');
Route::get('/register/alumni', [RegisterController::class, 'alumni'])->name('register.alumni');
Route::post('/register', [RegisterController::class, 'submit'])->name('register.submit');

/**
 * Protected routes — requires authentication
 * Any attempt to access these routes when not authenticated will be
 * redirected to the `login` route by Laravel's `auth` middleware.
 */
Route::middleware('auth')->group(function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home');


	Route::get('/favorit', [FavoriteController::class, 'index'])->name('favorit');
	Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
	Route::get('/profile/academic', [ProfileController::class, 'academic'])->name('profile.academic');
	Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
	Route::get('/recruitment', [RecruitmentController::class, 'index'])->name('recruitment');
	// dynamic detail by id
	Route::get('/recruitment/{id}', [RecruitmentController::class, 'detailById'])->name('recruitment.detail');

	// edit/update/delete recruitment (protected)
	Route::get('/recruitment/{id}/edit', [RecruitmentController::class, 'edit'])->name('recruitment.edit');
	Route::match(['put','patch'],'/recruitment/{id}', [RecruitmentController::class, 'update'])->name('recruitment.update');
	Route::delete('/recruitment/{id}', [RecruitmentController::class, 'destroy'])->name('recruitment.destroy');

	// store new recruitment posting
	Route::post('/recruitment', [RecruitmentController::class, 'store'])->name('recruitment.store');

	// favorite (save) and unfavorite
	Route::post('/favorite/{id}', [FavoriteController::class, 'store'])->name('favorite.store');
	Route::delete('/favorite/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

	// store comment for recruitment
	Route::post('/recruitment/{id}/comment', [RecruitmentController::class, 'storeComment'])->name('recruitment.comment');

	// Logout should be a POST; keep it protected
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Fallback: if any other route is defined later, make sure middleware is applied accordingly.