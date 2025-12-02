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
        // fetch latest 6 recruitments for the home page
        $latestRecruitments = DB::table('recruitment as r')
            ->leftJoin('jobtype as j', 'r.jobtype_id', '=', 'j.id')
            ->leftJoin('user as u', 'r.user_id', '=', 'u.id')
            ->select('r.*', 'j.name as jobtype', 'u.name as author')
            ->whereNotNull('r.date')
            ->where('r.date', '<=', now())
            ->orderByDesc('r.date')
            ->limit(6)
            ->get();

        return view('home', [
            'latestRecruitments' => $latestRecruitments
        ]);
    }


}
