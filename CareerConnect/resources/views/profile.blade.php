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
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>
                            @auth
                                {{ auth()->user()->name }}
                            @else
                                {{ optional(auth()->user())->name ?? 'Kevin Gultom' }}
                            @endauth
                        </a>
                        
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('favorit') }}">
                                    <i class="bi bi-bookmark-fill me-2"></i> Favorit Anda
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Keluar Akun
                                </a>
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
                
                @if(request('mode') == 'edit')
                    <div class="d-flex gap-2">
                        <button type="submit" form="profileForm" class="btn btn-dark btn-sm fw-semibold">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                        <a href="/profile" class="btn btn-danger btn-sm fw-semibold">
                            <i class="bi bi-x-lg me-1"></i> Batal
                        </a>
                    </div>
                @else
                    <a href="/profile?mode=edit" class="btn btn-dark btn-sm fw-semibold">
                        <i class="bi bi-pencil-fill me-1"></i> Edit Profil
                    </a>
                @endif
            </div>

            <!-- Form Profile (Ditambah enctype untuk upload gambar) -->
            <form action="#" method="POST" id="profileForm" enctype="multipart/form-data">
                @csrf
                
                <div class="text-center mb-4">
                    <h5 class="fw-bold">Foto Profil</h5>
                    <p class="text-muted small">Upload foto profil untuk membantu orang mengenal Anda</p>
                    
                    <!-- AREA FOTO PROFIL (UPDATED) -->
                    <!-- Menambahkan overflow-hidden agar gambar tidak keluar dari lingkaran -->
                    <div class="avatar-placeholder mx-auto d-flex align-items-center justify-content-center position-relative overflow-hidden">
                        
                        <!-- 1. Gambar Preview (Default Sembunyi) -->
                        <img id="avatarPreview" src="#" alt="Preview" class="d-none w-100 h-100" style="object-fit: cover;">
                        
                        <!-- 2. Icon User Default (Pengganti huruf K) -->
                        <i id="avatarInitial" class="bi bi-person-fill" style="font-size: 3rem; color: #6c757d;"></i>
                        
                    </div>
                    
                    <!-- LOGIC UPLOAD FOTO -->
                    @if(request('mode') == 'edit')
                        <!-- Input File Tersembunyi -->
                        <input type="file" id="fileInput" name="foto_profil" class="d-none" accept="image/*" onchange="previewImage(event)">
                        
                        <!-- Label sebagai Tombol -->
                        <label for="fileInput" class="btn btn-dark btn-sm fw-semibold mt-3" style="cursor: pointer;">
                            <i class="bi bi-upload me-1"></i> Upload Foto
                        </label>
                    @endif
                </div>

                <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                    <div class="card-body p-4 p-md-5">
                        
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h5 class="fw-bold mb-1">Informasi Personal</h5>
                                <p class="text-muted small mb-0">Informasi dasar tentang diri Anda</p>
                            </div>
                            <span class="badge bg-primary rounded-pill fw-semibold" style="font-size: 0.8rem;">{{ ucfirst(auth()->user()->role ?? 'Mahasiswa') }}</span>
                        </div>

                        <div class="row g-3">
                            
                            <div class="col-md-6">
                                <label class="form-label-custom">Nama Lengkap</label>
                                @if(request('mode') == 'edit')
                                    <input type="text" class="form-control form-control-custom" name="nama_lengkap" value="{{ old('nama_lengkap', auth()->user()->name ?? '') }}">
                                @else
                                    <div class="form-control-custom d-flex align-items-center">
                                        <i class="bi bi-person me-2 text-muted"></i>
                                        <span class="fw-medium">{{ auth()->user()->name ?? 'Kevin Gultom' }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Email</label>
                                @if(request('mode') == 'edit')
                                    <input type="email" class="form-control form-control-custom" name="email" value="{{ old('email', auth()->user()->email ?? '') }}">
                                @else
                                    <div class="form-control-custom d-flex align-items-center">
                                        <i class="bi bi-envelope me-2 text-muted"></i>
                                        <span class="fw-medium">{{ auth()->user()->email ?? 'kevingultom@gmail.com' }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">NIM</label>
                                @if(request('mode') == 'edit')
                                    <input type="text" class="form-control form-control-custom" name="nim" value="{{ old('nim', auth()->user()->nim ?? '') }}">
                                @else
                                    <div class="form-control-custom d-flex align-items-center">
                                        <i class="bi bi-person-vcard me-2 text-muted"></i>
                                        <span class="fw-medium">{{ auth()->user()->nim ?? '12S23001' }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Kontak</label>
                                @if(request('mode') == 'edit')
                                    <input type="text" class="form-control form-control-custom" name="kontak" value="{{ old('kontak', auth()->user()->contact ?? '') }}">
                                @else
                                    <div class="form-control-custom d-flex align-items-center">
                                        <i class="bi bi-telephone me-2 text-muted"></i>
                                        <span class="fw-medium">{{ auth()->user()->contact ?? '+62 811 2233 4455' }}</span>
                                    </div>
                                @endif
                            </div>

                        </div> 
                    </div> 
                </div> 
            </form> 
        </div> 
    </main>

    <!-- Javascript Preview Gambar -->
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('avatarPreview');
                var initial = document.getElementById('avatarInitial');
                
                output.src = reader.result;
                output.classList.remove('d-none'); // Munculkan gambar
                initial.style.display = 'none';    // Sembunyikan icon user
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

@endsection