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
            background-color: #E5E7EB; 
            color: #000;
        }
        .navbar-nav .dropdown-item i {
            color: #6B7280; 
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

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Handle favorite form submissions via AJAX to avoid full page reload and toggle icon
        document.addEventListener('DOMContentLoaded', function() {
            const favForms = document.querySelectorAll('form.favorite-form');
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
                                icon.classList.add('bi-bookmark-fill');
                            }
                            if (submitButton) submitButton.classList.add('text-danger');
                            // change form to now point to destroy (so next click removes)
                            const newAction = form.action.replace(/favorite\/(\d+)$/,'favorite/$1');
                            // keep the same action; server handles delete via DELETE method when form has a method field
                            // swap hidden _method if any
                            if (!form.querySelector('input[name="_method"]')) {
                                // add _method delete
                                const input = document.createElement('input');
                                input.type = 'hidden'; input.name = '_method'; input.value = 'DELETE';
                                form.appendChild(input);
                            } else {
                                form.querySelector('input[name="_method"]').value = 'DELETE';
                            }
                        }
                        else if (data.action === 'deleted') {
                            if (icon) {
                                icon.classList.remove('bi-bookmark-fill');
                                icon.classList.add('bi-bookmark');
                            }
                            if (submitButton) submitButton.classList.remove('text-danger');
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
        });
    </script>
</body>
</html>