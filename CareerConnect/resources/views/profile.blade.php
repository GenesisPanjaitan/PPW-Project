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
                    @if(auth()->user()->role === 'alumni')
                        <a href="/profile/alumni" class="tab-link {{ Request::is('profile/alumni') ? 'active' : '' }}">Akademik & Karir</a>
                    @else
                        <a href="/profile/academic" class="tab-link {{ Request::is('profile/academic') ? 'active' : '' }}">Akademik & Karir</a>
                    @endif
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
                    <a href="/profile?mode=edit" class="btn btn-outline-primary btn-sm fw-semibold">
                        <i class="bi bi-pencil me-1"></i> Edit Profil
                    </a>
                @endif
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Form Profile (Ditambah enctype untuk upload gambar) -->
            <form action="{{ route('profile.update') }}" method="POST" id="profileForm" enctype="multipart/form-data">
                @csrf
                
                <div class="text-center mb-4">
                    <h5 class="fw-bold">Foto Profil</h5>
                    <p class="text-muted small">Upload foto profil untuk membantu orang mengenal Anda</p>
                    
                    <!-- AREA FOTO PROFIL (UPDATED) -->
                    <!-- Menambahkan overflow-hidden agar gambar tidak keluar dari lingkaran -->
                    <div class="avatar-placeholder mx-auto d-flex align-items-center justify-content-center position-relative overflow-hidden">
                        
                        @if(auth()->user()->image)
                            @php
                                // Cek apakah image adalah URL eksternal (dari Google) atau file lokal
                                $imageUrl = filter_var(auth()->user()->image, FILTER_VALIDATE_URL) 
                                    ? auth()->user()->image 
                                    : asset('storage/profile_photos/' . auth()->user()->image);
                            @endphp
                            <!-- Gambar Existing dari Database atau Google -->
                            <img id="avatarPreview" src="{{ $imageUrl }}" alt="Profile Photo" class="w-100 h-100" style="object-fit: cover;">
                            <!-- Icon User (Sembunyi jika ada gambar) -->
                            <i id="avatarInitial" class="bi bi-person-fill d-none" style="font-size: 3rem; color: #6c757d;"></i>
                        @else
                            <!-- 1. Gambar Preview (Default Sembunyi) -->
                            <img id="avatarPreview" src="#" alt="Preview" class="d-none w-100 h-100" style="object-fit: cover;">
                            <!-- 2. Icon User Default (Pengganti huruf K) -->
                            <i id="avatarInitial" class="bi bi-person-fill" style="font-size: 3rem; color: #6c757d;"></i>
                        @endif
                        
                    </div>
                    
                    <!-- LOGIC UPLOAD FOTO -->
                    @if(request('mode') == 'edit')
                        <!-- Input File Tersembunyi -->
                        <input type="file" id="fileInput" name="image" class="d-none" accept="image/*" onchange="previewImage(event)">
                        
                        <!-- Label sebagai Tombol -->
                        <label for="fileInput" class="btn btn-dark btn-sm fw-semibold mt-3" style="cursor: pointer;">
                            <i class="bi bi-upload me-1"></i> Upload Foto
                        </label>
                    @endif
                    
                    <!-- Tombol Lihat Foto -->
                    @if(auth()->user()->image)
                        <button type="button" class="btn btn-outline-secondary btn-sm fw-semibold mt-2" data-bs-toggle="modal" data-bs-target="#photoModal">
                            <i class="bi bi-eye me-1"></i> Lihat Foto
                        </button>
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
                                    <input type="text" class="form-control form-control-custom" name="name" value="{{ old('name', auth()->user()->name ?? '') }}">
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
                                    <input type="text" class="form-control form-control-custom" name="contact" value="{{ old('contact', auth()->user()->contact ?? '') }}">
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

            <!-- Modal Lihat Foto Profil -->
            <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold" id="photoModalLabel">
                                <i class="bi bi-person-circle me-2 text-primary"></i>Foto Profil
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center p-4">
                            @if(auth()->user()->image)
                                <div class="photo-container mb-3">
                                    <img src="{{ asset('storage/profile_photos/' . auth()->user()->image) }}" 
                                         alt="Foto Profil {{ auth()->user()->name }}" 
                                         class="img-fluid rounded shadow" 
                                         style="max-height: 400px; max-width: 100%; object-fit: cover;">
                                </div>
                                <h6 class="fw-bold mb-1">{{ auth()->user()->name }}</h6>
                                <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                            @endif
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                                <i class="bi bi-x me-1"></i> Tutup
                            </button>
                            @if(request('mode') != 'edit')
                                <a href="/profile?mode=edit" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil me-1"></i> Edit Foto
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
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
                output.style.display = 'block';    // Pastikan gambar terlihat
                initial.classList.add('d-none');   // Sembunyikan icon user
                initial.style.display = 'none';    // Sembunyikan icon user
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

<style>
    /* Form Styling */
    .form-control-custom {
        border-radius: 0.75rem !important;
        border: 1px solid #dee2e6;
        padding: 0.75rem 1rem;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }
    
    .form-control-custom:focus {
        border-color: #6b5ce7;
        box-shadow: 0 0 0 0.2rem rgba(107, 92, 231, 0.25);
        background-color: #fff;
    }
    
    .form-label-custom {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    /* Tab Navigation Styling */
    .profile-tabs-container {
        display: flex;
        gap: 0.5rem;
        background: #f8f9fa;
        padding: 0.375rem;
        border-radius: 0.75rem;
        border: 1px solid #e9ecef;
        position: relative;
    }
    
    .tab-link {
        padding: 0.5rem 1rem;
        text-decoration: none;
        color: #6c757d;
        font-weight: 500;
        border-radius: 0.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
        position: relative;
        z-index: 2;
    }
    
    .tab-link:hover {
        color: #495057;
        background-color: #e9ecef;
        transform: translateY(-1px);
    }
    
    .tab-link.active {
        background-color: white;
        color: #6b5ce7;
        box-shadow: 0 4px 12px rgba(107, 92, 231, 0.15);
        font-weight: 600;
        transform: translateY(-2px);
    }
    
    /* Card Animation */
    .card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    /* Button Animations */
    .btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 0.5rem;
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .btn:active {
        transform: translateY(0);
    }
    
    /* Alert Animation */
    .alert {
        animation: slideInDown 0.5s ease-out;
        border-radius: 0.75rem;
    }
    
    @keyframes slideInDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    /* Form Input Animation */
    .form-select, .form-control {
        transition: all 0.3s ease;
    }
    
    .form-select:focus, .form-control:focus {
        transform: scale(1.02);
    }
    
    /* Avatar Upload Animation */
    .avatar-container {
        transition: all 0.3s ease;
    }
    
    .avatar-container:hover {
        transform: scale(1.05);
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-tabs-container {
            flex-direction: column;
            width: 100%;
        }
        
        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }
        
        .card {
            margin-bottom: 1rem;
        }
        
        .tab-link:hover,
        .tab-link.active {
            transform: none;
        }
    }
</style>

@endsection