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
                
                @if(request('mode') == 'edit')
                    <div class="d-flex gap-2">
                        <button type="submit" form="alumniForm" class="btn btn-dark btn-sm fw-semibold">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                        <a href="{{ route('profile.alumni') }}" class="btn btn-danger btn-sm fw-semibold">
                            <i class="bi bi-x-lg me-1"></i> Batal
                        </a>
                    </div>
                @else
                    <a href="{{ request()->fullUrlWithQuery(['mode' => 'edit']) }}" class="btn btn-outline-primary btn-sm fw-semibold">
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

            <form action="{{ route('profile.alumni.update') }}" method="POST" id="alumniForm" enctype="multipart/form-data">
                @csrf
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                    <div class="card-body p-4 p-md-5">
                        <h5 class="fw-bold mb-1">Informasi Akademik</h5>
                        <p class="text-muted small mb-4">Detail tentang pendidikan dan riwayat akademik Anda</p>
                        
                        <!-- Tahun Angkatan -->
                        <div class="mb-4">
                            <label class="form-label-custom">Tahun Angkatan</label>
                            
                            @if(request('mode') == 'edit')
                                <select class="form-select form-control-custom" id="graduation_year" name="graduation_year" required>
                                    <option value="" disabled>Pilih tahun angkatan</option>
                                    @for($year = 2015; $year <= 2025; $year++)
                                        <option value="{{ $year }}" {{ (old('graduation_year', auth()->user()->graduation_year) == $year) ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            @else
                                <div class="form-control-custom d-flex align-items-center">
                                    <i class="bi bi-calendar me-2 text-muted"></i>
                                    <span class="fw-medium">{{ auth()->user()->graduation_year ?? 'Belum diatur' }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Jurusan / Program Studi -->
                        <div class="mb-4">
                            <label class="form-label-custom">Jurusan / Program Studi</label>
                            
                            @if(request('mode') == 'edit')
                                <select class="form-select form-control-custom" id="study_program" name="study_program" required>
                                    <option value="if" {{ (old('study_program', auth()->user()->study_program) == 'if') ? 'selected' : '' }}>S1-Informatika</option>
                                    <option value="si" {{ (old('study_program', auth()->user()->study_program) == 'si') ? 'selected' : '' }}>S1-Sistem Informasi</option>
                                    <option value="te" {{ (old('study_program', auth()->user()->study_program) == 'te') ? 'selected' : '' }}>S1-Teknik Elektro</option>
                                    <option value="mr" {{ (old('study_program', auth()->user()->study_program) == 'mr') ? 'selected' : '' }}>S1-Manajemen Rekayasa</option>
                                    <option value="tm" {{ (old('study_program', auth()->user()->study_program) == 'tm') ? 'selected' : '' }}>S1-Teknik Metalurgi</option>
                                    <option value="bp" {{ (old('study_program', auth()->user()->study_program) == 'bp') ? 'selected' : '' }}>S1-Teknik Bioproses</option>
                                    <option value="bt" {{ (old('study_program', auth()->user()->study_program) == 'bt') ? 'selected' : '' }}>S1-Bioteknologi</option>
                                    <option value="trpl" {{ (old('study_program', auth()->user()->study_program) == 'trpl') ? 'selected' : '' }}>D4-Teknologi Rekayasa Perangkat Lunak</option>
                                    <option value="ti" {{ (old('study_program', auth()->user()->study_program) == 'ti') ? 'selected' : '' }}>D3-Teknologi Informasi</option>
                                    <option value="nm" {{ (old('study_program', auth()->user()->study_program) == 'nm') ? 'selected' : '' }}>D3-Teknologi Komputer</option>
                                </select>
                            @else
                                <div class="form-control-custom d-flex align-items-center">
                                    <i class="bi bi-mortarboard me-2 text-muted"></i>
                                    <span class="fw-medium">
                                        @if(auth()->user()->study_program)
                                            @switch(auth()->user()->study_program)
                                                @case('if') S1-Informatika @break
                                                @case('si') S1-Sistem Informasi @break
                                                @case('te') S1-Teknik Elektro @break
                                                @case('mr') S1-Manajemen Rekayasa @break
                                                @case('tm') S1-Teknik Metalurgi @break
                                                @case('bp') S1-Teknik Bioproses @break
                                                @case('bt') S1-Bioteknologi @break
                                                @case('trpl') D4-Teknologi Rekayasa Perangkat Lunak @break
                                                @case('ti') D3-Teknologi Informasi @break
                                                @case('nm') D3-Teknologi Komputer @break
                                                @default {{ auth()->user()->study_program }}
                                            @endswitch
                                        @else
                                            Belum diatur
                                        @endif
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                    <div class="card-body p-4 p-md-5">
                        <h5 class="fw-bold mb-1">Bidang Saat Ini</h5>
                        <p class="text-muted small mb-4">Pekerjaan dan bidang yang Anda geluti saat ini</p>
                        
                        <!-- Current Field -->
                        <div class="mb-4">
                            <label class="form-label-custom">Bidang yang Diminati</label>

                            @if(request('mode') == 'edit')
                                <select class="form-select form-control-custom" id="current_field" name="current_field">
                                    <option value="" disabled {{ !old('current_field', auth()->user()->current_field) ? 'selected' : '' }}>Pilih bidang saat ini</option>
                                    <option value="swe" {{ (old('current_field', auth()->user()->current_field) == 'swe') ? 'selected' : '' }}>Software Engineering</option>
                                    <option value="uiux" {{ (old('current_field', auth()->user()->current_field) == 'uiux') ? 'selected' : '' }}>UI/UX Design</option>
                                    <option value="data" {{ (old('current_field', auth()->user()->current_field) == 'data') ? 'selected' : '' }}>Data Science</option>
                                    <option value="product" {{ (old('current_field', auth()->user()->current_field) == 'product') ? 'selected' : '' }}>Product Management</option>
                                    <option value="digital_marketing" {{ (old('current_field', auth()->user()->current_field) == 'digital_marketing') ? 'selected' : '' }}>Digital Marketing</option>
                                    <option value="qa_testing" {{ (old('current_field', auth()->user()->current_field) == 'qa_testing') ? 'selected' : '' }}>QA & Testing</option>
                                    <option value="cybersecurity" {{ (old('current_field', auth()->user()->current_field) == 'cybersecurity') ? 'selected' : '' }}>Cybersecurity</option>
                                    <option value="operations" {{ (old('current_field', auth()->user()->current_field) == 'operations') ? 'selected' : '' }}>Operations</option>
                                    <option value="lainnya" {{ (old('current_field', auth()->user()->current_field) == 'lainnya') ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            @else
                                <div class="form-control-custom d-flex align-items-center">
                                    <i class="bi bi-briefcase me-2 text-muted"></i>
                                    <span class="fw-medium">
                                        @if(auth()->user()->current_field)
                                            @switch(auth()->user()->current_field)
                                                @case('swe') Software Engineering @break
                                                @case('uiux') UI/UX Design @break
                                                @case('data') Data Science @break
                                                @case('product') Product Management @break
                                                @case('digital_marketing') Digital Marketing @break
                                                @case('qa_testing') QA & Testing @break
                                                @case('cybersecurity') Cybersecurity @break
                                                @case('operations') Operations @break
                                                @case('lainnya') Lainnya @break
                                                @default {{ auth()->user()->current_field }}
                                            @endswitch
                                        @else
                                            Belum diatur
                                        @endif
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Pengalaman / Skills -->
                        @if(request('mode') == 'edit')
                            <div class="mb-4">
                                <label class="form-label-custom">Pengalaman & Skills <small class="text-muted">(Pisahkan dengan koma)</small></label>
                                <textarea class="form-control form-control-custom" name="experience" rows="3" placeholder="Deskripsikan pengalaman kerja dan skills yang dimiliki...">{{ old('experience', auth()->user()->experience ?? '') }}</textarea>
                            </div>
                        @else
                            @if(auth()->user()->experience)
                                <div class="mb-4">
                                    <label class="form-label-custom">Pengalaman & Skills</label>
                                    <div class="form-control-custom">
                                        <p class="mb-0">{{ auth()->user()->experience }}</p>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            
            </form>
        </div>
    </main>

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