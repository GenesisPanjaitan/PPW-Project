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
                            @if(auth()->user() && auth()->user()->image)
                                @php
                                    $avatarUrl = filter_var(auth()->user()->image, FILTER_VALIDATE_URL)
                                        ? auth()->user()->image
                                        : asset('storage/profile_photos/' . auth()->user()->image);
                                @endphp
                                <img src="{{ $avatarUrl }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;">
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
        
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Halo, {{ optional(auth()->user())->name ?? 'Mahasiswa' }} 👋</h2>
            <p class="text-muted lead">Siap untuk menemukan peluang karir terbaik hari ini?</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
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
                                                                $isFav = in_array($r->id, $favoriteIds ?? []);
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
                @if(strtolower(auth()->user()->role) === 'admin')
                    {{-- Statistik untuk Admin --}}
                    <div class="card profile-card border-0 shadow-sm" style="border-radius: 1rem;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 text-dark">
                                <i class="bi bi-bar-chart-fill me-2 text-primary"></i>Statistik Sistem
                            </h5>

                            <div class="mb-3 p-3 rounded" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <label class="small text-white d-block mb-2"><i class="bi bi-people-fill me-2"></i>Total Mahasiswa</label>
                                <h3 class="fw-bold text-white mb-0">
                                    @php
                                        $mahasiswaCount = DB::table('user')->where('role', 'mahasiswa')->count();
                                    @endphp
                                    {{ $mahasiswaCount }}
                                </h3>
                            </div>

                            <div class="mb-3 p-3 rounded" style="background: linear-gradient(135deg, #48c78e 0%, #06d6a0 100%);">
                                <label class="small text-white d-block mb-2"><i class="bi bi-mortarboard-fill me-2"></i>Total Alumni</label>
                                <h3 class="fw-bold text-white mb-0">
                                    @php
                                        $alumniCount = DB::table('user')->where('role', 'alumni')->count();
                                    @endphp
                                    {{ $alumniCount }}
                                </h3>
                            </div>

                            <div class="mb-4 p-3 rounded" style="background: linear-gradient(135deg, #ffa726 0%, #ff7043 100%);">
                                <label class="small text-white d-block mb-2"><i class="bi bi-briefcase-fill me-2"></i>Total Lowongan</label>
                                <h3 class="fw-bold text-white mb-0">
                                    @php
                                        $lowonganCount = DB::table('recruitment')->count();
                                    @endphp
                                    {{ $lowonganCount }}
                                </h3>
                            </div>

                            <hr class="my-3">
                            
                            <a href="/admin/dashboard" class="btn btn-primary w-100 rounded-pill fw-bold">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Profil Singkat untuk Mahasiswa & Alumni --}}
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

                        @if(strtolower(auth()->user()->role) !== 'admin')
                            <div class="mb-3">
                                @if(strtolower(auth()->user()->role) === 'alumni')
                                    <label class="small text-muted d-block">Bidang Saat Ini</label>
                                    <span class="fw-semibold text-dark">
                                        @if(auth()->user()->current_field)
                                            @switch(auth()->user()->current_field)
                                                @case('swe') Software Engineering @break
                                                @case('uiux') UI/UX Design @break
                                                @case('data') Data Science @break
                                                @case('product') Product Management @break
                                                @case('digital_marketing') Digital Marketing @break
                                                @case('qa_testing') QA & Testing @break
                                                @case('cybersecurity') Cybersecurity @break
                                                @case('operations') Operations @break
                                                @case('lainnya') Lainnya @break
                                                @default {{ auth()->user()->current_field }}
                                            @endswitch
                                        @else
                                            <span class="text-muted">Belum diatur</span>
                                        @endif
                                    </span>
                                @else
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
                                @endif
                            </div>
                        @endif

                        <div class="mb-4">
                            @if(strtolower(auth()->user()->role) === 'mahasiswa')
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
                            @else
                                <label class="small text-muted d-block mb-1">Tahun Angkatan</label>
                                <span class="fw-semibold text-dark">
                                    @if(auth()->user()->graduation_year)
                                        {{ auth()->user()->graduation_year }}
                                    @else
                                        <span class="text-muted">Belum diatur</span>
                                    @endif
                                </span>
                            @endif
                        </div>

                        <hr class="my-3">
                        
                        <a href="{{ url('/profile?mode=edit') }}" class="btn btn-outline-primary w-100 rounded-pill">
                            <i class="bi bi-pencil-square me-1"></i> Edit Profil
                        </a>

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>



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
    /* Enhanced styling for dashboard */
    body {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .job-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
        position: relative;
        overflow: hidden;
    }
    
    .job-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #0d6efd, #6610f2);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }
    
    .job-card:hover::before {
        transform: scaleY(1);
    }
    
    .job-card:hover {
        transform: translateX(8px) translateY(-4px) !important;
        box-shadow: 0 12px 35px rgba(13, 110, 253, 0.2) !important;
    }
    
    .hover-shadow:hover {
        transition: all 0.3s ease;
    }

    /* Smooth animations */
    * {
        transition: all 0.3s ease;
    }
    
    /* Enhanced hero section styling */
    .hero-section {
        position: relative;
        border-radius: 1rem;
        overflow: hidden;
    }
    
    .hero-section::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        pointer-events: none;
    }
    
    .text-highlight {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
        display: inline-block;
    }
    
    .text-highlight::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
        animation: slideWidth 2s ease-in-out infinite;
    }
    
    @keyframes slideWidth {
        0%, 100% { width: 100%; }
        50% { width: 60%; }
    }
    
    /* Profile card enhancement */
    .profile-card {
        background: white;
        border: 2px solid transparent;
        background-clip: padding-box;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .profile-card::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: inherit;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .profile-card:hover::before {
        opacity: 1;
    }
    
    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2) !important;
    }
    
    /* Badge animations */
    .badge {
        animation: fadeInUp 0.5s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Icon enhancement */
    .bi-building {
        animation: bounce 2s ease-in-out infinite;
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    /* Card hover glow */
    .card {
        position: relative;
        transition: all 0.3s ease;
    }
    
    .card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.12) !important;
    }
    
    /* Button enhancement */
    .btn {
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    
    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
        z-index: -1;
    }
    
    .btn:hover::before {
        width: 300px;
        height: 300px;
    }
    
    /* Quick stat items */
    .quick-stat-item {
        padding: 15px;
        border-radius: 12px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .quick-stat-item:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px) scale(1.05);
    }
    
    .quick-stat-item i {
        display: block;
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
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
