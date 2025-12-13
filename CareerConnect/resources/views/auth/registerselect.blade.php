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
       
    @php $hideOauth = session('hide_oauth'); @endphp
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
                                    {{ Auth::check() ? 'Lengkapi Profil Anda' : 'Daftar CareerConnect' }}
                                </h3>
                                <p class="card-text text-center text-muted">
                                    {{ Auth::check() ? 'Pilih tipe akun untuk melanjutkan' : 'Lengkapi profil Anda untuk mendapatkan peluang karir terbaik' }}
                                </p>
                                          @if(Auth::check() && ! $hideOauth)
                                {{-- Always show OAuth buttons, even if already logged in --}}
                                <a href="{{ route('google.redirect') }}" 
                                   class="btn btn-light w-100 border d-flex align-items-center justify-content-center gap-2 mb-3">
                                    <img src="https://developers.google.com/identity/images/g-logo.png" 
                                         alt="Google Logo" width="20" height="20">
                                    <span>Daftar / Masuk dengan akun Google</span>
                                </a>
                                <a href="{{ route('github.redirect') }}" 
                                   class="btn w-100 d-flex align-items-center justify-content-center gap-2 mb-4"
                                   style="background-color: #24292e; color: white; border: 1px solid #24292e;">
                                    <svg height="20" width="20" viewBox="0 0 16 16" fill="currentColor">
                                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path>
                                    </svg>
                                    <span>Daftar / Masuk dengan akun GitHub</span>
                                </a>
                                @endif
                            </div>

                                     @guest
                                     @unless($hideOauth)
                            {{-- Tombol daftar/masuk via Google --}}
                            <a href="{{ route('google.redirect') }}" 
                                   class="btn btn-light w-100 border d-flex align-items-center justify-content-center gap-2 mb-3">
                                <img src="https://developers.google.com/identity/images/g-logo.png" 
                                     alt="Google Logo" width="20" height="20">
                                <span>Daftar / Masuk dengan akun Google</span>
                            </a>

                                {{-- Tombol daftar/masuk via GitHub --}}
                                <a href="{{ route('github.redirect') }}" 
                                   class="btn w-100 d-flex align-items-center justify-content-center gap-2 mb-4"
                                   style="background-color: #24292e; color: white; border: 1px solid #24292e;">
                                    <svg height="20" width="20" viewBox="0 0 16 16" fill="currentColor">
                                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path>
                                    </svg>
                                    <span>Daftar / Masuk dengan akun GitHub</span>
                                </a>
                                <small class="text-muted d-block text-center mt-n2 mb-3" style="font-size: 0.85rem;">
                                    Ingin pakai akun GitHub lain? Logout dari github.com atau buka mode Incognito.
                                </small>
                            <div class="text-center text-muted small mb-3">atau lanjutkan dengan email</div>
                                @endunless
                            @endguest

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