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

            </div>
        </div>
    </nav>


    <!-- =======================
    Konten Halaman Favorit
    ======================== -->
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <!-- Judul Halaman -->
                    <div class="text-center mb-5">
                        <h2 class="fw-bold mb-1 text-recruitment-blue">Favorit Anda</h2>
                        <p class="text-muted small">Pilihan Terbaik Menuju Karier Impian</p>
                    </div>

                    <!-- 
                    ========================
                    PERUBAHAN DI SINI:
                    Semua kartu dummy dihapus dan diganti dengan 
                    tampilan "Kosong" (Empty State).
                    ========================
                    -->
                    <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <i class="bi bi-bookmark-x fs-1 text-muted"></i>
                            <h5 class="mt-3 fw-bold text-dark">Anda belum memiliki favorit</h5>
                            <p class="text-muted">Klik ikon bookmark pada lowongan untuk menyimpannya di sini.</p>
                            
                            <!-- 
                              Tombol ini menggunakan style .btn-masuk (biru) 
                              dari app.blade.php Anda agar konsisten 
                            -->
                            <a href="{{ route('recruitment') }}" class="btn btn-masuk text-white mt-3 px-4 py-2 fw-semibold">
                                Jelajahi Lowongan
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

@endsection