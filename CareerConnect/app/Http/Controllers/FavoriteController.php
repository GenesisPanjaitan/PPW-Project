<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function index()
    {
        // fetch favorites for current user and join recruitment data
        $userId = Auth::id();
        $favorites = DB::table('favorite as f')
            ->join('recruitment as r', 'f.recruitment_id', '=', 'r.id')
            ->leftJoin('user as u', 'r.user_id', '=', 'u.id')
            ->leftJoin('jobtype as j', 'r.jobtype_id', '=', 'j.id')
            ->select('r.*', 'u.name as author', 'j.name as jobtype', 'f.id as favorite_id')
            ->where('f.user_id', $userId)
            ->orderByDesc('r.date')
            ->get();

        return view('favorit', ['favorites' => $favorites]);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $recruitmentId = $request->route('id');
        if (! $userId || ! $recruitmentId) return back();

        // prevent duplicate
        $exists = DB::table('favorite')->where('user_id', $userId)->where('recruitment_id', $recruitmentId)->first();
        if (! $exists) {
            DB::table('favorite')->insert([
                'user_id' => $userId,
                'recruitment_id' => $recruitmentId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // If AJAX request, return JSON for client-side toggle
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'ok', 'action' => 'stored', 'recruitment_id' => $recruitmentId]);
        }

        return back();
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        $recruitmentId = $id;
        if (! $userId || ! $recruitmentId) return back();

        DB::table('favorite')->where('user_id', $userId)->where('recruitment_id', $recruitmentId)->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['status' => 'ok', 'action' => 'deleted', 'recruitment_id' => $recruitmentId]);
        }

        return back();
    }
}
