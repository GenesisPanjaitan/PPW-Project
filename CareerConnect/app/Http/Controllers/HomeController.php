<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function index()
    {
        // fetch latest 3 recruitments for the home page
        $latestRecruitments = DB::table('recruitment as r')
            ->leftJoin('jobtype as j', 'r.jobtype_id', '=', 'j.id')
            ->leftJoin('user as u', 'r.user_id', '=', 'u.id')
            ->select('r.*', 'j.name as jobtype', 'u.name as author')
            // only include postings with date not in the future and ensure date exists
            ->whereNotNull('r.date')
            ->where('r.date', '<=', now())
            ->orderByDesc('r.date')
            ->limit(3)
            ->get();

        return view('home', ['latestRecruitments' => $latestRecruitments]);
    }
}
