<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Hitung data untuk cards
        $mahasiswaCount = User::where('role', 'mahasiswa')->count();
        $alumniCount = User::where('role', 'alumni')->count();
        $lowonganCount = DB::table('recruitment')->count();

        // Ambil pendaftaran terbaru (5 user terakhir yang mendaftar)
        $recentRegistrations = User::whereIn('role', ['mahasiswa', 'alumni'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Data untuk notifikasi
        $recentMahasiswa = User::where('role', 'mahasiswa')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        $recentAlumni = User::where('role', 'alumni')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        $recentLowongan = DB::table('recruitment')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        // Hitung total notifikasi baru (1 hari terakhir)
        $newNotifications = User::whereIn('role', ['mahasiswa', 'alumni'])
            ->where('created_at', '>=', now()->subDay())
            ->count() + 
            DB::table('recruitment')
            ->where('created_at', '>=', now()->subDay())
            ->count();

        return view('admin.dashboard', compact(
            'mahasiswaCount',
            'alumniCount', 
            'lowonganCount',
            'recentRegistrations',
            'recentMahasiswa',
            'recentAlumni',
            'recentLowongan',
            'newNotifications'
        ));
    }

    public function mahasiswa()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->get();
        
        // Data untuk notifikasi di layout
        $this->addNotificationData();
        
        return view('admin.mahasiswa', compact('mahasiswa'));
    }
    
    // Method untuk menambahkan data notifikasi ke semua view admin
    private function addNotificationData()
    {
        $userId = auth()->id();
        
        // Get atau create notification read status
        $readStatus = DB::table('notification_reads')
            ->where('user_id', $userId)
            ->first();

        if (!$readStatus) {
            DB::table('notification_reads')->insert([
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $readStatus = (object) [
                'last_read_mahasiswa' => null,
                'last_read_alumni' => null,
                'last_read_lowongan' => null
            ];
        }

        // Log untuk debugging
        \Log::info('Read status for user ' . $userId . ': ' . json_encode($readStatus));

        // Data untuk notifikasi - mahasiswa terbaru
        $recentMahasiswa = User::where('role', 'mahasiswa')
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Data untuk notifikasi - alumni terbaru
        $recentAlumni = User::where('role', 'alumni')
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Data untuk notifikasi - lowongan terbaru
        $recentLowongan = DB::table('recruitment')
            ->join('user', 'recruitment.user_id', '=', 'user.id')
            ->join('category', 'recruitment.category_id', '=', 'category.id')
            ->join('jobtype', 'recruitment.jobtype_id', '=', 'jobtype.id')
            ->select(
                'recruitment.*',
                'user.name as posted_by',
                'category.name as category_name',
                'jobtype.name as jobtype_name'
            )
            ->where('recruitment.created_at', '>=', now()->subDays(7))
            ->orderBy('recruitment.created_at', 'desc')
            ->limit(3)
            ->get();

        // Hitung notifikasi yang belum dibaca (hanya dalam 7 hari terakhir)
        $unreadMahasiswa = 0;
        if ($readStatus->last_read_mahasiswa) {
            $unreadMahasiswa = User::where('role', 'mahasiswa')
                ->where('created_at', '>', $readStatus->last_read_mahasiswa)
                ->where('created_at', '>=', now()->subDays(7))
                ->count();
        } else {
            $unreadMahasiswa = $recentMahasiswa->count();
        }

        $unreadAlumni = 0;
        if ($readStatus->last_read_alumni) {
            $unreadAlumni = User::where('role', 'alumni')
                ->where('created_at', '>', $readStatus->last_read_alumni)
                ->where('created_at', '>=', now()->subDays(7))
                ->count();
        } else {
            $unreadAlumni = $recentAlumni->count();
        }

        $unreadLowongan = 0;
        if ($readStatus->last_read_lowongan) {
            $unreadLowongan = DB::table('recruitment')
                ->where('created_at', '>', $readStatus->last_read_lowongan)
                ->where('created_at', '>=', now()->subDays(7))
                ->count();
        } else {
            $unreadLowongan = $recentLowongan->count();
        }

        $newNotifications = $unreadMahasiswa + $unreadAlumni + $unreadLowongan;

        // Log untuk debugging
        \Log::info('Notification counts - Mahasiswa: ' . $unreadMahasiswa . ', Alumni: ' . $unreadAlumni . ', Lowongan: ' . $unreadLowongan . ', Total: ' . $newNotifications);

        // Share ke semua view
        view()->share([
            'recentMahasiswa' => $recentMahasiswa,
            'recentAlumni' => $recentAlumni,
            'recentLowongan' => $recentLowongan,
            'newNotifications' => $newNotifications
        ]);
    }

    public function alumni()
    {
        $alumni = User::where('role', 'alumni')->get();
        $this->addNotificationData();
        return view('admin.alumni', compact('alumni'));
    }

    public function lowongan()
    {
        $lowongan = DB::table('recruitment')
            ->join('user', 'recruitment.user_id', '=', 'user.id')
            ->join('category', 'recruitment.category_id', '=', 'category.id')
            ->join('jobtype', 'recruitment.jobtype_id', '=', 'jobtype.id')
            ->select(
                'recruitment.*',
                'user.name as posted_by',
                'category.name as category_name',
                'jobtype.name as jobtype_name'
            )
            ->orderBy('recruitment.created_at', 'desc')
            ->get();
            
        $this->addNotificationData();
        return view('admin.lowongan', compact('lowongan'));
    }

    public function lowonganDetail($id)
    {
        $lowongan = DB::table('recruitment')
            ->join('user', 'recruitment.user_id', '=', 'user.id')
            ->join('category', 'recruitment.category_id', '=', 'category.id')
            ->join('jobtype', 'recruitment.jobtype_id', '=', 'jobtype.id')
            ->select(
                'recruitment.*',
                'user.name as posted_by',
                'category.name as category_name',
                'jobtype.name as jobtype_name'
            )
            ->where('recruitment.id', $id)
            ->first();
        
        if (!$lowongan) {
            return redirect()->route('admin.lowongan')->with('error', 'Lowongan tidak ditemukan');
        }

        // Hitung jumlah komentar untuk lowongan ini
        $commentCount = DB::table('comment')->where('recruitment_id', $id)->count();
        
        // Hitung jumlah yang dijadikan favorit
        $favoriteCount = DB::table('favorite')->where('recruitment_id', $id)->count();

        $this->addNotificationData();
        return view('admin.lowongan-detail', compact('lowongan', 'commentCount', 'favoriteCount'));
    }

    public function mahasiswaDetail($id)
    {
        $mahasiswa = User::where('id', $id)->where('role', 'mahasiswa')->first();
        
        if (!$mahasiswa) {
            return redirect()->route('admin.mahasiswa')->with('error', 'Mahasiswa tidak ditemukan');
        }

        $this->addNotificationData();
        return view('admin.mahasiswa-detail', compact('mahasiswa'));
    }

    public function alumniDetail($id)
    {
        $alumni = User::where('id', $id)->where('role', 'alumni')->first();
        
        if (!$alumni) {
            return redirect()->route('admin.alumni')->with('error', 'Alumni tidak ditemukan');
        }

        $this->addNotificationData();
        return view('admin.alumni-detail', compact('alumni'));
    }

    public function lowonganDelete($id)
    {
        $lowongan = DB::table('recruitment')->where('id', $id)->first();
        
        if (!$lowongan) {
            return redirect()->route('admin.lowongan')->with('error', 'Lowongan tidak ditemukan');
        }

        // Hapus lowongan (komentar akan terhapus otomatis karena cascade delete)
        DB::table('recruitment')->where('id', $id)->delete();

        return redirect()->route('admin.lowongan')->with('success', 'Lowongan berhasil dihapus beserta semua komentarnya');
    }

    public function alumniDelete($id)
    {
        $alumni = User::where('id', $id)->where('role', 'alumni')->first();
        
        if (!$alumni) {
            return redirect()->route('admin.alumni')->with('error', 'Alumni tidak ditemukan');
        }

        // Hapus alumni beserta data terkait jika ada
        try {
            // Hapus data recruitment yang diposting oleh alumni ini
            DB::table('recruitment')->where('user_id', $id)->delete();
            
            // Hapus data favorite yang terkait dengan user ini
            DB::table('favorite')->where('user_id', $id)->delete();
            
            // Hapus data comment yang terkait dengan user ini
            DB::table('comment')->where('user_id', $id)->delete();
            
            // Hapus akun alumni
            $alumni->delete();

            return redirect()->route('admin.alumni')->with('success', 'Akun alumni berhasil dihapus dari sistem');
        } catch (\Exception $e) {
            return redirect()->route('admin.alumni')->with('error', 'Gagal menghapus akun alumni: ' . $e->getMessage());
        }
    }

    public function mahasiswaDelete($id)
    {
        $mahasiswa = User::where('id', $id)->where('role', 'mahasiswa')->first();
        
        if (!$mahasiswa) {
            return redirect()->route('admin.mahasiswa')->with('error', 'Mahasiswa tidak ditemukan');
        }

        // Hapus mahasiswa beserta data terkait jika ada
        try {
            // Hapus data favorite yang terkait dengan user ini
            DB::table('favorite')->where('user_id', $id)->delete();
            
            // Hapus data comment yang terkait dengan user ini
            DB::table('comment')->where('user_id', $id)->delete();
            
            // Hapus akun mahasiswa
            $mahasiswa->delete();

            return redirect()->route('admin.mahasiswa')->with('success', 'Akun mahasiswa berhasil dihapus dari sistem');
        } catch (\Exception $e) {
            return redirect()->route('admin.mahasiswa')->with('error', 'Gagal menghapus akun mahasiswa: ' . $e->getMessage());
        }
    }

    public function registrations()
    {
        $mahasiswaCount = User::where('role', 'mahasiswa')->count();
        $alumniCount = User::where('role', 'alumni')->count();
        
        // Ambil 10 pendaftaran terbaru untuk preview
        $recentMahasiswa = User::where('role', 'mahasiswa')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        $recentAlumni = User::where('role', 'alumni')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $this->addNotificationData();
        return view('admin.registrations', compact(
            'mahasiswaCount',
            'alumniCount',
            'recentMahasiswa',
            'recentAlumni'
        ));
    }

    public function profile()
    {
        $admin = auth()->user();
        $this->addNotificationData();
        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        try {
            $admin = auth()->user();
            
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:user,email,' . $admin->id,
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'current_password' => 'nullable|string',
                'new_password' => 'nullable|string|min:6|confirmed',
            ]);

            // Update nama dan email
            $admin->name = $request->name;
            $admin->email = $request->email;
            
            // Handle profile photo upload
            if ($request->hasFile('profile_photo')) {
                // Delete old photo if exists
                if ($admin->image && file_exists(public_path('storage/profile_photos/' . $admin->image))) {
                    unlink(public_path('storage/profile_photos/' . $admin->image));
                }
                
                // Upload new photo
                $photo = $request->file('profile_photo');
                $photoName = time() . '_' . $admin->id . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('storage/profile_photos'), $photoName);
                $admin->image = $photoName;
            }
            
            // Update password jika ada
            if ($request->filled('new_password')) {
                if (!$request->filled('current_password')) {
                    return back()->withErrors(['current_password' => 'Password saat ini harus diisi untuk mengubah password']);
                }
                
                if (!password_verify($request->current_password, $admin->password)) {
                    return back()->withErrors(['current_password' => 'Password saat ini tidak benar']);
                }
                
                $admin->password = Hash::make($request->new_password);
            }
            
            // Simpan perubahan ke database
            $saved = $admin->save();
            
            if ($saved) {
                return back()->with('success', 'Profil berhasil diperbarui dan disimpan ke database!');
            } else {
                return back()->withErrors(['general' => 'Gagal menyimpan perubahan ke database']);
            }
            
        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function settings()
    {
        $this->addNotificationData();
        return view('admin.profile');
    }

    public function markNotificationsRead()
    {
        $userId = auth()->id();
        
        // Log untuk debugging
        \Log::info('Marking notifications as read for user: ' . $userId);
        
        $result = DB::table('notification_reads')
            ->updateOrInsert(
                ['user_id' => $userId],
                [
                    'last_read_mahasiswa' => now(),
                    'last_read_alumni' => now(),
                    'last_read_lowongan' => now(),
                    'updated_at' => now()
                ]
            );

        \Log::info('Update result: ' . ($result ? 'success' : 'failed'));

        return response()->json(['success' => true, 'user_id' => $userId, 'timestamp' => now()]);
    }
}