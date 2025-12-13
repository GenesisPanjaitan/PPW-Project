@extends('layouts.guest')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm navbar-section">
    <div class="container">
        
       <a class="navbar-brand fw-bold fs-4" href="/">
           <img src="{{ asset('images/logokita.png') }}" 
                alt="CareerConnect Logo" 
                style="height: 30px;" 
                class="ms-2"> CareerConnect
       </a>

       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
       </button>
       
       <div class="collapse navbar-collapse" id="navbarNav">
           <div class="navbar-nav ms-auto">
               <a href="{{ route('login') }}" class="btn btn-light btn-sm px-4 py-2 me-2 mb-2 mb-lg-0 rounded-pill fw-semibold">Login</a>
               
               <a href="{{ route('register') }}" class="btn btn-dark btn-sm px-4 py-2 rounded-pill fw-semibold">Register</a>
           </div>
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

        {{-- Fitur Unggulan CareerConnect --}}
        <section class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Fitur Unggulan CareerConnect</h2>
                    <p class="text-muted">Manfaatkan semua fitur yang tersedia untuk kesuksesan karirmu</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm feature-card border-0">
                            <div class="card-body text-center p-4">
                                <div class="icon-circle-large bg-primary bg-opacity-10 text-primary mx-auto mb-3">
                                    <i class="bi bi-briefcase-fill fs-3"></i>
                                </div>
                                <h6 class="fw-bold mb-2">Lowongan Kerja & Magang</h6>
                                <p class="small text-muted mb-3">Temukan ribuan lowongan pekerjaan dan magang dari berbagai perusahaan terkemuka.</p>
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm rounded-pill">Jelajahi Lowongan</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm feature-card border-0">
                            <div class="card-body text-center p-4">
                                <div class="icon-circle-large bg-success bg-opacity-10 text-success mx-auto mb-3">
                                    <i class="bi bi-bookmark-fill fs-3"></i>
                                </div>
                                <h6 class="fw-bold mb-2">Simpan Favorit</h6>
                                <p class="small text-muted mb-3">Tandai lowongan favorit untuk dilamar nanti dan kelola daftar lamaran kamu.</p>
                                <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm rounded-pill">Lihat Favorit</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm feature-card border-0">
                            <div class="card-body text-center p-4">
                                <div class="icon-circle-large bg-warning bg-opacity-10 text-warning mx-auto mb-3">
                                    <i class="bi bi-person-circle fs-3"></i>
                                </div>
                                <h6 class="fw-bold mb-2">Profil Profesional</h6>
                                <p class="small text-muted mb-3">Buat dan kelola profil profesionalmu untuk meningkatkan peluang dilirik recruiter.</p>
                                <a href="{{ route('login') }}" class="btn btn-outline-warning btn-sm rounded-pill">Edit Profil</a>
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
    
    <footer class="footer-welcome py-5">
        <div class="container">
            <div class="row g-4">
                <!-- About Section -->
                <div class="col-lg-5 col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/logokita.png') }}" alt="CareerConnect Logo" style="height: 35px;" class="me-2">
                        <h5 class="fw-bold mb-0 text-dark">CareerConnect</h5>
                    </div>
                    <p class="text-muted mb-3" style="line-height: 1.7;">
                        Platform yang menghubungkan mahasiswa dan alumni Institut Teknologi Del dengan peluang karir terbaik. Temukan lowongan pekerjaan, magang, dan peluang pengembangan karir Anda bersama kami.
                    </p>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt-fill text-muted"></i>
                        <span class="text-muted small">Institut Teknologi Del, Sitoluama, Laguboti</span>
                    </div>
                </div>

                <!-- Dukungan -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3 text-dark">Dukungan</h6>
                    <p class="text-muted mb-3 small">
                        Platform ini dikembangkan bersama Institut Teknologi Del untuk mendukung mahasiswa dan alumni dalam pengembangan karir.
                    </p>
                    <img src="{{ asset('images/logo del.jpg') }}" alt="Logo Institut Teknologi Del" class="footer-logo-del">
                </div>

                <!-- Social Media & Contact -->
                <div class="col-lg-4 col-md-12">
                    <h6 class="fw-bold mb-3 text-dark">Hubungi Kami</h6>
                    <p class="text-muted mb-3 small">
                        Ikuti media sosial kami untuk mendapatkan update lowongan terbaru dan informasi karir lainnya.
                    </p>
                    <div class="d-flex gap-3 mb-3">
                        <a href="https://www.instagram.com/kevgtm" target="_blank" class="social-icon">
                            <i class="bi bi-instagram fs-5"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/kevin-gultom-889982322/" target="_blank" class="social-icon">
                            <i class="bi bi-linkedin fs-5"></i>
                        </a>
                        <a href="https://web.facebook.com/Institut.Teknologi.Del/?_rdc=1&_rdr#" target="_blank" class="social-icon">
                            <i class="bi bi-facebook fs-5"></i>
                        </a>
                        <a href="mailto:info@careerconnect.del.ac.id" class="social-icon">
                            <i class="bi bi-envelope-fill fs-5"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-envelope text-muted"></i>
                        <span class="text-muted small">careerconnect@del.ac.id</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-telephone text-muted"></i>
                        <span class="text-muted small">(0632) 123 456</span>
                    </div>
                </div>
            </div>

            <div class="footer-divider my-4"></div>

            <!-- Copyright -->
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-muted small">
                        &copy; {{ date('Y') }} CareerConnect - Institut Teknologi Del. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 text-muted small">
                        Made with <i class="bi bi-heart-fill text-danger"></i> by IT Del Students
                    </p>
                </div>
            </div>
        </div>
    </footer>

{{-- Inline styles khusus landing/pre-login --}}
<style>
    body {
        background: linear-gradient(135deg, #f8f9fa 0%, #eef2ff 100%);
    }

    .navbar-section {
        position: sticky;
        top: 0;
        z-index: 1050;
        backdrop-filter: blur(8px);
    }

    .hero-section {
        position: relative;
        overflow: hidden;
        border-radius: 1.5rem;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        top: -30%;
        right: -10%;
        width: 420px;
        height: 420px;
        background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 65%);
        animation: float 8s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    .stat-strip {
        margin-top: -40px;
        margin-bottom: 40px;
    }

    .stat-item {
        background: #fff;
        border-radius: 14px;
        padding: 18px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(13,110,253,0.15);
    }

    .stat-label { color: #6c757d; font-weight: 600; font-size: 0.9rem; }
    .stat-value { color: #0d6efd; font-weight: 800; }

    .card {
        border-radius: 16px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(0,0,0,0.08);
    }

    .feature-card {
        border-radius: 1rem;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15) !important;
    }

    .icon-circle-large {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .partners-section {
        background: #fff;
        border-radius: 14px;
    }

    .partner-logo {
        height: 40px;
        object-fit: contain;
        filter: grayscale(1);
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    .partner-logo:hover {
        filter: grayscale(0);
        opacity: 1;
    }

    .cta-band {
        background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
        color: white;
        padding: 32px 0;
        border-radius: 16px;
        margin: 0 12px 48px;
        box-shadow: 0 18px 45px rgba(0,0,0,0.12);
    }

    /* Footer Styles */
    .footer-welcome {
        background: #ffffff;
        color: #333;
        margin-top: 100px;
        border-top: 1px solid #e0e0e0;
    }
    .footer-welcome a {
        color: #666;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .footer-welcome a:hover {
        color: #333;
        transform: translateX(5px);
    }
    .social-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        color: #667eea;
    }
    .social-icon:hover {
        background: #667eea;
        transform: translateY(-5px);
        color: white;
    }
    .footer-divider {
        height: 1px;
        background: #e0e0e0;
    }
    .footer-logo-del {
        max-width: 80px;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
    }
</style>

@endsection