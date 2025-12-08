<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;

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
	Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile/academic', [ProfileController::class, 'academic'])->name('profile.academic');
	Route::post('/profile/academic', [ProfileController::class, 'updateAcademic'])->name('profile.academic.update');
	Route::get('/profile/alumni', [ProfileController::class, 'alumni'])->name('profile.alumni');
	Route::post('/profile/alumni', [ProfileController::class, 'updateAlumni'])->name('profile.alumni.update');
	Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
	Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
	Route::get('/recruitment', [RecruitmentController::class, 'index'])->name('recruitment');
	
	// my posts for alumni (harus sebelum route dinamis)
	Route::get('/recruitment/my-posts', [RecruitmentController::class, 'myPosts'])->name('recruitment.my-posts');

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

	// Debug: return current user's favorite recruitment ids (temporary)
	Route::get('/debug/my-favorites', function () {
	    $userId = auth()->id();
	    $my = DB::table('favorite')->where('user_id', $userId)->pluck('recruitment_id');
	    $all = DB::table('favorite')->get();
	    return response()->json(['user_id' => $userId, 'my_favorites' => $my, 'all_favorites' => $all]);
	});

	// Debug: check current user role and switch role (for testing only)
	Route::get('/debug/role', function () {
	    $user = auth()->user();
	    return response()->json([
	        'user_id' => $user->id,
	        'name' => $user->name,
	        'email' => $user->email,
	        'current_role' => $user->role
	    ]);
	});

	// Debug: switch user role (for testing - development only)
	Route::get('/debug/switch-role/{role}', function ($role) {
	    if (!in_array($role, ['mahasiswa', 'alumni', 'admin'])) {
	        return response()->json(['error' => 'Invalid role'], 400);
	    }
	    $user = auth()->user();
	    $user->update(['role' => $role]);
	    return response()->json([
	        'message' => 'Role changed successfully',
	        'new_role' => $user->role
	    ]);
	});

	// Logout should be a POST; keep it protected
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



	Route::prefix('admin')->middleware('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Data Master Routes
    Route::get('/mahasiswa', [AdminController::class, 'mahasiswa'])->name('admin.mahasiswa');
    Route::get('/alumni', [AdminController::class, 'alumni'])->name('admin.alumni');
    Route::get('/lowongan', [AdminController::class, 'lowongan'])->name('admin.lowongan');
    Route::get('/lowongan/{id}/detail', [AdminController::class, 'lowonganDetail'])->name('admin.lowongan.detail');
    Route::delete('/lowongan/{id}', [AdminController::class, 'lowonganDelete'])->name('admin.lowongan.delete');
    Route::get('/mahasiswa/{id}/detail', [AdminController::class, 'mahasiswaDetail'])->name('admin.mahasiswa.detail');
    Route::delete('/mahasiswa/{id}', [AdminController::class, 'mahasiswaDelete'])->name('admin.mahasiswa.delete');
    Route::get('/alumni/{id}/detail', [AdminController::class, 'alumniDetail'])->name('admin.alumni.detail');
    Route::delete('/alumni/{id}', [AdminController::class, 'alumniDelete'])->name('admin.alumni.delete');
    Route::get('/registrations', [AdminController::class, 'registrations'])->name('admin.registrations');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/notifications/mark-read', [AdminController::class, 'markNotificationsRead'])->name('admin.notifications.markRead');

});

});