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
                
                @if(request('mode') == 'edit')
                    <div class="d-flex gap-2">
                        <button type="submit" form="academicForm" class="btn btn-dark btn-sm fw-semibold">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                        <a href="/profile/academic" class="btn btn-danger btn-sm fw-semibold">
                            <i class="bi bi-x-lg me-1"></i> Batal
                        </a>
                    </div>
                @else
                    <a href="/profile/academic?mode=edit" class="btn btn-dark btn-sm fw-semibold">
                        <i class="bi bi-pencil-fill me-1"></i> Edit Profil
                    </a>
                @endif

            </div>

            <form action="#" method="POST" id="academicForm">
                @csrf
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                    <div class="card-body p-4 p-md-5">
                        <h5 class="fw-bold mb-1">Informasi Akademik</h5>
                        <p class="text-muted small mb-4">Detail tentang pendidikan dan program studi Anda</p>
                        
                        <label class="form-label-custom">Jurusan / Program Studi</label>
                        
                        @if(request('mode') == 'edit')
                            <select class="form-select form-control-custom" id="jurusan" name="jurusan" required>
                                <option value="if">S1-Informatika</option>
                                <option value="si" selected>S1-Sistem Informasi</option>
                                <option value="te">S1-Teknik Elektro</option>
                                <option value="mr">S1-Manajemen Rekayasa</option>
                                <option value="tm">S1-Teknik Metalurgi</option>
                                <option value="bp">S1-Teknik Bioproses</option>
                                <option value="bt">S1-Bioteknologi</option>
                                <option value="trpl">D4-Teknologi Rekayasa Perangkat Lunak</option>
                                <option value="ti">D3-Teknologi Informasi</option>
                                <option value="nm">D3-Teknologi Komputer</option>
                            </select>
                        @else
                            <div class="form-control-custom d-flex align-items-center">
                                <i class="bi bi-mortarboard me-2 text-muted"></i>
                                <span class="fw-medium">Sistem Informasi</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 1rem;">
                    <div class="card-body p-4 p-md-5">
                        <h5 class="fw-bold mb-1">Minat & Karir</h5>
                        <p class="text-muted small mb-4">Bidang pekerjaan yang Anda minati</p>
                        
                        <label class="form-label-custom">Minat Karir</label>

                        @if(request('mode') == 'edit')
                            <select class="form-select form-control-custom" id="minat_karir" name="minat_karir">
                                <option value="" disabled>Pilih bidang yang diminati</option>
                                <option value="swe" selected>Software Engineering</option>
                                <option value="uiux">UI/UX Design</option>
                                <option value="data">Data Science</option>
                                <option value="product">Product Management</option>
                                <option value="digital_marketing">Digital Marketing</option>
                                <option value="qa_testing">QA & Testing</option>
                                <option value="cybersecurity">Cybersecurity</option>
                                <option value="operations">Operations</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        @else
                            <div class="form-control-custom d-flex align-items-center">
                                <i class="bi bi-briefcase me-2 text-muted"></i>
                                <span class="fw-medium">Software Development</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                    <div class="card-body p-4 p-md-5">
                        <h5 class="fw-bold mb-1">Skills & Keahlian</h5>
                        <p class="text-muted small mb-4">Skill teknis dan soft skill yang Anda kuasai</p>
                        
                        @if(request('mode') == 'edit')
                            <label class="form-label-custom">Skills <small class="text-muted">(Pisahkan dengan koma)</small></label>
                            <input type="text" class="form-control form-control-custom" name="skills" value="Python, Javascript, C++">
                        @else
                            <div class="d-flex flex-wrap gap-2">
                                <span class="skill-pill">Python</span>
                                <span class="skill-pill">Javascript</span>
                                <span class="skill-pill">C++</span>
                            </div>
                        @endif
                    </div>
                </div>
            
            </form> </div> </main>

@endsection