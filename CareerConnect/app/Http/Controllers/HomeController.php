<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        // gather favorite ids for the authenticated user
        
        // If user is authenticated, collect their favorite recruitment ids to toggle bookmark UI

        $favoriteIds = [];
        $userId = auth()->id();

        if ($userId) {
            $favoriteIds = DB::table('favorite')
                ->where('user_id', $userId)
                ->pluck('recruitment_id')
                ->toArray();
        }

        // Tampilkan view berbeda berdasarkan role
        // Tampilkan view yang sama untuk mahasiswa dan alumni
        return view('home-mahasiswa', [
            'latestRecruitments' => $latestRecruitments, 
            'favoriteIds' => $favoriteIds
        ]);
    }


}
