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

<main class="py-4">
    <div class="container">

        <!-- Notifikasi (Hanya muncul sekali setelah login) -->
        @if (session('login_success'))
            <div class="alert alert-welcome d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <div>
                    {{ session('login_success') }}
                </div>
            </div>
        @endif
        
        <h2 class="fw-bold mb-1">Selamat datang, Kevin Gultom 👋</h2>
        <p class="text-muted mb-4">Siap untuk mencari peluang karir hari ini?</p>

        <div class="row g-4">
            <!-- KIRI: LOWONGAN -->
            <div class="col-lg-8">
                <!-- Rekomendasi Lowongan -->
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-1">Rekomendasi Lowongan</h5>
                        <p class="text-muted small mb-3">Berdasarkan minat dan skill Anda</p>

                        <!-- Card 1 -->
                        <div class="card job-card mb-3 border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold mb-0">Frontend Developer Intern</h6>
                                        <p class="small mb-2">Techstart Indonesia</p>
                                        <p class="small text-muted mb-0">
                                            <i class="bi bi-geo-alt me-1"></i> Bandung 
                                            <i class="bi bi-clock ms-2 me-1"></i> 2 hari lalu
                                        </p>
                                    </div>
                                    <button class="btn btn-sm btn-bookmark"><i class="bi bi-bookmark"></i></button>
                                </div>
                                <span class="badge job-badge-internship mt-3">internship</span>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="card job-card mb-3 border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold mb-0">UI/UX Designer</h6>
                                        <p class="small mb-2">Creative Studio</p>
                                        <p class="small text-muted mb-0">
                                            <i class="bi bi-geo-alt me-1"></i> Bandung 
                                            <i class="bi bi-clock ms-2 me-1"></i> 4 hari lalu
                                        </p>
                                    </div>
                                    <button class="btn btn-sm btn-bookmark"><i class="bi bi-bookmark"></i></button>
                                </div>
                                <span class="badge job-badge-part-time mt-3">part-time</span>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="card job-card border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold mb-0">Data Analyst</h6>
                                        <p class="small mb-2">DataCorp</p>
                                        <p class="small text-muted mb-0">
                                            <i class="bi bi-geo-alt me-1"></i> Jakarta 
                                            <i class="bi bi-clock ms-2 me-1"></i> 5 hari lalu
                                        </p>
                                    </div>
                                    <button class="btn btn-sm btn-bookmark"><i class="bi bi-bookmark"></i></button>
                                </div>
                                <span class="badge job-badge-full-time mt-3">full-time</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lowongan Terbaru -->
                <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-1">Lowongan Terbaru</h5>
                        <p class="text-muted small mb-3">Temukan Kesempatan Baru Hari Ini</p>

                        <!-- Card 1 -->
                        <div class="card job-card mb-3 border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold mb-0">Frontend Developer Intern</h6>
                                        <p class="small mb-2">Telkom Indonesia</p>
                                        <p class="small text-muted mb-0">
                                            <i class="bi bi-geo-alt me-1"></i> Jakarta 
                                            <i class="bi bi-clock ms-2 me-1"></i> 1 hari lalu
                                        </p>
                                    </div>
                                    <button class="btn btn-sm btn-bookmark"><i class="bi bi-bookmark"></i></button>
                                </div>
                                <span class="badge job-badge-internship mt-3">internship</span>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="card job-card border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold mb-0">UI/UX Designer</h6>
                                        <p class="small mb-2">Bank Mandiri Teknologi</p>
                                        <p class="small text-muted mb-0">
                                            <i class="bi bi-geo-alt me-1"></i> Bandung 
                                            <i class="bi bi-clock ms-2 me-1"></i> 1 hari lalu
                                        </p>
                                    </div>
                                    <button class="btn btn-sm btn-bookmark"><i class="bi bi-bookmark"></i></button>
                                </div>
                                <span class="badge job-badge-part-time mt-3">part-time</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- KANAN: PROFIL -->
            <div class="col-lg-4">
                <div class="card profile-card border-0">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 text-dark">Profil Singkat</h5>

                        <label class="small text-muted">Jurusan</label>
                        <p class="fw-semibold text-dark mb-2">Sistem Informasi</p>

                        <label class="small text-muted">Minat Karir</label>
                        <p class="fw-semibold text-dark mb-3">Software Development</p>

                        <label class="small text-muted">Skills</label>
                        <div class="mt-1">
                            <span class="skill-tag">Python</span>
                            <span class="skill-tag">JavaScript</span>
                            <span class="skill-tag">C++</span>
                        </div>

                        <hr class="my-3">
                        
                        <!-- =======================
                        PERUBAHAN DI SINI
                        ======================== -->
                        <a href="{{ url('/profile?mode=edit') }}" class="btn btn-edit-profile w-100">Edit Profil</a>
                        <!-- =======================
                        AKHIR PERUBAHAN
                        ======================== -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Script Notifikasi (Hanya jika ada session) -->
@if (session('login_success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const alertBox = document.querySelector('.alert-welcome');
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.opacity = '0';
                alertBox.style.top = '0px';
                alertBox.style.transform = 'translateX(-50%) scale(0.8)';
                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 500);
            }, 3000);
        }
    });
</script>
@endif

@endsection