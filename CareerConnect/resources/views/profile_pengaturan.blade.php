@extends('layouts.app')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">
            
            <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">
                <img src="{{ asset('images/logokita.png') }}" 
                     alt="CareerConnect Logo" 
                     style="height: 30px;" 
                     class="ms-2"> CareerConnect
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navDashboard" aria-controls="navDashboard" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navDashboard">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3"><a class="nav-link {{ Request::is('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item mx-3"><a class="nav-link {{ Request::is('recruitment*') ? 'active fw-semibold' : '' }}" href="/recruitment">Recruitment</a></li>
                    <li class="nav-item mx-3"><a class="nav-link {{ Request::is('profile*') ? 'active fw-semibold' : '' }}" href="/profile">My Profile</a></li>
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
                            @auth {{ auth()->user()->name }} @else {{ optional(auth()->user())->name ?? 'Kevin Gultom' }} @endauth
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('favorit') }}"><i class="bi bi-bookmark-fill me-2"></i> Favorit Anda</a></li>
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
            </div>

            <!-- Card Ubah Password -->
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                <div class="card-body p-4 p-md-5">
                    <h5 class="fw-bold mb-1">Keamanan Akun</h5>
                    <p class="text-muted small mb-4">Kelola password dan keamanan akun Anda</p>
                    
                    @if(auth()->user()->isGoogleUser())
                        @if(session('password_set'))
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle me-2"></i> Password sudah diatur! Anda bisa login dengan email dan password.
                            </div>
                        @else
                            <button class="btn btn-light border fw-semibold" data-bs-toggle="modal" data-bs-target="#setPasswordModal">
                                <i class="bi bi-key me-1"></i> Atur Password
                            </button>
                            <p class="text-muted small mt-2">Akun Anda login via Google. Atur password untuk bisa login dengan email dan password juga.</p>
                        @endif
                    @else
                        <button class="btn btn-light border fw-semibold" data-bs-toggle="modal" data-bs-target="#ubahPasswordModal">
                            <i class="bi bi-key me-1"></i> Ubah Password
                        </button>
                    @endif
                </div>
            </div>
            
            <!-- Card Hapus Akun -->
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                <div class="card-body p-4 p-md-5">
                    <h5 class="fw-bold mb-1 text-danger">Data & Privasi</h5>
                    <p class="text-muted small mb-4">Kontrol data pribadi dan pengaturan privasi</p>
                    
                    <!-- Form Hapus Akun -->
                    <form action="{{ route('profile.delete-account') }}" method="POST" onsubmit="return confirm('PERINGATAN KERAS:\n\nApakah Anda yakin ingin menghapus akun ini secara permanen?\n\nSemua data Anda akan hilang dan tidak dapat dikembalikan.');">
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit" class="btn btn-danger fw-semibold">
                            <i class="bi bi-trash me-1"></i> Hapus Akun
                        </button>
                    </form>

                </div>
            </div>

        </div> 
    </main>

    <!-- Modal Ubah Password -->
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
                            <button type="submit" class="btn btn-masuk text-white fw-semibold py-2">Simpan Password</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Modal Atur Password (untuk Google users) -->
    <div class="modal fade" id="setPasswordModal" tabindex="-1" aria-labelledby="setPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 1rem; border: 0;">
                
                <div class="modal-header border-0 text-center d-block pb-0">
                    <h4 class="modal-title fw-bold" id="setPasswordModalLabel">Atur Password</h4>
                    <p class="text-muted small">Buat password untuk login manual dengan email Anda</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 1.5rem; right: 1.5rem;"></button>
                </div>
                
                <div class="modal-body p-4">
                    <form action="{{ route('profile.set-password') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="new_password_1" class="form-label-custom">Password Baru:</label>
                            <input type="password" class="form-control form-control-custom" id="new_password_1" name="new_password" placeholder="••••••••" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label-custom">Konfirmasi Password Baru:</label>
                            <input type="password" class="form-control form-control-custom" id="new_password_confirmation" name="new_password_confirmation" placeholder="••••••••" required>
                        </div>
                        
                        <div class="alert alert-info small">
                            <i class="bi bi-info-circle me-2"></i> Setelah password diatur, Anda bisa login dengan email: <strong>{{ auth()->user()->email }}</strong>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-masuk text-white fw-semibold py-2">Atur Password</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

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