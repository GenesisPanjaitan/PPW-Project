@extends('layouts.app')

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
        
<div class="container d-flex align-items-center justify-content-center py-5" style="min-height: 90vh;">
    <div class="col-md-5 col-lg-4">
        <div class="card border-0 shadow rounded-4">
            <div class="card-body p-4 p-sm-5">


            <img src="{{ asset('images/logokita.png') }}" 
                alt="Logo" 
                class="img-fluid mb-4 d-block mx-auto" 
                style="max-height: 50px;">
                <h4 class="text-center fw-bold mb-2">Masuk ke CareerConnect</h4>
            <p class="text-center text-muted mb-4">
                Temukan peluang karirmu lewat koneksi kampus
            </p>

                {{-- Pesan Error --}}
                @if(session('error'))
                    <div class="alert alert-danger text-center">{{ session('error') }}</div>
                @endif

                {{-- Form Login --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            <i class="bi bi-envelope me-1"></i> Email
                        </label>
                        <input type="email" id="email" name="email"
                               class="form-control bg-light border-0 p-3 @error('email') is-invalid @enderror"
                               placeholder="Email anda disini..." value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">
                            <i class="bi bi-lock me-1"></i> Password
                        </label>
                        <div class="input-group">
                            <input type="password" id="password" name="password"
                                   class="form-control bg-light border-0 p-3 border-end-0 @error('password') is-invalid @enderror"
                                   placeholder="Password anda disini..." required
                                   style="border-right: none; border-top-right-radius: 0; border-bottom-right-radius: 0;">
                            <span class="input-group-text bg-light border-0" style="cursor: pointer; background-color: #F3F4F6 !important; border-top-left-radius: 0; border-bottom-left-radius: 0;" onclick="togglePassword('password', 'icon-login-password')">
                                <i class="bi bi-eye-slash" id="icon-login-password"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol Masuk --}}
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn fw-semibold text-white py-2" 
                                style="background-color: #2940D3;">
                            Masuk
                        </button>
                    </div>

                    {{-- Tombol Login dengan Google --}}
                    <div class="d-grid mb-3">
                        <a href="{{ url('auth/google') }}" 
                           class="btn border fw-semibold d-flex align-items-center justify-content-center gap-2 py-2"
                           style="background-color: #fff;">
                            <img src="https://developers.google.com/identity/images/g-logo.png" 
                                 alt="Google Logo" width="20" height="20">
                            <span>Masuk dengan akun Google</span>
                        </a>
                    </div>

                    {{-- Tombol Login dengan GitHub --}}
                    <div class="d-grid mb-3">
                        <a href="{{ url('auth/github') }}" 
                           class="btn border fw-semibold d-flex align-items-center justify-content-center gap-2 py-2"
                           style="background-color: #24292e; color: white;">
                            <svg height="20" width="20" viewBox="0 0 16 16" fill="currentColor">
                                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path>
                            </svg>
                            <span>Masuk dengan akun GitHub</span>
                        </a>
                        <small class="text-muted d-block text-center mt-2" style="font-size: 0.85rem;">
                            Ingin pakai akun GitHub lain? Logout dari github.com atau buka mode Incognito.
                        </small>
                    </div>

                    <p class="text-center text-muted mb-0" style="font-size: 0.9rem;">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="link-daftar">Daftar Sekarang</a>
                    </p>
                </form>

            </div>
        </div>
    </div>  
</div>
@endsection

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    }
</script>

<style>
    /* Hide native password reveal icons (Edge/Chromium) to avoid double eye */
    input[type=password]::-ms-reveal,
    input[type=password]::-ms-clear,
    input[type=password]::-webkit-credentials-auto-fill-button,
    input[type=password]::-webkit-textfield-decoration-container {
        display: none !important;
    }
</style>
