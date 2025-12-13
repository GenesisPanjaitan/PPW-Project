@extends('layouts.app')

@section('content')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">
                <img src="{{ asset('images/logokita.png') }}" alt="CareerConnect Logo" style="height: 30px;" class="ms-2"> CareerConnect
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navDashboard" aria-controls="navDashboard" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navDashboard">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3"><a class="nav-link {{ Request::is('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item mx-3"><a class="nav-link {{ Request::is('recruitment*') ? 'active fw-semibold' : '' }}" href="/recruitment">Recruitment</a></li>
                    <li class="nav-item mx-3"><a class="nav-link {{ Request::is('profile*') ? 'active fw-semibold' : '' }}" href="/profile">My Profile</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                     
<a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    @if(auth()->user() && auth()->user()->image)
        @php
            $avatarUrl = filter_var(auth()->user()->image, FILTER_VALIDATE_URL)
                ? auth()->user()->image
                : asset('storage/profile_photos/' . auth()->user()->image);
        @endphp
        <img src="{{ $avatarUrl }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;">
    @else
        <i class="bi bi-person-circle me-1"></i>
    @endif
    @auth {{ auth()->user()->name }} @else {{ optional(auth()->user())->name ?? 'Kevin Gultom' }} @endauth
</a>
<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('favorit') }}"><i class="bi bi-bookmark-fill me-2"></i> Favorit Anda</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Keluar Akun
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-5" style="background-color: #F8F7FF; min-height: 100vh;">
        <div class="container">

            <!-- Header Section -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-4">
                <div>
                    <nav aria-label="breadcrumb" class="mb-2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('recruitment') }}" class="text-decoration-none">Recruitment</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Postingan Anda</li>
                        </ol>
                    </nav>
                        <h2 class="fw-bold mb-1" style="color: #6b5ce7;">Postingan Anda</h2>                    <p class="text-muted mb-0 small">Kelola semua lowongan yang telah Anda posting.</p>
                </div>
                
                <div class="mt-3 mt-md-0">
                    <a href="{{ route('recruitment') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 py-2 shadow-sm fw-bold me-2">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2);">
                                        <i class="bi bi-file-text fs-4 text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3 text-white">
                                    <h4 class="fw-bold mb-0">{{ $userPosts->count() }}</h4>
                                    <p class="mb-0 small opacity-90">Total Postingan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2);">
                                        <i class="bi bi-calendar3 fs-4 text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3 text-white">
                                    <h4 class="fw-bold mb-0">{{ $userPosts->where('date', '>=', now()->subDays(30))->count() }}</h4>
                                    <p class="mb-0 small opacity-90">Aktif Bulan Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2);">
                                        <i class="bi bi-calendar-check fs-4 text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3 text-white">
                                    <h4 class="fw-bold mb-0">{{ $userPosts->where('date', '>=', now()->subDays(7))->count() }}</h4>
                                    <p class="mb-0 small opacity-90">Minggu Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Posts List -->
            @if($userPosts->count() > 0)
                <div class="row g-4">
                    @foreach($userPosts as $post)
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100 hover-card" style="transition: transform 0.2s;">
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <h5 class="fw-bold mb-2 text-dark">{{ $post->position }}</h5>
                                        <p class="text-muted mb-2">
                                            <i class="bi bi-building me-1"></i> {{ $post->company_name }}
                                        </p>
                                        <p class="text-muted small mb-0">
                                            <i class="bi bi-geo-alt me-1"></i> {{ $post->location }}
                                            <span class="ms-3">
                                                <i class="bi bi-calendar me-1"></i> {{ \Carbon\Carbon::parse($post->date)->format('d M Y') }}
                                            </span>
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex gap-2 flex-wrap">
                                            <a href="{{ route('recruitment.detail', $post->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                <i class="bi bi-eye me-1"></i> Lihat Detail
                                            </a>
                                            <a href="{{ route('recruitment.edit', $post->id) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                <i class="bi bi-pencil me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('recruitment.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <p class="text-muted small mb-0">{{ Str::limit($post->description, 120) }}</p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                                {{ $post->jobtype ?? 'Full-time' }}
                                            </span>
                                            @if($post->category)
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2 ms-1">
                                                    {{ $post->category }}
                                                </span>
                                            @endif
                                        </div>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($post->date)->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-file-text text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                        </div>
                        <h4 class="fw-bold mb-3 text-muted">Belum Ada Postingan</h4>
                        <p class="text-muted mb-4">Anda belum memposting lowongan pekerjaan. Mulai berbagi peluang karir dengan komunitas!</p>
                        <a href="{{ route('recruitment') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-plus-lg me-1"></i> Buat Postingan Pertama
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </main>

    <style>
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
        }
    </style>

@endsection