<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerConnect - Alumni Del</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* == Hero & Footer Styles (dari kode Anda) == */
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
        .navbar-brand-custom { /* Style ini ada di register.blade.php Anda */
            font-weight: 700; 
            font-size: 1.5rem; 
            color: #000; 
        }

        /* ============================================== */
        /* == STYLES UNTUK HALAMAN REGISTER (BARU DITAMBAH) == */
        /* ============================================== */
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

        /* ============================================== */
/* == STYLES UNTUK FORM LOGIN/REGISTER (TAMBAHKAN INI) == */
/* ============================================== */

/* Style untuk input form (abu-abu muda) */
    .form-control-custom {
        background-color: #F3F4F6;
        border: none;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
    }
    .form-control-custom:focus {
        background-color: #F3F4F6;
        box-shadow: 0 0 0 2px #3B49DF; /* Ganti border saat fokus */
    }
    /* Memastikan select box punya style yang sama */
    .form-select.form-control-custom {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23333' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px 12px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    /* Style untuk tombol submit biru */
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

    /* Style untuk label form */
    .form-label-custom {
        font-weight: 600;
        color: #333;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }
            
    /* ============================================== */
/* == STYLES UNTUK HALAMAN HOME (TAMBAHKAN INI) == */
/* ============================================== */

/* Ganti background body agar sesuai gambar */
body {
    background-color: #F8F7FF; /* Latar belakang lavender muda */
}

.alert-welcome {
    /* Posisi & Ukuran */
    position: fixed;
    top: 20px; 
    left: 50%;
    transform: translateX(-50%);
    width: auto;
    z-index: 1050; 
    
    /* Tampilan (Update untuk lebih kecil) */
    background-color: #E6F7F0;
    color: #097B4B;
    font-weight: 500;
    padding: 0.75rem 1.25rem; /* Mengurangi padding */
    font-size: 0.9rem; /* Mengurangi ukuran font */
    
    border-radius: 0.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    
    /* Transisi */
    transition: opacity 0.5s ease-out, top 0.5s ease-out, transform 0.5s ease-out;
}

/* Anda juga bisa mengurangi ukuran ikon jika ingin */
.alert-welcome .bi {
    font-size: 1.1rem !important; /* Contoh, jika ingin ikon lebih kecil */
}

/* Kartu Profil (Ungu) */
.profile-card {
    background-color: #ECEBFE; /* Ungu muda */
    border-radius: 1rem;
}
.skill-tag {
    background-color: #DCD9FE; /* Ungu lebih gelap */
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


/* Kartu Lowongan (Biru) */
.job-card {
    background-color: #E4F1FF; /* Biru muda */
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

/* Badge Tipe Pekerjaan */
.job-card .badge {
    color: #052C65;
    font-weight: 500;
    font-size: 0.75rem;
    padding: 6px 10px;
}
.job-badge-internship { background-color: #C7E4FF; }
.job-badge-part-time { background-color: #DFFFEA; }
.job-badge-full-time { background-color: #FCE8D5; }
       </style>
    </head>
    <body class="bg-white">



    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>