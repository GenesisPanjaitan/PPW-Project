<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Mail\NewJobPostedMail;
use App\Models\User;

class RecruitmentController extends Controller
{
    public function index(Request $request)
    {
        // Start building the query
        $query = DB::table('recruitment as r')
            ->leftJoin('category as c', 'r.category_id', '=', 'c.id')
            ->leftJoin('jobtype as j', 'r.jobtype_id', '=', 'j.id')
            ->leftJoin('user as u', 'r.user_id', '=', 'u.id')
            ->select('r.*', 'c.name as category', 'j.name as jobtype', 'u.name as author');

        // Apply search filters if provided
        if ($request->filled('q')) {
            $searchTerm = $request->get('q');
            $query->where(function($q) use ($searchTerm) {
                $q->where('r.position', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('r.company_name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('r.location', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('r.description', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        // Filter by job type
        if ($request->filled('type')) {
            $query->where('j.name', $request->get('type'));
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('c.name', $request->get('category'));
        }

        // Get the results
        $recruitments = $query->orderByDesc('r.date')->get();

        // Fetch favorite ids for the authenticated user
        $favoriteIds = [];
        if (Auth::check()) {
            $favoriteIds = DB::table('favorite')->where('user_id', Auth::id())->pluck('recruitment_id')->toArray();
        }

        return view('recruitment', [
            'recruitments' => $recruitments, 
            'favoriteIds' => $favoriteIds,
            'searchQuery' => $request->get('q'),
            'selectedType' => $request->get('type'),
            'selectedCategory' => $request->get('category')
        ]);
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

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        DB::table('comment')->insert([
            'recruitment_id' => $id,
            'user_id' => Auth::id(),
            'content' => $request->comment,
            'date' => now(),
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
        $recruitmentId = DB::table('recruitment')->insertGetId([
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

        // Fetch the newly created recruitment with related data for email
        $recruitment = DB::table('recruitment as r')
            ->leftJoin('category as c', 'r.category_id', '=', 'c.id')
            ->leftJoin('jobtype as j', 'r.jobtype_id', '=', 'j.id')
            ->select('r.*', 'c.name as category', 'j.name as jobtype')
            ->where('r.id', $recruitmentId)
            ->first();

        // Send email notification to mahasiswa users (only Google login users with verified emails)
        try {
            // Get only mahasiswa who logged in via Google (verified email addresses)
            $students = User::where('role', 'mahasiswa')
                ->where('login_method', 'google')
                ->get();
            
            if ($students->isNotEmpty()) {
                Mail::to($students)->send(new NewJobPostedMail($recruitment));
                Log::info('Email notifications sent to ' . $students->count() . ' Google-verified students for job posting: ' . $recruitmentId);
            } else {
                Log::info('No Google-verified students found to send email notifications for job posting: ' . $recruitmentId);
            }
        } catch (\Exception $e) {
            // Log error but don't block the recruitment posting
            Log::error('Failed to send email notifications: ' . $e->getMessage());
        }

        return redirect()->route('recruitment')->with('success', 'Posting lowongan berhasil dibuat dan notifikasi telah dikirim ke mahasiswa.');
    }

    /**
     * Show edit form for a recruitment
     */
    public function edit($id)
    {
        $r = DB::table('recruitment')->where('id', $id)->first();
        if (! $r) abort(404);

        // authorization: admin can edit any, alumni can edit own, mahasiswa cannot
        if (!Auth::check()) return redirect()->route('login');
        $user = Auth::user();
        if ($user->role === 'mahasiswa') {
            return redirect()->route('recruitment')->with('error', 'Aksi tidak diizinkan.');
        }
        if ($user->role !== 'admin' && $r->user_id !== $user->id) {
            return redirect()->route('recruitment')->with('error', 'Anda hanya dapat mengedit postingan Anda sendiri.');
        }

        // load categories and jobtypes for select
        $categories = DB::table('category')->get();
        $jobtypes = DB::table('jobtype')->get();

        return view('recruitment_edit', ['r' => $r, 'categories' => $categories, 'jobtypes' => $jobtypes]);
    }

    /**
     * Update recruitment
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $r = DB::table('recruitment')->where('id', $id)->first();
        if (! $r) abort(404);

        if (!Auth::check()) return redirect()->route('login');
        $user = Auth::user();
        if ($user->role === 'mahasiswa') {
            return redirect()->route('recruitment')->with('error', 'Aksi tidak diizinkan.');
        }
        if ($user->role !== 'admin' && $r->user_id !== $user->id) {
            return redirect()->route('recruitment')->with('error', 'Anda hanya dapat mengedit postingan Anda sendiri.');
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

        // resolve category/jobtype similar to store
        $categoryId = $r->category_id;
        if ($request->filled('kategori')) {
            $category = DB::table('category')->where('name', $request->kategori)->first();
            if (!$category) {
                $categoryId = DB::table('category')->insertGetId(['name' => $request->kategori, 'created_at' => now(), 'updated_at' => now()]);
            } else {
                $categoryId = $category->id;
            }
        }

        $jobtypeId = $r->jobtype_id;
        if ($request->filled('tipe')) {
            $jobtype = DB::table('jobtype')->where('name', $request->tipe)->first();
            if (!$jobtype) {
                $jobtypeId = DB::table('jobtype')->insertGetId(['name' => $request->tipe, 'created_at' => now(), 'updated_at' => now()]);
            } else {
                $jobtypeId = $jobtype->id;
            }
        }

        $imagePath = $r->image;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('recruitment', 'public');
        }

        DB::table('recruitment')->where('id', $id)->update([
            'position' => $request->position,
            'company_name' => $request->company,
            'description' => $request->deskripsi ?? '',
            'location' => $request->lokasi ?? '',
            'link' => $request->link ?? '',
            'image' => $imagePath,
            'category_id' => $categoryId ?? 0,
            'jobtype_id' => $jobtypeId ?? 0,
            'updated_at' => now(),
        ]);

        return redirect()->route('recruitment')->with('success', 'Posting lowongan berhasil diperbarui.');
    }

    /**
     * Delete recruitment
     */
    public function destroy($id): RedirectResponse
    {
        $r = DB::table('recruitment')->where('id', $id)->first();
        if (! $r) abort(404);

        if (!Auth::check()) return redirect()->route('login');
        $user = Auth::user();
        if ($user->role === 'mahasiswa') {
            return redirect()->route('recruitment')->with('error', 'Aksi tidak diizinkan.');
        }
        if ($user->role !== 'admin' && $r->user_id !== $user->id) {
            return redirect()->route('recruitment')->with('error', 'Anda hanya dapat menghapus postingan Anda sendiri.');
        }

        DB::table('recruitment')->where('id', $id)->delete();

        return redirect()->route('recruitment')->with('success', 'Posting lowongan berhasil dihapus.');
    }

    public function myPosts()
    {
        // Get all posts by the authenticated user (alumni)
        $userPosts = DB::table('recruitment as r')
            ->leftJoin('category as c', 'r.category_id', '=', 'c.id')
            ->leftJoin('jobtype as j', 'r.jobtype_id', '=', 'j.id')
            ->leftJoin('user as u', 'r.user_id', '=', 'u.id')
            ->select('r.*', 'c.name as category', 'j.name as jobtype', 'u.name as author')
            ->where('r.user_id', Auth::id())
            ->orderByDesc('r.date')
            ->get();

        return view('recruitment_my_posts', compact('userPosts'));
    }
}
