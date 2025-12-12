@extends('layouts.app')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">
            <img src="{{ asset('images/logokita.png') }}" alt="CareerConnect Logo" style="height: 30px;" class="ms-2"> CareerConnect
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navDashboard">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navDashboard">
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
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
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
                        {{ optional(auth()->user())->name ?? 'Alumni' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('favorit') }}">
                                <i class="bi bi-bookmark-fill me-2"></i> Favorit Anda
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Keluar Akun
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="pb-5">
    
    {{-- Hero Section dengan Gradient Modern --}}
    <div class="alumni-hero-wrapper">
        <div class="hero-bg-gradient"></div>
        <div class="hero-bg-shape hero-shape-1"></div>
        <div class="hero-bg-shape hero-shape-2"></div>
        
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-7 py-5">
                    <span class="badge bg-success bg-opacity-25 text-success mb-3 pulse-badge">
                        <i class="bi bi-star-fill me-1"></i> Alumni Dashboard
                    </span>
                    <h1 class="display-4 fw-bold mb-3 text-dark">
                        Bagikan Peluang Karir <br>
                        <span class="text-gradient">Terbaik Anda</span>
                    </h1>
                    <p class="lead text-muted mb-4" style="line-height: 1.8;">
                        Bantu generasi mahasiswa menemukan karir impian mereka. Bersama kita bangun ekosistem profesional yang kuat dan berkelanjutan.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('recruitment') }}" class="btn btn-success btn-lg rounded-pill px-5 fw-bold shadow-sm hover-lift">
                            <i class="bi bi-plus-circle me-2"></i> Posting Lowongan
                        </a>
                        <a href="{{ route('recruitment.my-posts') }}" class="btn btn-outline-success btn-lg rounded-pill px-5 fw-bold">
                            <i class="bi bi-briefcase me-2"></i> Kelola Lowongan
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 text-center d-none d-lg-block">
                    <div class="hero-illustration">
                        <i class="bi bi-briefcase-fill animate-float" style="font-size: 120px; color: #10b981;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5" id="lowongan-section">
        
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">Dashboard Alumni Anda</h2>
            <p class="text-muted">Pantau dan kelola semua lowongan pekerjaan yang Anda bagikan</p>
        </div>

        <div class="row g-4">
            {{-- Kolom Statistik --}}
            <div class="col-lg-4">
                {{-- Card Statistik Postings --}}
                <div class="stat-card-wrapper mb-4">
                    <div class="stat-card stat-card-postings">
                        <div class="stat-icon">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                        <div class="stat-content">
                            <p class="stat-label">Total Lowongan</p>
                            <h3 class="stat-value">{{ $myPostings->count() }}</h3>
                            <small class="stat-subtext">Lowongan yang aktif</small>
                        </div>
                    </div>
                </div>

                {{-- Card Statistik Interactions --}}
                <div class="stat-card-wrapper mb-4">
                    <div class="stat-card stat-card-interactions">
                        <div class="stat-icon">
                            <i class="bi bi-chat-left-text-fill"></i>
                        </div>
                        <div class="stat-content">
                            <p class="stat-label">Total Komentar</p>
                            @php
                                $totalComments = 0;
                                foreach($myPostings as $posting) {
                                    $totalComments += \Illuminate\Support\Facades\DB::table('comment')->where('recruitment_id', $posting->id)->count();
                                }
                            @endphp
                            <h3 class="stat-value">{{ $totalComments }}</h3>
                            <small class="stat-subtext">Interaksi dengan mahasiswa</small>
                        </div>
                    </div>
                </div>

                {{-- Card Statistik Profile --}}
                <div class="stat-card-wrapper mb-4">
                    <div class="stat-card stat-card-profile">
                        <div class="stat-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="stat-content">
                            <p class="stat-label">Profil Alumni</p>
                            <p class="stat-name">{{ optional(auth()->user())->name ?? 'Alumni' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Card Profil Lengkap --}}
                <div class="card profile-card border-0 shadow-sm" style="border-radius: 1.5rem; border-left: 5px solid #10b981;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4 text-dark">
                            <i class="bi bi-person-vcard me-2"></i> Informasi Alumni
                        </h5>

                        <div class="mb-3">
                            <label class="small text-muted d-block mb-2 fw-semibold">Bidang Saat Ini</label>
                            <div class="info-box">
                                @if(auth()->user()->current_field)
                                    {{ auth()->user()->current_field }}
                                @else
                                    <span class="text-muted fst-italic">Belum diatur</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted d-block mb-2 fw-semibold">Pengalaman & Skills</label>
                            <div class="info-box">
                                @if(auth()->user()->experience)
                                    {{ auth()->user()->experience }}
                                @else
                                    <span class="text-muted fst-italic">Belum diatur</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted d-block mb-2 fw-semibold">Tahun Lulus</label>
                            <div class="info-box">
                                @if(auth()->user()->graduation_year)
                                    {{ auth()->user()->graduation_year }}
                                @else
                                    <span class="text-muted fst-italic">Belum diatur</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="small text-muted d-block mb-2 fw-semibold">Bidang Keahlian</label>
                            <div>
                                @if(auth()->user()->field)
                                    @foreach(explode(',', auth()->user()->field) as $skill)
                                        <span class="badge bg-success bg-opacity-20 text-success me-1 mb-2 px-3 py-2">
                                            <i class="bi bi-check-circle me-1"></i> {{ trim($skill) }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-muted fst-italic">Belum ada keahlian yang diatur</span>
                                @endif
                            </div>
                        </div>

                        <hr class="my-3">
                        
                        <a href="{{ url('/profile?mode=edit') }}" class="btn btn-success w-100 rounded-pill fw-bold">
                            <i class="bi bi-pencil-square me-2"></i> Edit Profil
                        </a>
                    </div>
                </div>
            </div>

            {{-- Kolom Daftar Lowongan --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0" style="border-radius: 1.5rem; overflow: hidden;">
                    <div class="card-header border-0 bg-white" style="border-bottom: 2px solid #f0fdf4;">
                        <div class="d-flex justify-content-between align-items-center p-4">
                            <div>
                                <h5 class="fw-bold mb-1 text-dark">
                                    <i class="bi bi-list-check me-2 text-success"></i> Daftar Lowongan Anda
                                </h5>
                                <p class="text-muted small mb-0">{{ $myPostings->count() }} lowongan yang sedang aktif</p>
                            </div>
                            <a href="{{ route('recruitment') }}" class="btn btn-success btn-sm rounded-pill fw-bold">
                                <i class="bi bi-plus-lg me-1"></i> Baru
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        @if($myPostings && $myPostings->count())
                            <div class="job-listings-container">
                                @foreach($myPostings as $posting)
                                    <div class="job-listing-item mb-3" data-posting-id="{{ $posting->id }}">
                                        <div class="job-card-alumni border-0 bg-white p-4 rounded-3 shadow-sm hover-lift">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="d-flex gap-3 flex-grow-1">
                                                    <div class="job-icon-wrapper">
                                                        <i class="bi bi-building text-success"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="fw-bold mb-1 text-dark">{{ $posting->position }}</h6>
                                                        <p class="small mb-2 text-muted">
                                                            <i class="bi bi-building me-1"></i> {{ $posting->company_name }}
                                                        </p>
                                                        <p class="small text-muted mb-2">
                                                            <i class="bi bi-geo-alt me-1"></i> {{ $posting->location }}
                                                            <span class="ms-3">
                                                                <i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($posting->date)->diffForHumans() }}
                                                            </span>
                                                        </p>
                                                        <div class="mt-2">
                                                            @php
                                                                $commentCount = \Illuminate\Support\Facades\DB::table('comment')->where('recruitment_id', $posting->id)->count();
                                                            @endphp
                                                            <span class="badge bg-info bg-opacity-15 text-info me-2">
                                                                <i class="bi bi-chat-left me-1"></i> {{ $commentCount }} Komentar
                                                            </span>
                                                            <span class="badge bg-success bg-opacity-15 text-success">
                                                                <i class="bi bi-eye me-1"></i> Aktif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="dropdown ms-2">
                                                    <button class="btn btn-sm btn-light rounded-circle dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="border-radius: 0.75rem;">
                                                        <li>
                                                            <a class="dropdown-item py-2" href="{{ route('recruitment.detail', $posting->id) }}">
                                                                <i class="bi bi-eye me-2 text-info"></i> Lihat Detail
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item py-2" href="{{ route('recruitment.edit', $posting->id) }}">
                                                                <i class="bi bi-pencil me-2 text-warning"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider m-0"></li>
                                                        <li>
                                                            <form method="POST" action="{{ route('recruitment.destroy', $posting->id) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lowongan ini?');">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="dropdown-item py-2 text-danger">
                                                                    <i class="bi bi-trash me-2"></i> Hapus
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state text-center py-5">
                                <div class="empty-state-icon mb-3">
                                    <i class="bi bi-inbox" style="font-size: 64px; color: #d1d5db;"></i>
                                </div>
                                <h5 class="text-muted fw-bold mb-2">Belum Ada Lowongan</h5>
                                <p class="text-muted mb-4">Anda belum memposting lowongan apapun. Mulai bagikan peluang karir sekarang!</p>
                                <a href="{{ route('recruitment') }}" class="btn btn-success rounded-pill px-4">
                                    <i class="bi bi-plus-circle me-2"></i> Posting Lowongan Pertama
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Quick Actions Banner untuk Alumni --}}
    <div class="container my-4">
        <div class="card border-0 shadow-sm" style="border-radius: 1.5rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8 text-white">
                        <h5 class="fw-bold mb-2">
                            <i class="bi bi-rocket-takeoff-fill me-2"></i>
                            Bantu Mahasiswa Menemukan Peluang Karir
                        </h5>
                        <p class="mb-0 opacity-75">Bagikan lowongan pekerjaan dan magang untuk generasi muda yang berbakat</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('recruitment') }}" class="btn btn-light btn-lg rounded-pill px-4 fw-bold shadow">
                            <i class="bi bi-plus-circle me-2"></i>Posting Lowongan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover animation to stat cards
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Smooth scroll for sections
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    });
</script>

<style>
    /* Variables */
    :root {
        --green-primary: #10b981;
        --green-dark: #059669;
        --blue-primary: #3b82f6;
        --blue-dark: #1d4ed8;
        --orange-primary: #f59e0b;
        --orange-dark: #d97706;
    }

    /* Gradient Text */
    .text-gradient {
        background: linear-gradient(135deg, var(--green-primary) 0%, var(--green-dark) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
    }

    /* Hero Section Alumni */
    .alumni-hero-wrapper {
        background: linear-gradient(135deg, #f0fdf4 0%, #f8f9ff 100%);
        padding: 80px 0;
        position: relative;
        overflow: hidden;
        min-height: 600px;
    }

    .min-vh-75 {
        min-height: 75vh;
    }

    .hero-bg-gradient {
        position: absolute;
        top: 0;
        right: 0;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle at center, rgba(16, 185, 129, 0.08), transparent);
        border-radius: 50%;
        z-index: 1;
    }

    .hero-bg-shape {
        position: absolute;
        border-radius: 50%;
        z-index: 1;
    }

    .hero-shape-1 {
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), transparent);
        top: 10%;
        left: 5%;
        animation: float 6s ease-in-out infinite;
    }

    .hero-shape-2 {
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), transparent);
        bottom: 10%;
        right: 10%;
        animation: float 8s ease-in-out infinite reverse;
    }

    .hero-illustration {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    /* Pulse Badge */
    .pulse-badge {
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }

    /* Stat Cards */
    .stat-card-wrapper {
        transition: all 0.3s ease;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem;
        border-radius: 1rem;
        color: white;
        min-height: 120px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: -50%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: 0;
        transition: all 0.3s ease;
    }

    .stat-card:hover::before {
        right: -20%;
    }

    .stat-card-postings {
        background: linear-gradient(135deg, var(--green-primary) 0%, var(--green-dark) 100%);
    }

    .stat-card-interactions {
        background: linear-gradient(135deg, var(--blue-primary) 0%, var(--blue-dark) 100%);
    }

    .stat-card-profile {
        background: linear-gradient(135deg, var(--orange-primary) 0%, var(--orange-dark) 100%);
    }

    .stat-icon {
        font-size: 2.5rem;
        z-index: 1;
        opacity: 0.95;
    }

    .stat-content {
        z-index: 1;
    }

    .stat-label {
        margin: 0;
        font-size: 0.9rem;
        opacity: 0.9;
        font-weight: 500;
    }

    .stat-value {
        margin: 0.5rem 0 0 0;
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
    }

    .stat-subtext {
        opacity: 0.8;
        display: block;
        margin-top: 0.25rem;
    }

    .stat-name {
        margin: 0.5rem 0 0 0;
        font-size: 1rem;
        font-weight: 600;
    }

    /* Info Box */
    .info-box {
        background: linear-gradient(135deg, #f0fdf4 0%, #f3f4f6 100%);
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        border-left: 3px solid var(--green-primary);
        color: #1f2937;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .info-box:hover {
        background: linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%);
        transform: translateX(4px);
    }

    /* Job Card Alumni */
    .job-card-alumni {
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
    }

    /* Enhanced animations and effects */
    body {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    /* Stat Cards - Enhanced */
    .stat-card {
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--green-primary), var(--green-dark));
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }
    
    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 40px rgba(16, 185, 129, 0.25) !important;
    }

    /* Job Card Alumni - Enhanced */
    .job-card-alumni {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid #e5e7eb;
        position: relative;
        overflow: hidden;
    }
    
    .job-card-alumni::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(180deg, #10b981, #059669);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .job-card-alumni:hover::before {
        transform: scaleY(1);
    }

    .job-card-alumni:hover {
        box-shadow: 0 15px 40px rgba(16, 185, 129, 0.2) !important;
        border-color: var(--green-primary);
        transform: translateX(8px) translateY(-4px);
    }

    .job-icon-wrapper {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border-radius: 0.75rem;
        font-size: 1.5rem;
        flex-shrink: 0;
        transition: all 0.4s ease;
        position: relative;
    }

    .job-icon-wrapper::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: inherit;
        background: linear-gradient(135deg, #10b981, #059669);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .job-card-alumni:hover .job-icon-wrapper::after {
        opacity: 1;
    }
    
    .job-card-alumni:hover .job-icon-wrapper {
        transform: scale(1.15) rotate(5deg);
    }

    .job-card-alumni:hover .job-icon-wrapper i {
        color: white !important;
        position: relative;
        z-index: 1;
    }

    /* Animated gradient background for hero */
    .alumni-hero-wrapper {
        position: relative;
        overflow: hidden;
    }

    .hero-bg-gradient {
        animation: gradientShift 8s ease-in-out infinite;
    }

    @keyframes gradientShift {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.1); }
    }

    /* Info Box Enhancement */
    .info-box {
        background: linear-gradient(135deg, #f0fdf4 0%, #f3f4f6 100%);
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        border-left: 3px solid var(--green-primary);
        color: #1f2937;
        font-weight: 500;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .info-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .info-box:hover::before {
        left: 100%;
    }

    .info-box:hover {
        background: linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%);
        transform: translateX(6px);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.15);
    }

    /* Badge with pulse effect */
    .badge {
        animation: fadeInUp 0.5s ease-out;
        position: relative;
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

    /* Pulse Badge */
    .pulse-badge {
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.85; transform: scale(1.05); }
    }

    /* Profile Card Enhanced */
    .profile-card {
        transition: all 0.3s ease;
        border: 2px solid transparent;
        background-clip: padding-box;
        position: relative;
    }

    .profile-card::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(135deg, #10b981, #059669);
        border-radius: inherit;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .profile-card:hover::before {
        opacity: 0.3;
    }

    .profile-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 40px rgba(16, 185, 129, 0.2) !important;
    }

    /* Button ripple effect */
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
        background: rgba(255, 255, 255, 0.4);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
        z-index: -1;
    }

    .btn:hover::before {
        width: 300px;
        height: 300px;
    }

    /* Hover Lift Effect */
    .hover-lift {
        transition: all 0.3s ease;
        position: relative;
    }

    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15) !important;
    }

    /* Empty State */
    .empty-state {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        border-radius: 1rem;
        border: 2px dashed #e5e7eb;
        transition: all 0.3s ease;
    }

    .empty-state:hover {
        border-color: var(--green-primary);
        background: linear-gradient(135deg, #f0fdf4 0%, #f9fafb 100%);
    }

    .empty-state-icon {
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); opacity: 0.7; }
        50% { transform: translateY(-10px); opacity: 1; }
    }

    /* Card Header Custom */
    .card-header {
        background: white;
    }

    /* Profile Card */
    .profile-card {
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(16, 185, 129, 0.1) !important;
    }

    /* Dropdown Menu Styling */
    .dropdown-menu {
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .dropdown-item {
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f0fdf4;
    }

    /* Smooth Transitions */
    * {
        transition: color 0.2s ease, background-color 0.2s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .alumni-hero-wrapper {
            padding: 60px 0;
            min-height: 400px;
        }

        .min-vh-75 {
            min-height: auto;
        }

        .display-4 {
            font-size: 2rem;
        }

        .stat-card {
            gap: 1rem;
        }

        .stat-icon {
            font-size: 2rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }
    }
</style>

@endsection
