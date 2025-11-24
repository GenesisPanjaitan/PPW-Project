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

                            <form action="{{ route('register.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="role" value="alumni">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                <h5 class="fw-bold mb-3 fs-6">Informasi Dasar</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nama_lengkap" class="form-label-custom">Nama Lengkap</label>
                                        <input type="text" class="form-control form-control-custom" id="nama_lengkap" name="name" placeholder="Nama lengkap Anda" value="{{ old('name') }}" required>
                                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label-custom">Email</label>
                                        <input type="email" class="form-control form-control-custom" id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
                                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="password" class="form-label-custom">Password</label>
                                        <input type="password" class="form-control form-control-custom" id="password" name="password" placeholder="Buat password yang kuat" required>
                                        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="password_confirmation" class="form-label-custom">Konfirmasi Password</label>
                                        <input type="password" class="form-control form-control-custom" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h5 class="fw-bold mb-3 fs-6">Informasi Akademik</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="angkatan" class="form-label-custom">Angkatan</label>
                                        <input type="number" class="form-control form-control-custom" id="angkatan" name="class" placeholder="Isi Tahun Lulus" value="{{ old('class') }}" required>
                                        @error('class') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jurusan" class="form-label-custom">Jurusan / Program Studi</label>
                                        <select class="form-select form-control-custom" id="jurusan" name="study_program" required>
                                            <option value="" {{ old('study_program') ? '' : 'selected' }} disabled>Pilih Jurusan Anda</option>
                                            <option value="if" {{ old('study_program')=='if' ? 'selected' : '' }}>S1-Informatika</option>
                                            <option value="si" {{ old('study_program')=='si' ? 'selected' : '' }}>S1-Sistem Informasi</option>
                                            <option value="te" {{ old('study_program')=='te' ? 'selected' : '' }}>S1-Teknik Elektro</option>
                                            <option value="mr" {{ old('study_program')=='mr' ? 'selected' : '' }}>S1-Manajemen Rekayasa</option>
                                            <option value="tm" {{ old('study_program')=='tm' ? 'selected' : '' }}>S1-Teknik Metalurgi</option>
                                            <option value="bp" {{ old('study_program')=='bp' ? 'selected' : '' }}>S1-Teknik Bioproses</option>
                                            <option value="bt" {{ old('study_program')=='bt' ? 'selected' : '' }}>S1-Bioteknologi</option>
                                            <option value="trpl" {{ old('study_program')=='trpl' ? 'selected' : '' }}>D4-Teknologi Rekayasa Perangkat Lunak</option>
                                            <option value="ti" {{ old('study_program')=='ti' ? 'selected' : '' }}>D3-Teknologi Informasi</option>
                                            <option value="nm" {{ old('study_program')=='nm' ? 'selected' : '' }}>D3-Teknologi Komputer</option>
                                        </select>
                                        @error('study_program') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h5 class="fw-bold mb-3 fs-6">Bidang Keahlian</h5>
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="bidang_saat_ini" class="form-label-custom">Bidang Saat Ini</label>
                                        <input type="text" class="form-control form-control-custom" id="bidang_saat_ini" name="field" placeholder="Isi bidang Anda" value="{{ old('field') }}">
                                        @error('field') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="kontak" class="form-label-custom">Kontak (Opsional)</label>
                                        <input type="text" class="form-control form-control-custom" id="kontak" name="contact" placeholder="WhatsApp atau Kontak lain" value="{{ old('contact') }}">
                                        @error('contact') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
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