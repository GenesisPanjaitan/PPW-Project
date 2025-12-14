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
                        <!-- Tombol Pemicu Dropdown dengan Foto Profil -->
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
                            {{ optional(auth()->user())->name ?? 'User' }}
                        </a>
                        
                        <!-- Isi Dropdown (tanpa Profile Saya) -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item active" href="{{ route('favorit') }}">
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


    <!-- =======================
    Konten Halaman Favorit
    ======================== -->
    <main class="py-5" style="background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%); min-height: calc(100vh - 200px);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <!-- Judul Halaman -->
                    <div class="text-center mb-5 mt-4">
                        <div class="d-inline-block p-3 bg-primary bg-opacity-10 rounded-circle mb-3">
                            <i class="bi bi-bookmark-star fs-1 text-primary"></i>
                        </div>
                        <h2 class="fw-bold mb-2" style="color: #2c3e50;">Favorit Anda</h2>
                        <p class="text-muted">Koleksi lowongan terbaik yang Anda simpan</p>
                    </div>

                    <!-- 
                    ========================
                    PERUBAHAN DI SINI:
                    Semua kartu dummy dihapus dan diganti dengan 
                    tampilan "Kosong" (Empty State).
                    ========================
                    -->
                    @if(!empty($favorites) && $favorites->count())
                        @foreach($favorites as $r)
                            <div class="card border-0 shadow-sm mb-4 hover-card" style="border-radius: 1rem; overflow: hidden; transition: all 0.3s ease;">
                                <div class="card-body p-0">
                                    <div class="row g-0 align-items-center">
                                        <!-- Foto Perusahaan -->
                                        <div class="col-md-3">
                                            @if(!empty($r->image))
                                                <img src="{{ asset('storage/' . $r->image) }}" 
                                                     alt="Foto Perusahaan" 
                                                     class="w-100" 
                                                     style="height: 180px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 180px;">
                                                    <div class="text-center">
                                                        <i class="bi bi-image-fill fs-1 opacity-25"></i>
                                                        <p class="small mt-2 mb-0">Foto tidak ditampilkan</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Informasi Lowongan -->
                                        <div class="col-md-6 p-4">
                                            <span class="badge bg-primary bg-opacity-10 text-primary mb-2 px-3 py-2 rounded-pill">
                                                <i class="bi bi-briefcase me-1"></i> {{ $r->category ?? 'Lowongan' }}
                                            </span>
                                            <h5 class="fw-bold mb-2 text-dark">{{ $r->position }}</h5>
                                            <div class="d-flex flex-wrap gap-3 text-muted small mb-2">
                                                <span><i class="bi bi-building me-1"></i>{{ $r->company_name }}</span>
                                                <span><i class="bi bi-geo-alt me-1"></i>{{ $r->location }}</span>
                                            </div>
                                            <span class="text-muted small">
                                                <i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($r->date)->diffForHumans() }}
                                            </span>
                                        </div>
                                        
                                        <!-- Tombol Aksi -->
                                        <div class="col-md-3 p-4">
                                            <div class="d-flex flex-column gap-2">
                                                <a href="{{ route('recruitment.detail', ['id'=>$r->id]) }}" class="btn btn-primary px-4 py-2 rounded-pill">
                                                    <i class="bi bi-eye me-2"></i>Lihat Detail
                                                </a>
                                                <form action="{{ route('favorite.destroy', ['id'=>$r->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger px-4 py-2 rounded-pill w-100" onclick="return confirm('Hapus dari favorit?')">
                                                        <i class="bi bi-trash me-2"></i>Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card border-0 shadow-sm" style="border-radius: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="card-body p-5 text-center text-white">
                                <div class="mb-4">
                                    <i class="bi bi-bookmark-heart display-1 opacity-75"></i>
                                </div>
                                <h4 class="fw-bold mb-3">Belum Ada Favorit</h4>
                                <p class="mb-4 opacity-90">Mulai simpan lowongan favorit Anda dengan mengklik ikon bookmark pada setiap lowongan yang menarik.</p>
                                <a href="{{ route('recruitment') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-semibold shadow">
                                    <i class="bi bi-search me-2"></i>Jelajahi Lowongan
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </main>

    <style>
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        }
        main {
            padding-bottom: 200px !important;
            min-height: calc(100vh - 100px);
        }
    </style>

@endsection