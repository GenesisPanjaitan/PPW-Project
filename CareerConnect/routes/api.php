<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecruitmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
| All routes here are automatically prefixed with "/api"
| Example: /api/favorite/1
|
*/

/**
 * Test endpoint - No authentication required
 */
Route::get('/test', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API is working',
        'timestamp' => now()->toDateTimeString()
    ]);
});

/**
 * Test favorite endpoint - No authentication required (for testing only)
 */
Route::post('/test-favorite/{id}', function ($id) {
    return response()->json([
        'status' => 'ok',
        'message' => 'Test favorite endpoint working (no auth required)',
        'recruitment_id' => (int)$id,
        'note' => 'This is a test endpoint. Use /api/favorite/{id} with authentication for real usage.'
    ]);
});

/**
 * Login endpoint for API testing (No CSRF required)
 */
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials, true)) {
        $user = Auth::user();
        return response()->json([
            'status' => 'ok',
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]
        ]);
    }
    
    return response()->json([
        'status' => 'error',
        'message' => 'Invalid credentials'
    ], 401);
});

/**
 * Protected API routes - Requires authentication
 * Note: For testing in Postman, you still need to pass session cookie from browser login
 * or implement token-based authentication (Laravel Sanctum)
 */
Route::middleware('auth')->group(function () {
    
    // Get authenticated user info
    Route::get('/user', function (Request $request) {
        return response()->json([
            'status' => 'ok',
            'user' => $request->user()
        ]);
    });

    /**
     * Favorite API Endpoints
     */
    Route::prefix('favorite')->group(function () {
        // Add to favorite
        Route::post('/{id}', [FavoriteController::class, 'store']);
        
        // Remove from favorite
        Route::delete('/{id}', [FavoriteController::class, 'destroy']);
        
    });

    /**
     * Recruitment API Endpoints
     */
    Route::prefix('recruitment')->group(function () {
       
        // Create new recruitment (Alumni only)
        Route::post('/', [RecruitmentController::class, 'store']);
        
        // Update recruitment
        Route::put('/{id}', [RecruitmentController::class, 'update']);
        
        // Delete recruitment
        Route::delete('/{id}', [RecruitmentController::class, 'destroy']);
        
        // Add comment to recruitment
        Route::post('/{id}/comment', [RecruitmentController::class, 'storeComment']);
    }); 


});
