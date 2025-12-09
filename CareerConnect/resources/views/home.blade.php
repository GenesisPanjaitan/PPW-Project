@extends('layouts.app')

@section('content')


<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">
            
            <!-- Logo -->
            <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">
                <img src="{{ asset('images/logokita.png') }}" 
                     alt="CareerConnect Logo" 
                     style="height: 30px;" 
                     class="ms-2"> CareerConnect
            </a>

            <!-- Tombol Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navDashboard" aria-controls="navDashboard" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navDashboard">
                
                <!-- Menu Tengah -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3">
                        <a class="nav-link {{ Request::is('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link {{ Request::is('recruitment*') ? 'active fw-semibold' : '' }}" href="/recruitment">Recruitment</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link {{ Request::is('profile*') ? 'active fw-semibold' : '' }}" href="/profile">My Profile</a>
                    </li>
                </ul>
                
                <!-- Menu Kanan (Dropdown Profil) -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <!-- Tombol Pemicu Dropdown -->
                        <a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(auth()->user() && auth()->user()->image && file_exists(public_path('storage/profile_photos/' . auth()->user()->image)))
                                <img src="{{ asset('storage/profile_photos/' . auth()->user()->image) }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;">
                            @else
                                <i class="bi bi-person-circle me-1"></i>
                            @endif
                            {{ optional(auth()->user())->name ?? 'Kevin Gultom' }}
                        </a>
                        
                        <!-- Isi Dropdown -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('favorit') }}">
                                    <i class="bi bi-bookmark-fill me-2"></i> Favorit Anda
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <!-- Link Logout -->
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Keluar Akun
                                </a>
                                <!-- Form Logout (Tersembunyi) -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

<main class="pb-5">
    
    {{-- Hero Section --}}
    <div class="hero-wrapper bg-light"> {{-- Wrapper untuk padding dan background di luar hero --}}
        <div class="container"> {{-- Membatasi lebar hero section --}}
            <div class="hero-section">
                {{-- Background Slides --}}
                <div class="hero-bg active" style="background-image: url('{{ asset('images/gambar1.jpg') }}');"></div>
                
                <div class="hero-bg " style="background-image: url('{{ asset('images/gambar2.jpg') }}');"></div>
                
                <div class="hero-bg" style="background-image: url('{{ asset('images/gambar3.jpg') }}');"></div>

                {{-- Overlay Card dengan Teks --}}
                <div class="hero-card-overlay">
                    <h1 class="display-5 fw-bold mb-3">
                        Selamat Datang di <br> <span class="text-highlight">CareerConnect.</span>
                    </h1>
                    <p class="lead text-light opacity-75 mb-4 fs-6">
                        Temukan dunia peluang karir melalui ribuan lowongan di bidang teknologi, bisnis, hingga kreatif. Mulai perjalanan profesionalmu sekarang!
                    </p>
                   <a href="{{ url('/recruitment') }}" class="btn btn-primary btn-sm rounded-pill px-4 fw-bold">
                        Jelajahi Lowongan
                    </a>
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-4" id="lowongan-section">

        @if (session('login_success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('login_success') }}
                <button type="type" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Halo, {{ optional(auth()->user())->name ?? 'Pencari Kerja' }} 👋</h2>
            <p class="text-muted lead">Siap untuk menemukan peluang karir terbaik hari ini?</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-8"
            
            >
                <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-1">Lowongan Terbaru</h5>
                        <p class="text-muted small mb-3">Temukan Kesempatan Baru Hari Ini</p>

                        @if(!empty($latestRecruitments) && $latestRecruitments->count())
                            @foreach($latestRecruitments as $r)
                                <a href="{{ route('recruitment.detail', $r->id) }}" class="text-decoration-none">
                                    <div class="card job-card mb-3 border-0 bg-light hover-shadow" style="cursor: pointer;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="d-flex">
                                                    <div class="me-3 d-flex align-items-center justify-content-center bg-white rounded shadow-sm" style="width:50px; height:50px;">
                                                       <i class="bi bi-building fs-4 text-danger"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold mb-0 text-dark">{{ $r->position }}</h6>
                                                        <p class="small mb-1 text-dark">{{ $r->company_name }}</p>
                                                        <p class="small text-muted mb-0">
                                                            <i class="bi bi-geo-alt me-1"></i> {{ $r->location }} 
                                                            <i class="bi bi-clock ms-2 me-1"></i> {{ \Carbon\Carbon::parse($r->date)->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-start">
                                                    <div class="me-3">
                                                        <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3">{{ $r->jobtype ?? 'Full-time' }}</span>
                                                    </div>
                                                    <div>
                                                        @auth
                                                            @php
                                                                $isFav = in_array((int)$r->id, array_map('intval', $favoriteIds ?? []));
                                                            @endphp
                                                            @if($isFav)
                                                                <form action="{{ route('favorite.destroy', ['id'=>$r->id]) }}" method="POST" class="d-inline favorite-form" onsubmit="event.stopPropagation();">
                                                                    @csrf @method('DELETE')
                                                                    <button class="btn btn-sm btn-primary rounded-circle" title="Hapus Favorit">
                                                                        <i class="bi bi-bookmark-fill text-white"></i>
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <form action="{{ route('favorite.store', ['id'=>$r->id]) }}" method="POST" class="d-inline favorite-form" onsubmit="event.stopPropagation();">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-outline-secondary rounded-circle" title="Simpan Favorit">
                                                                        <i class="bi bi-bookmark"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @else
                                                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary rounded-circle" title="Login untuk menyimpan" onclick="event.stopPropagation();"><i class="bi bi-bookmark"></i></a>
                                                        @endauth
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="alert alert-info">Belum ada lowongan terbaru.</div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card profile-card border-0 shadow-sm" style="border-radius: 1rem;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 text-dark">Profil Singkat</h5>

                        <div class="mb-3">
                            <label class="small text-muted d-block">Jurusan</label>
                            <span class="fw-semibold text-dark">
                                @if(auth()->user()->study_program)
                                    @switch(auth()->user()->study_program)
                                        @case('if') S1-Informatika @break
                                        @case('si') S1-Sistem Informasi @break
                                        @case('te') S1-Teknik Elektro @break
                                        @case('mr') S1-Manajemen Rekayasa @break
                                        @case('tm') S1-Teknik Metalurgi @break
                                        @case('bp') S1-Teknik Bioproses @break
                                        @case('bt') S1-Bioteknologi @break
                                        @case('trpl') D4-Teknologi Rekayasa Perangkat Lunak @break
                                        @case('ti') D3-Teknologi Informasi @break
                                        @case('nm') D3-Teknologi Komputer @break
                                        @default {{ auth()->user()->study_program }}
                                    @endswitch
                                @else
                                    <span class="text-muted">Belum diatur</span>
                                @endif
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted d-block">Minat Karir</label>
                            <span class="fw-semibold text-dark">
                                @if(auth()->user()->interest)
                                    @switch(auth()->user()->interest)
                                        @case('swe') Software Engineering @break
                                        @case('uiux') UI/UX Design @break
                                        @case('data') Data Science @break
                                        @case('product') Product Management @break
                                        @case('digital_marketing') Digital Marketing @break
                                        @case('qa_testing') QA & Testing @break
                                        @case('cybersecurity') Cybersecurity @break
                                        @case('operations') Operations @break
                                        @case('lainnya') Lainnya @break
                                        @default {{ auth()->user()->interest }}
                                    @endswitch
                                @else
                                    <span class="text-muted">Belum diatur</span>
                                @endif
                            </span>
                        </div>

                        <div class="mb-4">
                            <label class="small text-muted d-block mb-1">Skills</label>
                            <div>
                                @if(auth()->user()->field)
                                    @foreach(explode(',', auth()->user()->field) as $skill)
                                        <span class="badge bg-secondary bg-opacity-10 text-dark me-1 mb-1">{{ trim($skill) }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">Belum ada skills yang diatur</span>
                                @endif
                            </div>
                        </div>

                        <hr class="my-3">
                        
                        <a href="{{ url('/profile?mode=edit') }}" class="btn btn-outline-primary w-100 rounded-pill">
                            <i class="bi bi-pencil-square me-1"></i> Edit Profil
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>



</main>

{{-- Section Statistik Real-time --}}
<section class="container my-5">
    <div class="card shadow-sm border-0" style="border-radius: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="card-body p-4">
            <div class="row text-center text-white">
                <div class="col-6 col-md-3 mb-3 mb-md-0">
                    <div class="stat-item">
                        <i class="bi bi-briefcase-fill fs-2 mb-2 d-block"></i>
                        <h3 class="fw-bold mb-1">{{ DB::table('recruitment')->count() }}+</h3>
                        <small class="opacity-75">Lowongan Aktif</small>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3 mb-md-0">
                    <div class="stat-item">
                        <i class="bi bi-building fs-2 mb-2 d-block"></i>
                        <h3 class="fw-bold mb-1">{{ DB::table('recruitment')->distinct('company_name')->count() }}+</h3>
                        <small class="opacity-75">Perusahaan Partner</small>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <i class="bi bi-people-fill fs-2 mb-2 d-block"></i>
                        <h3 class="fw-bold mb-1">{{ DB::table('user')->whereIn('role', ['mahasiswa', 'alumni'])->count() }}+</h3>
                        <small class="opacity-75">Pengguna Aktif</small>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <i class="bi bi-star-fill fs-2 mb-2 d-block"></i>
                        <h3 class="fw-bold mb-1">{{ DB::table('favorite')->count() }}+</h3>
                        <small class="opacity-75">Lowongan Tersimpan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section Trending & Quick Filter --}}
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-fire text-danger me-2"></i>Trending Saat Ini
        </h4>
        <a href="{{ route('recruitment') }}" class="text-decoration-none small fw-semibold text-primary">Lihat Semua</a>
    </div>
    
    {{-- Quick Filter Buttons --}}
    <div class="mb-4 d-flex gap-2 flex-wrap">
        <a href="{{ route('recruitment') }}" class="btn btn-sm btn-outline-primary rounded-pill">
            <i class="bi bi-laptop me-1"></i>Remote
        </a>
        <a href="{{ route('recruitment') }}" class="btn btn-sm btn-outline-success rounded-pill">
            <i class="bi bi-building me-1"></i>On-site
        </a>
        <a href="{{ route('recruitment') }}" class="btn btn-sm btn-outline-warning rounded-pill">
            <i class="bi bi-shuffle me-1"></i>Hybrid
        </a>
        <a href="{{ route('recruitment') }}" class="btn btn-sm btn-outline-info rounded-pill">
            <i class="bi bi-code-slash me-1"></i>IT & Software
        </a>
        <a href="{{ route('recruitment') }}" class="btn btn-sm btn-outline-danger rounded-pill">
            <i class="bi bi-palette me-1"></i>Design
        </a>
        <a href="{{ route('recruitment') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
            <i class="bi bi-megaphone me-1"></i>Marketing
        </a>
    </div>

    {{-- Trending Jobs Cards --}}
    <div class="row g-3">
        @php
            $trendingJobs = DB::table('recruitment as r')
                ->leftJoin('jobtype as j', 'r.jobtype_id', '=', 'j.id')
                ->select('r.*', 'j.name as jobtype', 
                    DB::raw('(SELECT COUNT(*) FROM favorite WHERE recruitment_id = r.id) as favorite_count'))
                ->orderByDesc('favorite_count')
                ->limit(6)
                ->get();
        @endphp
        
        @foreach($trendingJobs as $job)
        <div class="col-md-4">
            <a href="{{ route('recruitment.detail', $job->id) }}" class="text-decoration-none">
                <div class="card trending-card h-100 border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                <i class="bi bi-fire me-1"></i>Trending
                            </span>
                            <small class="text-muted">
                                <i class="bi bi-bookmark-fill text-warning"></i> {{ $job->favorite_count }}
                            </small>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">{{ Str::limit($job->position, 30) }}</h6>
                        <p class="small text-muted mb-2">{{ Str::limit($job->company_name, 25) }}</p>
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-geo-alt me-1"></i>{{ Str::limit($job->location, 15) }}
                            </span>
                            @if($job->jobtype)
                            <span class="badge bg-success bg-opacity-10 text-success">{{ $job->jobtype }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</section>

{{-- Section Fitur Unggulan --}}
<section class="container my-5">
    <div class="text-center mb-4">
        <h4 class="fw-bold">Fitur Unggulan CareerConnect</h4>
        <p class="text-muted">Manfaatkan semua fitur yang tersedia untuk kesuksesan karirmu</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm feature-card border-0">
                <div class="card-body text-center p-4">
                    <div class="icon-circle-large bg-primary bg-opacity-10 text-primary mx-auto mb-3">
                        <i class="bi bi-briefcase-fill fs-3"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Lowongan Kerja & Magang</h6>
                    <p class="small text-muted mb-3">Temukan ribuan lowongan pekerjaan dan magang dari berbagai perusahaan terkemuka.</p>
                    <a href="{{ route('recruitment') }}" class="btn btn-outline-primary btn-sm rounded-pill">Jelajahi Lowongan</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm feature-card border-0">
                <div class="card-body text-center p-4">
                    <div class="icon-circle-large bg-success bg-opacity-10 text-success mx-auto mb-3">
                        <i class="bi bi-bookmark-fill fs-3"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Simpan Favorit</h6>
                    <p class="small text-muted mb-3">Tandai lowongan favorit untuk dilamar nanti dan kelola daftar lamaran kamu.</p>
                    <a href="{{ route('favorit') }}" class="btn btn-outline-success btn-sm rounded-pill">Lihat Favorit</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm feature-card border-0">
                <div class="card-body text-center p-4">
                    <div class="icon-circle-large bg-warning bg-opacity-10 text-warning mx-auto mb-3">
                        <i class="bi bi-person-circle fs-3"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Profil Profesional</h6>
                    <p class="small text-muted mb-3">Buat dan kelola profil profesionalmu untuk meningkatkan peluang dilirik recruiter.</p>
                    <a href="{{ route('profile') }}" class="btn btn-outline-warning btn-sm rounded-pill">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</section>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.hero-bg');
        const intervalTime = 3000; // 3 Detik
        let currentSlide = 0;

        if(slides.length > 0) {
            slides[0].classList.add('active');
        }

        setInterval(() => {
            if(slides.length === 0) return;
            
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, intervalTime);
    });


</script>

<style>
    /* Hero Section */
    .hero-wrapper {
        padding: 1.5rem 0;
        background: #f8f9fa;
    }
    
    .hero-section {
        position: relative;
        min-height: 450px;
        border-radius: 1.5rem;
        overflow: hidden;
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transition: opacity 0.8s ease;
    }
    .hero-bg.active { 
        opacity: 0.3;
    }

    .hero-card-overlay {
        position: relative;
        z-index: 10;
        max-width: 700px;
        width: 100%;
        color: #fff;
        text-align: center;
    }
    .hero-card-overlay h1 { 
        font-size: 2.8rem;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        font-weight: 700;
    }
    .hero-card-overlay p {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 2rem;
        opacity: 0.95;
        color: #e8eef5;
    }

    .text-highlight {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    /* Cards & hover effects */
    .hover-shadow { transition: transform 0.25s ease, box-shadow 0.25s ease; }
    .job-card:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }
    .trending-card, .feature-card { transition: transform 0.25s ease, box-shadow 0.25s ease; }
    .trending-card { border-radius: 1rem; cursor: pointer; }
    .trending-card:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.15) !important; }
    .feature-card { border-radius: 1rem; }
    .feature-card:hover { transform: translateY(-8px); box-shadow: 0 12px 30px rgba(0,0,0,0.15) !important; }
    .icon-circle-large {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-outline-primary:hover, .btn-outline-success:hover, 
    .btn-outline-warning:hover, .btn-outline-info:hover,
    .btn-outline-danger:hover, .btn-outline-secondary:hover {
        transform: scale(1.05);
    }

    /* Stat strip */
    .stat-item {
        padding: 10px;
        border-radius: 10px;
        transition: transform 0.25s ease, background-color 0.25s ease;
    }
    .stat-item:hover { background: rgba(255, 255, 255, 0.1); transform: translateY(-3px); }

    /* Responsive adjustments */
    @media (max-width: 991.98px) {
        .hero-section { 
            padding: 2rem;
            min-height: 380px;
        }
        .hero-card-overlay { 
            max-width: 100%; 
        }
        .hero-card-overlay h1 {
            font-size: 2.2rem;
        }
    }
    @media (max-width: 575.98px) {
        .hero-section { 
            padding: 1.75rem;
            min-height: 360px;
        }
        .hero-card-overlay h1 { 
            font-size: 1.8rem;
        }
        .hero-card-overlay p {
            font-size: 0.95rem;
        }
    }
</style>

@auth
<script>
    // Debug helper: expose favoriteIds on the page to verify server data
    window.__favoriteIds = {!! json_encode($favoriteIds ?? []) !!};
    console.log('favoriteIds (server):', window.__favoriteIds);
</script>
@endauth

@endsection