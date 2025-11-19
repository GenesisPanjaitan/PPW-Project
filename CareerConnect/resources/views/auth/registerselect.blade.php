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
       
    <main class="py-5" style="margin-top: 2rem;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-6"> <div class="card register-card">
                        <div class="card-body p-4 p-sm-5">
                            
                            <div class="text-center mb-4">
                                <img src="{{ asset('images/logokita.png') }}" 
                                     alt="Logo" 
                                     class="img-fluid mb-4 d-block mx-auto" 
                                     style="max-height: 50px;">
                                <h3 class="card-title text-center fw-bold mb-2 mt-2">
                                    Daftar CareerConnect
                                </h3>
                                <p class="card-text text-center text-muted">
                                    Lengkapi profil Anda untuk mendapatkan peluang karir terbaik
                                </p>
                            </div>

                            <div class="mb-3">
                                <h5 class="fw-bold mb-3">Tipe Akun</h5>
                                <div class="row g-3">
                                    
                                <div class="col-6">
                                    <a href="{{ route('register.student') }}" class="account-type-box d-block text-decoration-none text-center h-100">
                                        <i class="bi bi-mortarboard fs-2 mb-2"></i>
                                        <h6 class="mb-1">Mahasiswa</h6>
                                        <p class="small text-muted mb-0">Saya sedang kuliah dan mencari peluang karir</p>
                                    </a>
                                </div>
                                    
                                <div class="col-6">
                                    <a href="{{ route('register.alumni') }}" class="account-type-box d-block text-decoration-none text-center h-100">
                                        <i class="bi bi-building fs-2 mb-2"></i>
                                        <h6 class="mb-1">Alumni</h6>
                                        <p class="small text-muted mb-0">Saya sudah lulus dan ingin berbagi peluang karir</p>
                                    </a>
                                </div>
                                </div>
                            </div>

                            <p class="text-danger small mt-2" style="font-size: 0.9rem;">
                                Silakan pilih tipe akun terlebih dahulu
                            </p>
                            
                            <p class="text-center text-muted mt-4 mb-0" style="font-size: 0.9rem;">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" class="link-login">Masuk di sini</a>
                            </p>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

@endsection