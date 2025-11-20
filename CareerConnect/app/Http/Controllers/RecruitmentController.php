<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RecruitmentController extends Controller
{
    public function index()
    {
        // fetch all recruitments with related category, jobtype, and author
        $recruitments = DB::table('recruitment as r')
            ->leftJoin('category as c', 'r.category_id', '=', 'c.id')
            ->leftJoin('jobtype as j', 'r.jobtype_id', '=', 'j.id')
            ->leftJoin('user as u', 'r.user_id', '=', 'u.id')
            ->select('r.*', 'c.name as category', 'j.name as jobtype', 'u.name as author')
            ->orderByDesc('r.date')
            ->get();

        return view('recruitment', ['recruitments' => $recruitments]);
    }

    public function detail()
    {
        return view('recruitment_detail');
    }

    /**
     * Show a recruitment detail page by id
     */
    public function detailById($id)
    {
        $r = DB::table('recruitment as r')
            ->leftJoin('category as c', 'r.category_id', '=', 'c.id')
            ->leftJoin('jobtype as j', 'r.jobtype_id', '=', 'j.id')
            ->leftJoin('user as u', 'r.user_id', '=', 'u.id')
            ->select('r.*', 'c.name as category', 'j.name as jobtype', 'u.name as author')
            ->where('r.id', $id)
            ->first();

        if (!$r) {
            abort(404);
        }

        // fetch comments
        $comments = DB::table('comment as c')
            ->leftJoin('user as u', 'c.user_id', '=', 'u.id')
            ->select('c.*', 'u.name as author')
            ->where('c.recruitment_id', $id)
            ->orderBy('c.created_at', 'asc')
            ->get();

        return view('recruitment_detail', ['r' => $r, 'comments' => $comments]);
    }

    /**
     * Store a comment for a recruitment
     */
    public function storeComment(Request $request, $id)
    {
        $request->validate(['comment' => 'required|string']);

        DB::table('comment')->insert([
            'recruitment_id' => $id,
            'user_id' => Auth::id() ?? 1,
            'content' => $request->comment,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('recruitment.detail', ['id' => $id])->with('success', 'Komentar berhasil ditambahkan.');
    }

    /**
     * Store a new recruitment posting
     */
    public function store(Request $request)
    {
        // only alumni or admin are allowed to post
        if (!Auth::check() || (Auth::user()->role !== 'alumni' && Auth::user()->role !== 'admin')) {
            return redirect()->route('recruitment')->with('error', 'Hanya akun alumni atau admin yang dapat memposting lowongan.');
        }

        $request->validate([
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|string|max:1024',
            'kategori' => 'nullable|string|max:255',
            'tipe' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|max:2048',
        ]);

        // resolve or create category (fallback to 'Umum' if none)
        $categoryId = null;
        if ($request->filled('kategori')) {
            $category = DB::table('category')->where('name', $request->kategori)->first();
            if (!$category) {
                $categoryId = DB::table('category')->insertGetId(['name' => $request->kategori, 'created_at' => now(), 'updated_at' => now()]);
            } else {
                $categoryId = $category->id;
            }
        } else {
            $defaultCategory = DB::table('category')->where('name', 'Umum')->first();
            if (!$defaultCategory) {
                $categoryId = DB::table('category')->insertGetId(['name' => 'Umum', 'created_at' => now(), 'updated_at' => now()]);
            } else {
                $categoryId = $defaultCategory->id;
            }
        }

        // resolve or create jobtype (fallback to 'General' if none)
        $jobtypeId = null;
        if ($request->filled('tipe')) {
            $jobtype = DB::table('jobtype')->where('name', $request->tipe)->first();
            if (!$jobtype) {
                $jobtypeId = DB::table('jobtype')->insertGetId(['name' => $request->tipe, 'created_at' => now(), 'updated_at' => now()]);
            } else {
                $jobtypeId = $jobtype->id;
            }
        } else {
            $defaultJobtype = DB::table('jobtype')->where('name', 'General')->first();
            if (!$defaultJobtype) {
                $jobtypeId = DB::table('jobtype')->insertGetId(['name' => 'General', 'created_at' => now(), 'updated_at' => now()]);
            } else {
                $jobtypeId = $defaultJobtype->id;
            }
        }

        // handle image upload if provided
        $imagePath = '';
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('recruitment', 'public');
        }

        // insert recruitment
        DB::table('recruitment')->insert([
            'position' => $request->position,
            'company_name' => $request->company,
            'description' => $request->deskripsi ?? '',
            'location' => $request->lokasi ?? '',
            'link' => $request->link ?? '',
            'image' => $imagePath,
            'date' => now(),
            'user_id' => Auth::id(),
            'category_id' => $categoryId ?? 0,
            'jobtype_id' => $jobtypeId ?? 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('recruitment')->with('success', 'Posting lowongan berhasil dibuat.');
    }
}
