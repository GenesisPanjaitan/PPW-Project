<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function academic()
    {
        return view('profile_academic');
    }

    public function settings()
    {
        return view('profile_pengaturan');
    }
}
