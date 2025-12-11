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
    </div>
</nav>

<div class="container d-flex align-items-center justify-content-center py-5" style="min-height: 90vh;">
    <div class="col-md-5 col-lg-5">
        <div class="card border-0 shadow rounded-4">
            <div class="card-body p-4 p-sm-5">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logokita.png') }}" 
                         alt="Logo" 
                         class="img-fluid mb-3 d-block mx-auto" 
                         style="max-height: 50px;">
                    <h4 class="fw-bold mb-2">Email Sudah Terdaftar</h4>
                    <p class="text-muted">Email <strong>{{ $email }}</strong> sudah memiliki akun</p>
                </div>

                <div class="alert alert-warning d-flex align-items-start gap-3" role="alert">
                    <i class="bi bi-exclamation-triangle-fill flex-shrink-0 mt-1"></i>
                    <div>
                        <strong>Ada Akun Lain!</strong><br>
                        Email ini sudah terdaftar dengan <strong>{{ ucfirst($existingMethod) }}</strong>. 
                        Anda ingin login dengan <strong>{{ ucfirst($newMethod) }}</strong>.
                    </div>
                </div>

                <p class="text-muted text-center mb-4">
                    Pilih salah satu opsi di bawah:
                </p>

                {{-- Opsi 1: Login dengan akun lama --}}
                <form action="{{ route('account-linking.select') }}" method="POST" class="mb-3">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="action" value="login">
                    <input type="hidden" name="provider_data" value="{{ json_encode($newProviderData) }}">
                    <input type="hidden" name="new_method" value="{{ $newMethod }}">
                    
                    <button type="submit" class="btn w-100 py-2 fw-semibold" 
                            style="background-color: #2940D3; color: white;">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Login dengan Akun {{ ucfirst($existingMethod) }} Saya
                    </button>
                </form>

                <div class="text-center text-muted mb-3">
                    <small>atau</small>
                </div>

                {{-- Opsi 2: Buat akun baru --}}
                <form action="{{ route('account-linking.select') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="action" value="new">
                    <input type="hidden" name="provider_data" value="{{ json_encode($newProviderData) }}">
                    <input type="hidden" name="new_method" value="{{ $newMethod }}">
                    
                    <button type="submit" class="btn border w-100 py-2 fw-semibold" 
                            style="background-color: #fff; color: #2940D3; border-color: #2940D3 !important;">
                        <i class="bi bi-person-plus me-2"></i>
                        Buat Akun Baru dengan {{ ucfirst($newMethod) }}
                    </button>
                </form>

                <div class="text-center mt-4">
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        <a href="{{ route('login') }}" class="link-daftar">Kembali ke Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
