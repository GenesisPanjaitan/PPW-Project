<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Hitung data untuk cards
        $mahasiswaCount = User::where('role', 'mahasiswa')->count();
        $alumniCount = User::where('role', 'alumni')->count();
        $lowonganCount = DB::table('recruitment')->count();

        return view('admin.dashboard', compact(
            'mahasiswaCount',
            'alumniCount', 
            'lowonganCount'
        ));
    }

    public function mahasiswa()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->get();
        return view('admin.mahasiswa', compact('mahasiswa'));
    }

    public function alumni()
    {
        $alumni = User::where('role', 'alumni')->get();
        return view('admin.alumni', compact('alumni'));
    }

    public function lowongan()
    {
        $lowongan = DB::table('recruitment')->get();
        return view('admin.lowongan', compact('lowongan'));
    }

    public function lowonganDetail($id)
    {
        $lowongan = DB::table('recruitment')->where('id', $id)->first();
        
        if (!$lowongan) {
            return redirect()->route('admin.lowongan')->with('error', 'Lowongan tidak ditemukan');
        }

        return view('admin.lowongan-detail', compact('lowongan'));
    }

    public function mahasiswaDetail($id)
    {
        $mahasiswa = User::where('id', $id)->where('role', 'mahasiswa')->first();
        
        if (!$mahasiswa) {
            return redirect()->route('admin.mahasiswa')->with('error', 'Mahasiswa tidak ditemukan');
        }

        return view('admin.mahasiswa-detail', compact('mahasiswa'));
    }

    public function alumniDetail($id)
    {
        $alumni = User::where('id', $id)->where('role', 'alumni')->first();
        
        if (!$alumni) {
            return redirect()->route('admin.alumni')->with('error', 'Alumni tidak ditemukan');
        }

        return view('admin.alumni-detail', compact('alumni'));
    }
}