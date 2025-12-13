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
                
        /* == Halaman Home (Dashboard) == */
        body {
            background-color: #F8F7FF; /* Latar belakang lavender muda */
            min-height: 100vh;
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
    </style>
</head>
<body>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
