<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerConnect - Alumni Del</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* == Hero & Footer Styles == */
        :root {
            --del-dark-blue: #2A2F4F;
            --primary-blue: #0d6efd;
        }
        .bg-del-dark-blue {
            background-color: var(--del-dark-blue);
        }
        
        /* --- Style Hero Section Baru (Slideshow Card) --- */
        .hero-wrapper {
            padding: 1.5rem 0;
            background-color: #F8F7FF; /* Menyesuaikan warna body */
        }

        .hero-section {
            position: relative;
            height: 500px;
            width: 100%;
            overflow: hidden;
            border-radius: 20px; /* Membuat sudut membulat penuh */
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* Background Slideshow Images */
        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            z-index: 0;
        }
        
        .hero-bg.active {
            opacity: 1;
        }

        /* Kotak Gelap di Tengah (Overlay) */
        .hero-card-overlay {
            position: relative;
            z-index: 2;
            background-color: rgba(23, 23, 23, 0.85);
            border-radius: 20px;
            padding: 3rem 2rem;
            max-width: 800px;
            width: 90%;
            text-align: center;
            color: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            backdrop-filter: blur(2px);
        }

        .text-highlight {
            color: #0d6efd; /* Biru Bootstrap */
            font-weight: 800;
        }

        .footer-logo {
            height: 80px;
        }
        @media (min-width: 768px) {
            .footer-text-left {
                text-align: left !important;
            }
        }

        /* == Navbar Styles == */
        .navbar-section {
            background-color: #F8F7FF; /* Warna lavender sangat muda */
            border-bottom: 1px solid #E0E0E0;
        }
        .btn-login-nav {
            background-color: #EFEFEF;
            color: #000;
            font-weight: 600;
        }
        .btn-login-nav:hover {
            background-color: #dcdcdc;
            color: #000;
        }
        .btn-register-nav {
            background-color: #000;
            color: #FFF;
            font-weight: 600;
        }
        .btn-register-nav:hover {
            background-color: #333;
            color: #FFF;
        }
        .navbar-brand-custom {
            font-weight: 700; 
            font-size: 1.5rem; 
            color: #000; 
        }

        /* == Halaman Register == */
        .register-card {
            border: 1px solid #E0E0E0;
            border-radius: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .account-type-box {
            border: 1px solid #E0E0E0;
            border-radius: 0.75rem;
            padding: 1.5rem;
            transition: all 0.2s ease-in-out;
            color: #333;
        }
        .account-type-box:hover {
            border-color: #3B49DF;
            background-color: #F8F7FF;
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .account-type-box h6 {
            font-weight: 700;
        }
        .link-login {
            color: #000;
            font-weight: 700;
            text-decoration: none;
        }
        .link-login:hover {
            text-decoration: underline;
        }

        /* == Styles Form (Login, Register) == */
        .form-control-custom {
            background-color: #F3F4F6;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
        }
        .form-control-custom:focus {
            background-color: #F3F4F6;
            box-shadow: 0 0 0 2px #3B49DF; 
        }
        .form-select.form-control-custom {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23333' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px 12px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        .btn-masuk {
            background-color: #3B49DF;
            border: none;
            font-weight: 600;
            padding: 0.75rem;
            border-radius: 0.5rem;
        }
        .btn-masuk:hover {
            background-color: #2F3AB2;
        }
        .form-label-custom {
            font-weight: 600;
            color: #333;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }
                
        /* == Halaman Home (Dashboard) == */
        body {
            background-color: #F8F7FF; /* Latar belakang lavender muda */
        }
        .alert-welcome {
            position: fixed;
            top: 20px; 
            left: 50%;
            transform: translateX(-50%);
            width: auto;
            z-index: 1050; 
            background-color: #E6F7F0;
            color: #097B4B;
            font-weight: 500;
            padding: 0.75rem 1.25rem; 
            font-size: 0.9rem; 
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: opacity 0.5s ease-out, top 0.5s ease-out, transform 0.5s ease-out;
        }
        .alert-welcome .bi {
            font-size: 1.1rem !important;
        }
        .profile-card {
            background-color: #ECEBFE; 
            border-radius: 1rem;
        }
        .skill-tag {
            background-color: #DCD9FE; 
            color: #3B49DF;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .btn-edit-profile {
            background-color: #FFFFFF;
            color: #3B49DF;
            font-weight: 600;
            border-radius: 0.5rem;
        }
        .btn-edit-profile:hover {
            background-color: #f0f0f0;
        }
        .job-card {
            background-color: #E4F1FF; 
            border-radius: 0.75rem;
            color: #052C65;
            transition: transform 0.2s ease, box-shadow 0.2s ease; /* Animasi hover */
        }
        .job-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .btn-bookmark {
            color: #052C65;
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 0.5rem;
        }
        .btn-bookmark:hover {
            background-color: #FFFFFF;
            color: #052C65;
        }
        .job-card .badge {
            color: #052C65;
            font-weight: 500;
            font-size: 0.75rem;
            padding: 6px 10px;
        }
        .job-badge-internship { background-color: #C7E4FF; }
        .job-badge-part-time { background-color: #DFFFEA; }
        .job-badge-full-time { background-color: #FCE8D5; }
        
        /* == Navbar Menu Aktif == */
        .navbar-nav .nav-link {
            border-bottom: 3px solid transparent;
            padding-bottom: 5px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        
        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover {
            color: #667eea !important;
            transform: translateY(-2px);
        }
        
        .navbar-nav .nav-link:hover::before {
            width: 100%;
        }
        
        .navbar-nav .nav-link.active {
            color: #3B49DF !important; 
            border-bottom: 3px solid #3B49DF;
            font-weight: 600;
        }
        
        .navbar-nav .nav-link.active::before {
            width: 100%;
        }

        /* == Halaman Profil == */
        .profile-tabs-container {
            background-color: #EFEFEF;
            padding: 0.5rem;
            border-radius: 999px;
            display: flex;
            gap: 0.5rem;
        }
        .tab-link {
            padding: 0.5rem 1.25rem;
            border-radius: 999px;
            text-decoration: none;
            color: #555;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .tab-link:hover {
            background-color: #e0e0e0;
            color: #111;
        }
        .tab-link.active {
            background-color: #FFFFFF;
            color: #111;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .avatar-placeholder {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background-color: #E0E0E0;
            color: #555;
        }
        .skill-pill {
            background-color: #F3F4F6;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: #333;
        }
        .text-header-blue { 
            color: #4F6BF0; 
        }
        .job-info-card {
            background-color: #EBE9FF; 
            border-radius: 1rem;
            border: none;
            color: #333;
        }
        .comment-bubble {
            background-color: #F3F4F6; 
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .input-comment {
            background-color: #F3F4F6;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
        }
        .input-comment:focus {
            background-color: #fff;
            box-shadow: 0 0 0 2px #ddd;
        }
        .btn-send-comment {
            background-color: #9CA3AF;
            color: white;
            border-radius: 0.5rem;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
        }
        .btn-send-comment:hover {
            background-color: #6B7280;
            color: white;
        }
        .img-building {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Warna Judul Utama */
        .text-recruitment-blue { color: #4F6BF0; }
        
        /* Input Search & Filter */
        .bg-input-gray { background-color: #F3F4F6; border: none; color: #666; }
        .bg-input-gray:focus { background-color: #fff; border: 1px solid #ddd; box-shadow: none; }

        /* Kotak Lowongan */
        .job-box {
            background-color: #EEF2FF;
            border-radius: 1rem;
            border: none;
        }

        /* Badge Tipe Job */
        .badge-job-cream {
            background-color: #FFF7E2;
            color: #B45309;
            font-weight: 600;
            font-size: 0.75rem;
            border-radius: 0.5rem;
            padding: 4px 10px;
        }

        /* Tombol Lihat Detail */
        .btn-detail-gray {
            background-color: #E5E7EB;
            color: #374151;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 16px; 
            border-radius: 6px;
            border: none;
            text-decoration: none; 
            display: inline-block;
            transition: all 0.2s ease-in-out; 
        }

        /* Efek Hover */
        .btn-detail-gray:hover {
            background-color: #d1d5db; 
            color: #000; 
            transform: translateY(-1px); 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
            cursor: pointer; 
        }

        /* Komentar Box */
        .comment-box {
            background-color: #F3F4F6;
            border-radius: 0.75rem;
            padding: 12px;
            margin-bottom: 10px;
        }

        /* Tombol Aksi */
        .btn-action-gray {
            background-color: #9CA3AF;
            color: white;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 8px;
            padding: 6px 16px;
            border: none;
        }
        .btn-action-gray:hover { background-color: #6B7280; color: white; }

        .btn-action-red {
            background-color: #EF4444;
            color: white;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 8px;
            padding: 6px 16px;
            border: none;
        }
        .btn-action-red:hover { background-color: #DC2626; color: white; }

        .btn-upload-foto {
            background-color: #F3F4F6;
            border: none;
            color: #333;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
        }
        .btn-upload-foto:hover {
            background-color: #E5E7EB;
        }

        /* Tombol Posting */
        .btn-posting-black {
            background-color: #9CA3AF; 
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.6rem 2rem;
            border-radius: 999px;
            border: none;
        }
        .btn-posting-black:hover {
            background-color: #6B7280; 
        }

        /* Style tambahan untuk Recruitment Page */
        
        /* === [UPDATE ANIMASI HOVER KARTU] === */
        .hover-scale:hover {
            transform: scale(1.02);
            transition: transform 0.2s;
        }

        /* Class utama animasi untuk kartu lowongan */
        .hover-shadow {
            cursor: pointer; /* Mengubah kursor jadi jari telunjuk */
            transition: all 0.3s ease-in-out;
            border: 1px solid transparent; /* Supaya saat hover bordernya smooth */
        }

        .hover-shadow:hover {
            transform: translateY(-7px) scale(1.01); /* Naik ke atas + Sedikit membesar */
            box-shadow: 0 15px 35px rgba(13, 110, 253, 0.15) !important; /* Bayangan lebih soft dan besar */
            border-color: #0d6efd !important; /* Border berubah jadi biru */
            z-index: 5; /* Agar muncul di atas elemen lain */
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .upload-area {
            border: 2px dashed #e0e0e0;
            background-color: #f8f9fa;
            position: relative;
            transition: all 0.3s;
            cursor: pointer;
        }

        .upload-area:hover {
            border-color: #0d6efd;
            background-color: #f1f5ff;
        }

        .file-input-hidden {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        /* Mengatur style kotak dropdown */
        .navbar-nav .dropdown-menu {
            background-color: #F8F7FF;
            border: 1px solid #E0E0E0;
            border-radius: 0.75rem; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 0.5rem 0;
            transform-origin: top center;
            animation: dropdownSlideIn 0.3s ease-out;
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
        }
        
        .navbar-nav .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        
        @keyframes dropdownSlideIn {
            0% {
                opacity: 0;
                transform: translateY(-20px) scale(0.9);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        /* Mengatur style item di dalam dropdown */
        .navbar-nav .dropdown-item {
            color: #333;
            font-weight: 500;
            padding: 0.6rem 1.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .navbar-nav .dropdown-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .navbar-nav .dropdown-item:hover {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.1) 0%, transparent 100%);
            color: #667eea;
            padding-left: 1.5rem;
            transform: translateX(5px);
        }
        
        .navbar-nav .dropdown-item:hover::before {
            transform: scaleY(1);
        }
        
        .navbar-nav .dropdown-item i {
            color: #6B7280;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .dropdown-item:hover i {
            color: #667eea;
            transform: scale(1.2);
        }
        
        .navbar-nav .dropdown-item.active {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.15) 0%, rgba(102, 126, 234, 0.05) 100%);
            color: #667eea;
            font-weight: 600;
        }
        
        /* Animasi untuk dropdown divider */
        .navbar-nav .dropdown-divider {
            margin: 0.5rem 0;
            border-color: rgba(0, 0, 0, 0.08);
            animation: expandWidth 0.4s ease-out;
        }
        
        @keyframes expandWidth {
            0% {
                transform: scaleX(0);
            }
            100% {
                transform: scaleX(1);
            }
        }
        
        /* Animasi toggle dropdown */
        .navbar-nav .nav-link.dropdown-toggle {
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link.dropdown-toggle[aria-expanded="true"] {
            color: #667eea !important;
        }
        
        .navbar-nav .nav-link.dropdown-toggle::after {
            transition: transform 0.3s ease;
        }
        
        .navbar-nav .nav-link.dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }

        /* Animasi Tombol Bookmark */
        .btn-bookmark-anim {
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            z-index: 10;
            background-color: white;
        }

        .btn-bookmark-anim:hover {
            transform: scale(1.25);
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            color: white;
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
            cursor: pointer;
        }
    </style>

</head>
<body>

    {{-- Success Toast Notifications --}}
    @if(session('login_success'))
    <div id="loginToast" class="position-fixed top-0 start-50 translate-middle-x" style="margin-top: 70px; z-index: 9999;">
        <div class="card border-0 shadow-lg" style="border-radius: 12px; background: rgba(16, 185, 129, 0.95); min-width: 320px; animation: slideInDown 0.4s ease-out;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255, 255, 255, 0.3); display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                        <i class="bi bi-check-circle-fill text-white" style="font-size: 22px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="text-white mb-0 fw-semibold" style="font-size: 0.9rem;">
                            Berhasil login sebagai {{ auth()->check() ? (auth()->user()->role === 'mahasiswa' ? 'mahasiswa' : (auth()->user()->role === 'alumni' ? 'alumni' : 'admin')) : 'pengguna' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('register_success'))
    <div id="registerToast" class="position-fixed" style="top: 30px; right: 30px; z-index: 9999;">
        <div class="card border-0 shadow-lg" style="border-radius: 15px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); min-width: 360px; animation: slideInDown 0.4s ease-out;">
            <div class="card-body p-4">
                <div class="d-flex align-items-start">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(255, 255, 255, 0.2); display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                        <i class="bi bi-check-circle-fill text-white" style="font-size: 28px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="text-white fw-bold mb-1" style="font-size: 1.05rem;">Registrasi Berhasil! 🎊</h6>
                        <p class="text-white mb-0 opacity-90" style="font-size: 0.95rem;">
                            Selamat bergabung <strong>{{ session('user_name') }}</strong> sebagai {{ session('user_role') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('post_success'))
    <div id="postJobToast" class="position-fixed top-0 start-50 translate-middle-x" style="margin-top: 20px; z-index: 9999;">
        <div class="card border-0 shadow-lg" style="border-radius: 12px; background: rgba(16, 185, 129, 0.95); min-width: 320px; animation: slideInDown 0.4s ease-out;">
            <div class="card-body p-3">
                <div class="d-flex align-items-start">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255, 255, 255, 0.3); display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                        <i class="bi bi-check-circle-fill text-white" style="font-size: 22px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="text-white fw-bold mb-1" style="font-size: 0.9rem;">Lowongan Berhasil Diposting! 🚀</h6>
                        <p class="text-white mb-0 opacity-90" style="font-size: 0.8rem;">
                            <strong>{{ session('job_position') ?? 'Posisi' }}</strong> di {{ session('job_company') ?? 'Perusahaan' }}
                        </p>
                    </div>
                    <button type="button" class="btn-close btn-close-white ms-2" style="opacity: 0.7;" onclick="document.getElementById('postJobToast').style.animation='slideOutUp 0.3s ease-in'; setTimeout(() => document.getElementById('postJobToast').remove(), 300);"></button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('delete_success'))
    <div id="deleteJobToast" class="position-fixed top-0 start-50 translate-middle-x" style="margin-top: 20px; z-index: 9999;">
        <div class="card border-0 shadow-lg" style="border-radius: 12px; background: rgba(239, 68, 68, 0.95); min-width: 320px; animation: slideInDown 0.4s ease-out;">
            <div class="card-body p-3">
                <div class="d-flex align-items-start">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255, 255, 255, 0.3); display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                        <i class="bi bi-trash-fill text-white" style="font-size: 22px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="text-white fw-bold mb-1" style="font-size: 0.9rem;">Lowongan Berhasil Dihapus!</h6>
                        <p class="text-white mb-0 opacity-90" style="font-size: 0.8rem;">
                            Posting lowongan telah dihapus dari sistem
                        </p>
                    </div>
                    <button type="button" class="btn-close btn-close-white ms-2" style="opacity: 0.7;" onclick="document.getElementById('deleteJobToast').style.animation='slideOutUp 0.3s ease-in'; setTimeout(() => document.getElementById('deleteJobToast').remove(), 300);"></button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Auto-close notifications after timeout
        document.addEventListener('DOMContentLoaded', function() {
            // Login success notification - 3 seconds
            const loginToast = document.getElementById('loginToast');
            if (loginToast) {
                setTimeout(function() {
                    loginToast.style.animation = 'slideOutUp 0.3s ease-in';
                    setTimeout(() => loginToast.remove(), 300);
                }, 3000);
            }

            // Post job success notification - 5 seconds
            const postJobToast = document.getElementById('postJobToast');
            if (postJobToast) {
                setTimeout(function() {
                    postJobToast.style.animation = 'slideOutUp 0.3s ease-in';
                    setTimeout(() => postJobToast.remove(), 300);
                }, 5000);
            }

            // Delete job success notification - 4 seconds
            const deleteJobToast = document.getElementById('deleteJobToast');
            if (deleteJobToast) {
                setTimeout(function() {
                    deleteJobToast.style.animation = 'slideOutUp 0.3s ease-in';
                    setTimeout(() => deleteJobToast.remove(), 300);
                }, 4000);
            }
        });

        // Handle favorite form submissions via AJAX to avoid full page reload and toggle icon
        document.addEventListener('DOMContentLoaded', function() {
            const favForms = document.querySelectorAll('form.favorite-form');

            // Centralized ensureBookmarkedUI function which will run once on load
            async function ensureBookmarkedUI() {
                let favoriteIds = window.__favoriteIds || [];
                if ((!favoriteIds || favoriteIds.length === 0) && window.location) {
                    try {
                        const resp = await fetch('/debug/my-favorites', { credentials: 'same-origin' });
                        if (resp.ok) {
                            const json = await resp.json().catch(() => null);
                            if (json && Array.isArray(json.my_favorites)) {
                                favoriteIds = json.my_favorites.map(n => Number(n));
                                window.__favoriteIds = favoriteIds;
                            }
                        }
                    } catch (e) {
                        // ignore
                    }
                }

                // Apply classes based on favoriteIds
                document.querySelectorAll('form.favorite-form').forEach(f => {
                    const btn = f.querySelector('button');
                    if (!btn) return;
                    const action = (f.action || '');
                    const m = action.match(/\/favorite\/(\d+)(?:$|\?)/);
                    if (!m) return;
                    const id = Number(m[1]);
                    if (favoriteIds && favoriteIds.includes(id)) {
                        // mark as favorited
                        btn.classList.remove('btn-outline-secondary', 'btn-light', 'border');
                        btn.classList.add('btn-primary');
                        const ic = btn.querySelector('i');
                        if (ic) {
                            ic.classList.remove('bi-bookmark');
                            ic.classList.add('bi-bookmark-fill', 'text-white');
                        }
                        // ensure form will DELETE on next submit
                        if (!f.querySelector('input[name="_method"]')) {
                            const input = document.createElement('input');
                            input.type = 'hidden'; input.name = '_method'; input.value = 'DELETE';
                            f.appendChild(input);
                        } else {
                            f.querySelector('input[name="_method"]').value = 'DELETE';
                        }
                    }
                });
            }

            // Add event listeners to each favorite form
            favForms.forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const submitButton = form.querySelector('button');
                    const icon = submitButton ? submitButton.querySelector('i') : null;
                    const formData = new FormData(form);

                    try {
                        const resp = await fetch(form.action, {
                            method: 'POST',
                            headers: { 'X-Requested-With': 'XMLHttpRequest' },
                            body: formData,
                            credentials: 'same-origin'
                        });

                        if (!resp.ok) {
                            // fallback: submit normally
                            form.submit();
                            return;
                        }

                        const data = await resp.json().catch(() => null);
                        if (!data) { form.submit(); return; }

                        // toggle icon based on action
                        if (data.action === 'stored') {
                            if (icon) {
                                icon.classList.remove('bi-bookmark');
                                icon.classList.add('bi-bookmark-fill', 'text-white');
                            }
                            if (submitButton) {
                                submitButton.classList.remove('btn-light', 'border');
                                submitButton.classList.add('btn-primary');
                            }
                            // ensure form will send DELETE next time
                            if (!form.querySelector('input[name="_method"]')) {
                                const input = document.createElement('input');
                                input.type = 'hidden'; input.name = '_method'; input.value = 'DELETE';
                                form.appendChild(input);
                            } else {
                                form.querySelector('input[name="_method"]').value = 'DELETE';
                            }
                        }
                        else if (data.action === 'deleted') {
                            if (icon) {
                                icon.classList.remove('bi-bookmark-fill', 'text-white');
                                icon.classList.add('bi-bookmark');
                            }
                            if (submitButton) {
                                submitButton.classList.remove('btn-primary');
                                // revert to outlined secondary style used in views
                                submitButton.classList.remove('btn-light', 'border');
                                submitButton.classList.add('btn-outline-secondary');
                            }
                            // ensure method is POST for adding back
                            const methodInput = form.querySelector('input[name="_method"]');
                            if (methodInput) methodInput.value = 'POST';
                        }

                    } catch (err) {
                        console.error('Favorite toggle failed', err);
                        form.submit();
                    }
                });
            });

            // run once on load to ensure bookmark UI is correct
            ensureBookmarkedUI();
        });

        // Auto-show and auto-hide success toasts
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('login_success'))
                // Auto-hide login toast after 5 seconds
                setTimeout(() => {
                    const loginToast = document.getElementById('loginToast');
                    if (loginToast) {
                        loginToast.style.animation = 'slideOutUp 0.3s ease-in';
                        setTimeout(() => loginToast.remove(), 300);
                    }
                }, 5000);
            @endif

            @if(session('register_success'))
                // Auto-hide register toast after 5 seconds
                setTimeout(() => {
                    const registerToast = document.getElementById('registerToast');
                    if (registerToast) {
                        registerToast.style.animation = 'slideOutUp 0.3s ease-in';
                        setTimeout(() => registerToast.remove(), 300);
                    }
                }, 5000);
            @endif

            @if(session('post_success'))
                // Auto-hide posting success toast after 5 seconds
                setTimeout(() => {
                    const postJobToast = document.getElementById('postJobToast');
                    if (postJobToast) {
                        postJobToast.style.animation = 'slideOutUp 0.3s ease-in';
                        setTimeout(() => postJobToast.remove(), 300);
                    }
                }, 5000);
            @endif
        });
    </script>

    <style>
        /* Success Modal Animations */
        @keyframes icon-line-tip {
            0% { width: 0; left: 1px; top: 19px; }
            54% { width: 0; left: 1px; top: 19px; }
            70% { width: 50px; left: -8px; top: 37px; }
            84% { width: 17px; left: 21px; top: 48px; }
            100% { width: 25px; left: 14px; top: 46px; }
        }

        @keyframes icon-line-long {
            0% { width: 0; right: 46px; top: 54px; }
            65% { width: 0; right: 46px; top: 54px; }
            84% { width: 55px; right: 0px; top: 35px; }
            100% { width: 47px; right: 8px; top: 38px; }
        }

        @keyframes icon-circle {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        .modal-content {
            animation: modalSlideIn 0.4s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInUp {
            from {
                transform: translateY(-100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideOutUp {
            from {
                transform: translateY(0);
                opacity: 1;
            }
            to {
                transform: translateY(-100px);
                opacity: 0;
            }
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideOutDown {
            from {
                transform: translateY(0);
                opacity: 1;
            }
            to {
                transform: translateY(100px);
                opacity: 0;
            }
        }

        /* Footer Styles */
        .footer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin-top: 100px;
        }
        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .footer a:hover {
            color: white;
            transform: translateX(5px);
        }
        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .social-icon:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }
        .footer-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
        }
    </style>

    <!-- Footer -->
    <footer class="footer mt-5 py-5">
        <div class="container">
            <div class="row g-4">
                <!-- About Section -->
                <div class="col-lg-5 col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/logokita.png') }}" alt="CareerConnect Logo" style="height: 35px;" class="me-2">
                        <h5 class="fw-bold mb-0">CareerConnect</h5>
                    </div>
                    <p class="text-white-50 mb-3" style="line-height: 1.7;">
                        Platform yang menghubungkan mahasiswa dan alumni Institut Teknologi Del dengan peluang karir terbaik. Temukan lowongan pekerjaan, magang, dan peluang pengembangan karir Anda bersama kami.
                    </p>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-geo-alt-fill text-white-50"></i>
                        <span class="text-white-50 small">Institut Teknologi Del, Sitoluama, Laguboti</span>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3">Menu Cepat</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('home') }}" class="d-flex align-items-center">
                                <i class="bi bi-chevron-right me-2"></i> Home
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('recruitment') }}" class="d-flex align-items-center">
                                <i class="bi bi-chevron-right me-2"></i> Recruitment
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('profile') }}" class="d-flex align-items-center">
                                <i class="bi bi-chevron-right me-2"></i> My Profile
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('favorit') }}" class="d-flex align-items-center">
                                <i class="bi bi-chevron-right me-2"></i> Favorit
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Social Media & Contact -->
                <div class="col-lg-4 col-md-12">
                    <h6 class="fw-bold mb-3">Hubungi Kami</h6>
                    <p class="text-white-50 mb-3 small">
                        Ikuti media sosial kami untuk mendapatkan update lowongan terbaru dan informasi karir lainnya.
                    </p>
                    <div class="d-flex gap-3 mb-3">
                        <a href="https://www.instagram.com/kevgtm" target="_blank" class="social-icon">
                            <i class="bi bi-instagram fs-5"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/kevin-gultom-889982322/" target="_blank" class="social-icon">
                            <i class="bi bi-linkedin fs-5"></i>
                        </a>
                        <a href="https://web.facebook.com/genesis.panjaitan.5" target="_blank" class="social-icon">
                            <i class="bi bi-facebook fs-5"></i>
                        </a>
                        <a href="mailto:info@careerconnect.del.ac.id" class="social-icon">
                            <i class="bi bi-envelope-fill fs-5"></i>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-envelope text-white-50"></i>
                        <span class="text-white-50 small">info@careerconnect.del.ac.id</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-telephone text-white-50"></i>
                        <span class="text-white-50 small">+62 632 331234</span>
                    </div>
                </div>
            </div>

            <div class="footer-divider my-4"></div>

            <!-- Copyright -->
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-white-50 small">
                        &copy; {{ date('Y') }} CareerConnect - Institut Teknologi Del. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 text-white-50 small">
                        Made with <i class="bi bi-heart-fill text-danger"></i> by IT Del Students
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>