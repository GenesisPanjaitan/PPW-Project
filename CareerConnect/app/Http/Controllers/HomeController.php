<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function index()
    {
        $user = Auth::user();
        
        // fetch latest 3 recruitments for the home page
        $latestRecruitments = DB::table('recruitment as r')
            ->leftJoin('jobtype as j', 'r.jobtype_id', '=', 'j.id')
            ->leftJoin('user as u', 'r.user_id', '=', 'u.id')
            ->select('r.*', 'j.name as jobtype', 'u.name as author')
            ->whereNotNull('r.date')
            ->where('r.date', '<=', now())
            ->orderByDesc('r.date')
            ->limit(3)
            ->get();
        
        // If user is authenticated, collect their favorite recruitment ids to toggle bookmark UI
        $favoriteIds = [];
        if (Auth::check()) {
            $favRows = DB::table('favorite')->where('user_id', Auth::id())->pluck('recruitment_id')->toArray();
            $favoriteIds = $favRows ?: [];
        }

        // Tampilkan view berbeda berdasarkan role
        if ($user->role === 'alumni') {
            // Data tambahan untuk alumni
            $myPostings = DB::table('recruitment')->where('user_id', $user->id)->get();
            return view('home-alumni', [
                'latestRecruitments' => $latestRecruitments, 
                'favoriteIds' => $favoriteIds,
                'myPostings' => $myPostings
            ]);
        } else {
            // View default untuk mahasiswa
            return view('home-mahasiswa', [
                'latestRecruitments' => $latestRecruitments, 
                'favoriteIds' => $favoriteIds
            ]);
        }
    }


}
