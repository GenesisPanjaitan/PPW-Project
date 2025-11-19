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


    <main class="py-4">
        <div class="container">

            <h2 class="fw-bold mb-1" style="color: #6b5ce7;">My Profile</h2>
            <p class="text-muted mb-4">Kelola informasi profil dan pengaturan akun Anda</p>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="profile-tabs-container">
                    <a href="/profile" class="tab-link {{ Request::is('profile') ? 'active' : '' }}">Informasi Dasar</a>
                    <a href="/profile/academic" class="tab-link {{ Request::is('profile/academic') ? 'active' : '' }}">Akademik & Karir</a>
                    <a href="{{ route('profile.settings') }}" class="tab-link {{ Request::is('profile/settings') ? 'active' : '' }}">Pengaturan</a>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                <div class="card-body p-4 p-md-5">
                    <h5 class="fw-bold mb-1">Keamanan Akun</h5>
                    <p class="text-muted small mb-4">Kelola password dan keamanan akun Anda</p>
                    
                    <button class="btn btn-light border fw-semibold" data-bs-toggle="modal" data-bs-target="#ubahPasswordModal">
                        Ubah Password
                    </button>
                </div>
            </div>
            
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                <div class="card-body p-4 p-md-5">
                    <h5 class="fw-bold mb-1">Data & Privasi</h5>
                    <p class="text-muted small mb-4">Kontrol data pribadi dan pengaturan privasi</p>
                    <button class="btn btn-danger fw-semibold">Hapus Akun</button>
                </div>
            </div>

        </div> </main>


    <div class="modal fade" id="ubahPasswordModal" tabindex="-1" aria-labelledby="ubahPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 1rem; border: 0;">
                
                <div class="modal-header border-0 text-center d-block pb-0">
                    <h4 class="modal-title fw-bold" id="ubahPasswordModalLabel">Ubah Password</h4>
                    <p class="text-muted small">Atur password baru untuk akun anda</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 1.5rem; right: 1.5rem;"></button>
                </div>
                
                <div class="modal-body p-4">
                    <form action="#" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="password_lama" class="form-label-custom">Password Lama:</label>
                            <input type="password" class="form-control form-control-custom" id="password_lama" name="password_lama" placeholder="••••••••" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_baru" class="form-label-custom">Password Baru:</label>
                            <input type="password" class="form-control form-control-custom" id="password_baru" name="password_baru" placeholder="••••••••" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_konfirmasi" class="form-label-custom">Konfirmasi Password Baru:</label>
                            <input type="password" class="form-control form-control-custom" id="password_konfirmasi" name="password_konfirmasi" placeholder="••••••••" required>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-masuk text-white fw-semibold py-2">Ubah Password</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

@endsection