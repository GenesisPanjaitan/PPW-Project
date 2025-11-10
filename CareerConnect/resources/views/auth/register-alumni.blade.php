@extends('layouts.app')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light navbar-section">
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
                    <a href="{{ route('login') }}" class="btn btn-login-nav btn-sm px-4 py-2 me-2 mb-2 mb-lg-0 rounded-pill">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-register-nav btn-sm px-4 py-2 rounded-pill">Register</a>
                </div>
            </div>
        </div>
    </nav>


    <main class="py-5" style="margin-top: 1rem; margin-bottom: 3rem;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7"> <div class="card register-card">
                        <div class="card-body p-4 p-sm-5">
                            
                            <div class="text-center mb-4">
                                <img src="{{ asset('images/logokita.png') }}" alt="Logo" class="img-fluid mb-3 d-block mx-auto" style="max-height: 40px;">
                                <h3 class="card-title text-center fw-bold mb-2 mt-2">
                                    Daftar CareerConnect
                                </h3>
                                <p class="card-text text-center text-muted">
                                    Lengkapi profil Anda untuk mendapatkan pengalaman terbaik
                                </p>
                            </div>

                            <form action="#" method="POST">
                                @csrf
                                
                                <h5 class="fw-bold mb-3 fs-6">Informasi Dasar</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nama_lengkap" class="form-label-custom">Nama Lengkap</label>
                                        <input type="text" class="form-control form-control-custom" id="nama_lengkap" name="nama_lengkap" placeholder="Nama lengkap Anda" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label-custom">Email</label>
                                        <input type="email" class="form-control form-control-custom" id="email" name="email" placeholder="nama@email.com" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="password" class="form-label-custom">Password</label>
                                        <input type="password" class="form-control form-control-custom" id="password" name="password" placeholder="Buat password yang kuat" required>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h5 class="fw-bold mb-3 fs-6">Informasi Akademik</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="angkatan" class="form-label-custom">Angkatan</label>
                                        <input type="number" class="form-control form-control-custom" id="angkatan" name="angkatan" placeholder="Isi Tahun Lulus" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jurusan" class="form-label-custom">Jurusan / Program Studi</label>
                                        <select class="form-select form-control-custom" id="jurusan" name="jurusan" required>
                                            <option value="" selected disabled>Pilih Jurusan Anda</option>
                                            <option value="if">S1-Informatika</option>
                                            <option value="si">S1-Sistem Informasi</option>
                                            <option value="te">S1-Teknik Elektro</option>
                                            <option value="mr">S1-Manajemen Rekayasa</option>
                                            <option value="tm">S1-Teknik Metalurgi</option>
                                            <option value="bp">S1-Teknik Bioproses</option>
                                            <option value="bt">S1-Bioteknologi</option>
                                            <option value="trpl">D4-Teknologi Rekayasa Perangkat Lunak</option>
                                            <option value="ti">D3-Teknologi Informasi</option>
                                            <option value="nm">D3-Teknologi Komputer</option>
                                        </select>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h5 class="fw-bold mb-3 fs-6">Bidang Keahlian</h5>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="bidang_saat_ini" class="form-label-custom">Bidang Saat Ini</label>
                                        <input type="text" class="form-control form-control-custom" id="bidang_saat_ini" name="bidang_saat_ini" placeholder="Isi bidang Anda">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="kontak" class="form-label-custom">Kontak (Opsional)</label>
                                        <input type="text" class="form-control form-control-custom" id="kontak" name="kontak" placeholder="WhatsApp atau Kontak lain">
                                    </div>
                                </div>
                                
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-masuk text-white fw-semibold py-2">Daftar dan Mulai Eksplorasi</button>
                                </div>
                                
                                <p class="text-center text-muted mt-4 mb-0" style="font-size: 0.9rem;">
                                    Sudah punya akun? 
                                    <a href="{{ route('login') }}" class="link-login">Masuk di sini</a>
                                </p>
                                
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

@endsection