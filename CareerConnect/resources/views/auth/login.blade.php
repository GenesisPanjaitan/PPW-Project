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
                        <input type="password" id="password" name="password"
                               class="form-control bg-light border-0 p-3 @error('password') is-invalid @enderror"
                               placeholder="Password anda disini..." required>
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
