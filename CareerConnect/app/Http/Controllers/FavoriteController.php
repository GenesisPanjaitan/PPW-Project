<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        return view('favorit');
    }

    public function store(Request $request)
    {
        // Placeholder: implement favorite store logic
        return back();
    }

    public function destroy($id)
    {
        // Placeholder: implement favorite delete logic
        return back();
    }
}
