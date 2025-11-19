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

    <main>

        <section class="bg-del-dark-blue text-white hero-section">
            <div class="container py-5">
                <div class="row align-items-center g-5 py-5">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold lh-tight mb-4">
                            Karir Impianmu Dimulai dari Koneksi Alumni Del
                        </h1>
                        <p class="lead mb-4">
                            Platform yang menghubungkan mahasiswa del dengan alumni del dan perusahaan untuk peluang magang, kerja part-time, dan karir penuh waktu.
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-dark px-4">
                            Masuk ke Akun
                        </a>
                    </div>  
                    
                    <div class="col-lg-6">
                        <img src="{{ asset('images/Plaza_IT_Del.jpg') }}" 
                        alt="Kampus Institut Teknologi Del" 
                        class="img-fluid rounded-3 shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Fitur Unggulan untuk Mahasiswa</h2>
                    <p class="text-muted">Semua yang Anda butuhkan untuk memulai dan membangun karir impian</p>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-light-subtle">
                            <div class="card-body p-4">
                                <i class="bi bi-search fs-2 text-primary mb-3"></i>
                                <h5 class="card-title fw-bold">Cari & Filter Lowongan</h5>
                                <p class="card-text text-muted">Temukan peluang magang, part-time, dan full-time dengan filter berdasarkan lokasi, jurusan, dan keahlian.</p>
                                <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill">Full-time</span>
                                <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill">Part-time</span>
                                <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill">Internship</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-light-subtle">
                            <div class="card-body p-4">
                                <i class="bi bi-person-badge fs-2 text-primary mb-3"></i>
                                <h5 class="card-title fw-bold">Profil Mahasiswa</h5>
                                <p class="card-text text-muted">Buat profil lengkap dengan skill, pengalaman, dan portofolio menarik untuk menarik perhatian rekruter.</p>
                                <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill">skill</span>
                                <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill">portofolio</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm border-light-subtle">
                            <div class="card-body p-4">
                                <i class="bi bi-bookmark-star fs-2 text-primary mb-3"></i>
                                <h5 class="card-title fw-bold">Simpan Lowongan</h5>
                                <p class="card-text text-muted">Bookmark lowongan menarik dan kelola daftar lamaran Anda dalam satu tempat yang mudah diakses.</p>
                                <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill">bookmark</span>
                                <span class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill">organize</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Cerita Sukses Alumni</h2>
                    <p class="text-muted">Dengarkan pengalaman nyata dari alumni Institut Teknologi Del yang telah meraih kesuksesan di berbagai bidang.</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <img src="{{ asset('images/Wanita(gra).jpg') }}" 
                            alt="Grace Panjaitan" 
                            class="mb-3 shadow-sm" 
                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px;">
                            <h5 class="fw-bold mb-0">Grace Panjaitan</h5>
                            <p class="text-muted small">Business Analyst di Ernst & Young</p>
                            <p class="fst-italic">"Dari kampus kecil di Toba, saya berhasil meniti karir sebagai Business Analyst di Singapura."</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="text-center">
                            <img src="{{ asset('images/pria(chen).jpg') }}" 
                            alt="David Chen" 
                            class="mb-3 shadow-sm" 
                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px;">
                            <h5 class="fw-bold mb-0">David Chen</h5>
                            <p class="text-muted small">Product Manager di Tokopedia</p>
                            <p class="fst-italic">“Siapa sangka, berawal dari bangku kuliah di Del, sekarang saya bisa duduk di posisi Product Manager di Tokopedia. Perjalanan yang sederhana, tapi penuh makna.”</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="text-center">
                            <img src="{{ asset('images/mich.jpg') }}" 
                            alt="Michael H. Situmorang" 
                            class="mb-3 shadow-sm" 
                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px;">
                            <h5 class="fw-bold mb-0">Michael H. Situmorang</h5>
                            <p class="text-muted small">Software Engineer di Shopee</p>
                            <p class="fst-italic">"Kalau dulu begadang di asrama karena tugas, sekarang begadang di Shopee karena kejar project."</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    
    <footer class="py-5 bg-white border-top"> 
    <div class="container"> 
        <div class="row g-4 text-center"> 
            
            <div class="col-md-4"> 
                <h5 class="fw-bold">Contact Us</h5> 
                <ul class="list-unstyled text-muted"> 
                    <li class="mb-2"><i class="bi bi-envelope me-2"></i>careerconnect@del.ac.id</li> 
                    <li class="mb-2"><i class="bi bi-telephone me-2"></i>(0632) 123 456</li> 
                    <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Institut Teknologi Del, Sitoluama</li> 
                </ul> 
            </div> 
            
            <div class="col-md-4"> 
                <h5 class="fw-bold fs-4">CareerConnect</h5> 
                <p class="text-muted"> Menghubungkan mahasiswa dan alumni Institut Teknologi Del dengan peluang terbaik untuk magang, part-time, dan karir penuh waktu. </p> 
            </div> 
            
            <div class="col-md-4"> 
                <h5 class="fw-bold">Dukungan</h5> 
                <p class="text-muted mb-2">Platform ini dikembangkan bersama Institut Teknologi Del.</p> 
                <img src="{{ asset('images/logo del.jpg') }}" alt="Logo Institut Teknologi Del" class="mx-auto d-block footer-logo"> 
            </div> 
        </div> 
    </div> 
</footer>

@endsection