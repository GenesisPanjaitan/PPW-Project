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
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>
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

    <div class="container mt-4" id="lowongan-section"> {{-- Penyesuaian margin top untuk konten di bawah hero --}}

        @if (session('login_success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('login_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <h2 class="fw-bold mb-1">Selamat datang, {{ optional(auth()->user())->name ?? 'Kevin Gultom' }} 👋</h2>
        <p class="text-muted mb-4">Siap untuk mencari peluang karir hari ini?</p>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-1">Rekomendasi Lowongan</h5>
                        <p class="text-muted small mb-3">Berdasarkan minat dan skill Anda</p>

                        <div class="card job-card mb-3 border-0 bg-light">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex">
                                        <div class="me-3 d-flex align-items-center justify-content-center bg-white rounded shadow-sm" style="width:50px; height:50px;">
                                           <i class="bi bi-code-slash fs-4 text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Frontend Developer Intern</h6>
                                            <p class="small mb-1 text-dark">Techstart Indonesia</p>
                                            <p class="small text-muted mb-0">
                                                <i class="bi bi-geo-alt me-1"></i> Bandung 
                                                <i class="bi bi-clock ms-2 me-1"></i> 2 hari lalu
                                            </p>
                                        </div>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-bookmark"></i></button>
                                </div>
                                <div class="mt-3">
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info rounded-pill px-3">Internship</span>
                                </div>
                            </div>
                        </div>

                        <div class="card job-card mb-3 border-0 bg-light">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex">
                                        <div class="me-3 d-flex align-items-center justify-content-center bg-white rounded shadow-sm" style="width:50px; height:50px;">
                                           <i class="bi bi-palette fs-4 text-warning"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">UI/UX Designer</h6>
                                            <p class="small mb-1 text-dark">Creative Studio</p>
                                            <p class="small text-muted mb-0">
                                                <i class="bi bi-geo-alt me-1"></i> Bandung 
                                                <i class="bi bi-clock ms-2 me-1"></i> 4 hari lalu
                                            </p>
                                        </div>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-bookmark"></i></button>
                                </div>
                                <div class="mt-3">
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-3">Part-time</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-1">Lowongan Terbaru</h5>
                        <p class="text-muted small mb-3">Temukan Kesempatan Baru Hari Ini</p>

                        @if(!empty($latestRecruitments) && $latestRecruitments->count())
                            @foreach($latestRecruitments as $r)
                                <div class="card job-card mb-3 border-0 bg-light" style="cursor:pointer;" onclick="if(!event.target.closest('.favorite-form') && !event.target.closest('a')){ window.location='{{ route('recruitment.detail', ['id' => $r->id]) }}'; }">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="d-flex">
                                                <div class="me-3 d-flex align-items-center justify-content-center bg-white rounded shadow-sm" style="width:50px; height:50px;">
                                                   <i class="bi bi-building fs-4 text-danger"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-0">{{ $r->position }}</h6>
                                                    <p class="small mb-1 text-dark">{{ $r->company_name }}</p>
                                                    <p class="small text-muted mb-0">
                                                        <i class="bi bi-geo-alt me-1"></i> {{ $r->location }} 
                                                        <i class="bi bi-clock ms-2 me-1"></i> {{ \Carbon\Carbon::parse($r->date)->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div>
                                                @auth
                                                    @php
                                                        $isFav = \Illuminate\Support\Facades\DB::table('favorite')
                                                            ->where('user_id', auth()->id())
                                                            ->where('recruitment_id', $r->id)
                                                            ->exists();
                                                    @endphp
                                                    @if($isFav)
                                                        <form action="{{ route('favorite.destroy', ['id'=>$r->id]) }}" method="POST" class="d-inline favorite-form">
                                                            @csrf @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-secondary rounded-circle text-danger" title="Hapus Favorit">
                                                                <i class="bi bi-bookmark-fill"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('favorite.store', ['id'=>$r->id]) }}" method="POST" class="d-inline favorite-form">
                                                            @csrf
                                                            <button class="btn btn-sm btn-outline-secondary rounded-circle" title="Simpan Favorit">
                                                                <i class="bi bi-bookmark"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @else
                                                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary rounded-circle" title="Login untuk menyimpan"><i class="bi bi-bookmark"></i></a>
                                                @endauth
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3">{{ $r->jobtype ?? 'Full-time' }}</span>
                                        </div>
                                    </div>
                                </div>
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
                            <span class="fw-semibold text-dark">Sistem Informasi</span>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted d-block">Minat Karir</label>
                            <span class="fw-semibold text-dark">Software Development</span>
                        </div>

                        <div class="mb-4">
                            <label class="small text-muted d-block mb-1">Skills</label>
                            <div>
                                <span class="badge bg-secondary bg-opacity-10 text-dark me-1 mb-1">Python</span>
                                <span class="badge bg-secondary bg-opacity-10 text-dark me-1 mb-1">JavaScript</span>
                                <span class="badge bg-secondary bg-opacity-10 text-dark me-1 mb-1">C++</span>
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

@endsection