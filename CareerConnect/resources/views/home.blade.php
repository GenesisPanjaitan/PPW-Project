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
            
            <!-- Menu Kanan (Dropdown Profil) -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <!-- Tombol Pemicu Dropdown -->
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-1"></i>
                        @auth
                            {{ auth()->user()->name }}
                        @else
                            Kevin Gultom
                        @endauth
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
                            Kevin Gultom
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
                <div class="hero-bg active" style="background-image: url('https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=2070&auto=format&fit=crop');"></div>
                <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2084&auto=format&fit=crop');"></div>
                <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop');"></div>

                {{-- Overlay Card dengan Teks --}}
                <div class="hero-card-overlay">
                    <h1 class="display-5 fw-bold mb-3">
                        Selamat Datang di <br> <span class="text-highlight">CareerConnect.</span>
                    </h1>
                    <p class="lead text-light opacity-75 mb-4 fs-6">
                        Temukan dunia peluang karir melalui ribuan lowongan di bidang teknologi, bisnis, hingga kreatif. Mulai perjalanan profesionalmu sekarang!
                    </p>
                   <a href="{{ url('/recruitment') }}" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold">
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
        
        <h2 class="fw-bold mb-1">Selamat datang, @auth {{ auth()->user()->name }} @else Kevin Gultom @endauth 👋</h2>
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

                        <div class="card job-card mb-3 border-0 bg-light">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex">
                                        <div class="me-3 d-flex align-items-center justify-content-center bg-white rounded shadow-sm" style="width:50px; height:50px;">
                                           <i class="bi bi-building fs-4 text-danger"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Data Analyst</h6>
                                            <p class="small mb-1 text-dark">Telkom Indonesia</p>
                                            <p class="small text-muted mb-0">
                                                <i class="bi bi-geo-alt me-1"></i> Jakarta 
                                                <i class="bi bi-clock ms-2 me-1"></i> 1 hari lalu
                                            </p>
                                        </div>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-bookmark"></i></button>
                                </div>
                                <div class="mt-3">
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3">Full-time</span>
                                </div>
                            </div>
                        </div>

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
<footer class="py-5 bg-white border-top"> 
    <div class="container"> 
        <div class="row g-4 text-center"> 
            
            <div class="col-md-4"> 
                <h5 class="fw-bold">Contact Us</h5> 
                <ul class="list-unstyled text-muted"> 
                    <li class="mb-2"><i class="bi bi-envelope me-2"></i>careerconnect@del.ac.id</li> 
                    <li class="mb-2"><i class="bi bi-telephone me-2"></i>(0632) 123 456</li> 
                    <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Institut Teknologi Del, Sitoluama</li> 
                </ul> 
            </div> 
            
            <div class="col-md-4"> 
                <h5 class="fw-bold fs-4">CareerConnect</h5> 
                <p class="text-muted"> Menghubungkan mahasiswa dan alumni Institut Teknologi Del dengan peluang terbaik untuk magang, part-time, dan karir penuh waktu. </p> 
            </div> 
            
            <div class="col-md-4"> 
                <h5 class="fw-bold">Dukungan</h5> 
                <p class="text-muted mb-2">Platform ini dikembangkan bersama Institut Teknologi Del.</p> 
                <img src="{{ asset('images/logo del.jpg') }}" alt="Logo Institut Teknologi Del" class="mx-auto d-block footer-logo"> 
            </div> 
        </div> 
    </div> 
</footer>

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