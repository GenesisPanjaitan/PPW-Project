<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function academic()
    {
        // Jika admin, kirim data statistik untuk diagram
        if (strtolower(auth()->user()->role) === 'admin') {
            $mahasiswaCount = DB::table('user')->where('role', 'mahasiswa')->count();
            $alumniCount = DB::table('user')->where('role', 'alumni')->count();
            
            // Hitung lowongan per kategori
            $lowonganByCategory = DB::table('recruitment')
                ->join('category', 'recruitment.category_id', '=', 'category.id')
                ->select('category.name as category_name', DB::raw('count(*) as total'))
                ->groupBy('category.id', 'category.name')
                ->get();
            
            // Hitung lowongan per tipe
            $lowonganByType = DB::table('recruitment')
                ->join('jobtype', 'recruitment.jobtype_id', '=', 'jobtype.id')
                ->select('jobtype.name as type_name', DB::raw('count(*) as total'))
                ->groupBy('jobtype.id', 'jobtype.name')
                ->get();
            
            return view('profile_academic_admin', compact('mahasiswaCount', 'alumniCount', 'lowonganByCategory', 'lowonganByType'));
        }
        
        return view('profile_academic');
    }

    public function settings()
    {
        return view('profile_pengaturan');
    }

    public function update(Request $request)
    {
        // Debug log
        Log::info('=== PROFILE UPDATE STARTED ===');
        Log::info('User ID: ' . Auth::id());
        Log::info('Request data: ' . json_encode($request->all()));
        Log::info('Has image file: ' . ($request->hasFile('image') ? 'YES' : 'NO'));
        
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $user->id,
            'nim' => 'nullable|string|max:20',
            'study_program' => 'nullable|string|max:255',
            'class' => 'nullable|string|max:50',
            'interest' => 'nullable|string',
            'field' => 'nullable|string',
            'contact' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update basic info
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nim = $request->nim;
        $user->study_program = $request->study_program;
        $user->class = $request->class;
        $user->interest = $request->interest;
        $user->field = $request->field;
        $user->contact = $request->contact;

        // Handle profile image upload
        if ($request->hasFile('image')) {
            Log::info('Processing image upload...');
            
            // Delete old image if exists
            if ($user->image && file_exists(public_path('storage/profile_photos/' . $user->image))) {
                unlink(public_path('storage/profile_photos/' . $user->image));
                Log::info('Old image deleted: ' . $user->image);
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '_' . $user->id . '.' . $image->getClientOriginalExtension();
            Log::info('New image name: ' . $imageName);
            
            // Ensure directory exists
            $uploadPath = public_path('storage/profile_photos');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
                Log::info('Directory created: ' . $uploadPath);
            }
            
            $image->move($uploadPath, $imageName);
            $user->image = $imageName;
            Log::info('Image moved to: ' . $uploadPath . '/' . $imageName);
        }

        Log::info('User before save: ' . json_encode($user->toArray()));
        $user->save();
        Log::info('User saved successfully');
        Log::info('=== PROFILE UPDATE COMPLETED ===');

        return redirect()->route('profile')->with('success', 'Profile berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak benar']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui!');
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6|confirmed',
        ]);

        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        // Set password for first time (for Google OAuth users)
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.settings')->with('success', 'Password berhasil dibuat! Anda sekarang bisa login dengan email dan password.');
    }

    public function updateAcademic(Request $request)
    {
        // Debug log
        Log::info('=== ACADEMIC UPDATE STARTED ===');
        Log::info('User ID: ' . Auth::id());
        Log::info('Request data: ' . json_encode($request->all()));
        
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        $request->validate([
            'study_program' => 'nullable|string|max:255',
            'interest' => 'nullable|string|max:255',
            'field' => 'nullable|string',
        ]);

        // Update academic data
        $user->study_program = $request->study_program;
        $user->interest = $request->interest;
        $user->field = $request->field;

        Log::info('User before save: ' . json_encode($user->toArray()));
        $user->save();
        Log::info('Academic data saved successfully');
        Log::info('=== ACADEMIC UPDATE COMPLETED ===');

        return redirect()->route('profile.academic')->with('success', 'Data akademik berhasil diperbarui!');
    }

    public function alumni()
    {
        return view('profile_alumni');
    }
    public function updateAlumni(Request $request)
    {
        // Debug log
        Log::info('=== ALUMNI UPDATE STARTED ===');
        Log::info('User ID: ' . Auth::id());
        Log::info('Request data: ' . json_encode($request->all()));
        
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        
        if (!$user instanceof User) {
            return redirect()->route('login');
        }

        $request->validate([
            'graduation_year' => 'nullable|integer|min:2000|max:2030',
            'study_program' => 'nullable|string|max:255',
            'current_field' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
        ]);

        // Update alumni data
        $user->graduation_year = $request->graduation_year;
        $user->study_program = $request->study_program;
        $user->current_field = $request->current_field;
        $user->experience = $request->experience;

        Log::info('User before save: ' . json_encode($user->toArray()));
        $user->save();
        Log::info('Alumni data saved successfully');
        Log::info('=== ALUMNI UPDATE COMPLETED ===');

        return redirect()->route('profile.alumni')->with('success', 'Data alumni berhasil diperbarui!');
    }


    /**
     * Delete user account
     */
    public function deleteAccount()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $userId = $user->id;
        $userEmail = $user->email;

        Log::info("=== DELETE ACCOUNT STARTED for user ID: {$userId}, email: {$userEmail} ===");

        DB::beginTransaction();
        try {
            // Delete favorites
            $favCount = DB::table('favorite')->where('user_id', $userId)->count();
            DB::table('favorite')->where('user_id', $userId)->delete();
            Log::info("Deleted {$favCount} favorites");

            // Delete user's comments
            $commentCount = DB::table('comment')->where('user_id', $userId)->count();
            DB::table('comment')->where('user_id', $userId)->delete();
            Log::info("Deleted {$commentCount} user comments");

            // Delete recruitments and their related data
            $recruitmentIds = DB::table('recruitment')->where('user_id', $userId)->pluck('id');
            Log::info("Found " . count($recruitmentIds) . " recruitments to delete");
            
            foreach ($recruitmentIds as $rid) {
                $recComments = DB::table('comment')->where('recruitment_id', $rid)->count();
                DB::table('comment')->where('recruitment_id', $rid)->delete();
                Log::info("Deleted {$recComments} comments for recruitment {$rid}");
                
                $recFavs = DB::table('favorite')->where('recruitment_id', $rid)->count();
                DB::table('favorite')->where('recruitment_id', $rid)->delete();
                Log::info("Deleted {$recFavs} favorites for recruitment {$rid}");
            }
            
            DB::table('recruitment')->where('user_id', $userId)->delete();
            Log::info("Deleted all recruitments");

            // Delete user from database
            DB::table('user')->where('id', $userId)->delete();
            Log::info("User deleted from database");

            DB::commit();
            Log::info("=== DELETE ACCOUNT COMPLETED ===");

            // Logout
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect()->route('welcome')->with('success', 'Akun Anda berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete account: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->route('profile.settings')->with('error', 'Gagal menghapus akun: ' . $e->getMessage());
        }
    }
}
