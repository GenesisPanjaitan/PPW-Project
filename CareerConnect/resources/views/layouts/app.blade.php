<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerConnect - Alumni Del</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* == Hero & Footer Styles == */
        :root {
            --del-dark-blue: #2A2F4F;
        }
        .bg-del-dark-blue {
            background-color: var(--del-dark-blue);
        }
        .hero-section {
            border-bottom-left-radius: 60px;
            border-bottom-right-radius: 60px;
            overflow: hidden;
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
        }
        .navbar-nav .nav-link.active {
            color: #3B49DF !important; 
            border-bottom: 3px solid #3B49DF; 
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

        <style>
        /* Warna Judul Utama */
        .text-recruitment-blue { color: #4F6BF0; }
        
        /* Input Search & Filter (Background Abu-abu muda) */
        .bg-input-gray { background-color: #F3F4F6; border: none; color: #666; }
        .bg-input-gray:focus { background-color: #fff; border: 1px solid #ddd; box-shadow: none; }

        /* Kotak Lowongan (Ungu Muda) */
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
            padding: 4px 12px;
            border-radius: 6px;
            border: none;
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

        /* Tombol Posting (Hitam & Bulat) */
      .btn-posting-black {
    background-color: #9CA3AF; /* Diubah dari #000 */
    color: #fff;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 0.6rem 2rem;
    border-radius: 999px;
    border: none;
}
.btn-posting-black:hover {
    background-color: #6B7280; /* Diubah dari #333 */
}

/* Mengatur style kotak dropdown */
        .navbar-nav .dropdown-menu {
            background-color: #F8F7FF;
            border: 1px solid #E0E0E0;
            border-radius: 0.75rem; /* Membuatnya bulat */
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 0.5rem 0;
        }
        
        /* Mengatur style item di dalam dropdown */
        .navbar-nav .dropdown-item {
            color: #333;
            font-weight: 500;
            padding: 0.6rem 1.25rem;
        }
        .navbar-nav .dropdown-item:hover {
            background-color: #E5E7EB; /* Warna abu-abu saat di-hover */
            color: #000;
        }
        .navbar-nav .dropdown-item i {
            color: #6B7280; /* Warna ikon abu-abu */
        }
    </style>

</head>
<body>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>