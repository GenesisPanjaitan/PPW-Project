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
                                <img src="{{ $avatarUrl }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
                                <i class="bi bi-person-circle me-1" style="display: none;"></i>
                            @else
                                <i class="bi bi-person-circle me-1"></i>
                            @endif
                            @auth {{ auth()->user()->name }} @else Guest @endauth
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

    <!-- MAIN CONTENT (Background Lavender) -->
    <main class="py-5" style="background-color: #F8F7FF; min-height: 100vh;">
        <div class="container">

            <!-- Breadcrumb -->
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('recruitment') }}" class="text-decoration-none text-muted">Recruitment</a></li>
                        <li class="breadcrumb-item active fw-semibold text-primary" aria-current="page">Detail Lowongan</li>
                    </ol>
                </nav>
            </div>

            <div class="row g-4">
                
                <!-- KOLOM KIRI: GAMBAR & INFO UTAMA -->
                <div class="col-lg-4">
                    <div class="sticky-sidebar" style="top: 90px; z-index: 1;">
                        
                        <!-- Card Gambar -->
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                            <div class="position-relative">
                                @if(!empty($r->image))
                                    <img src="{{ asset('storage/' . $r->image) }}" 
                                         alt="Gambar Perusahaan" 
                                         class="w-100" 
                                         style="height: 220px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center text-secondary" style="height: 220px;">
                                        <div class="text-center">
                                            <i class="bi bi-building display-1 opacity-25"></i>
                                            <p class="small mt-2 mb-0 opacity-50">Tidak ada gambar</p>
                                        </div>
                                    </div>
                                @endif
                                <span class="position-absolute top-0 end-0 m-3 badge bg-white text-dark shadow-sm px-3 py-2 rounded-pill">
                                    {{ \Carbon\Carbon::parse($r->date)->diffForHumans() }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Info Singkat -->
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">{{ $r->category ?? 'Umum' }}</span>
                                
                                <h4 class="fw-bold mb-1 text-dark">{{ $r->position }}</h4>
                                <p class="text-muted fw-medium mb-4">{{ $r->company_name }}</p>
                            
                                <hr class="border-dashed opacity-50 my-4">

                                <div class="vstack gap-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box bg-light rounded-circle p-2 me-3 text-primary">
                                            <i class="bi bi-geo-alt fs-5"></i>
                                        </div>
                                        <div>
                                            <small class="d-block text-muted" style="font-size: 0.75rem;">Lokasi</small>
                                            <span class="fw-semibold text-dark">{{ $r->location }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box bg-light rounded-circle p-2 me-3 text-success">
                                            <i class="bi bi-briefcase fs-5"></i>
                                        </div>
                                        <div>
                                            <small class="d-block text-muted" style="font-size: 0.75rem;">Tipe Pekerjaan</small>
                                            <span class="fw-semibold text-dark">{{ $r->jobtype ?? 'Full-time' }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            @if(!empty($r->author_image))
                                                @php
                                                    $posterUrl = filter_var($r->author_image, FILTER_VALIDATE_URL)
                                                        ? $r->author_image
                                                        : asset('storage/profile_photos/' . $r->author_image);
                                                    $posterInitial = strtoupper(substr($r->author ?? 'A', 0, 1));
                                                @endphp
                                                <img src="{{ $posterUrl }}" class="rounded-circle poster-avatar" width="45" height="45" style="object-fit: cover;" data-initial="{{ $posterInitial }}" data-name="{{ $r->author ?? 'Alumni' }}">
                                            @else
                                                @php
                                                    $posterInitial = strtoupper(substr($r->author ?? 'A', 0, 1));
                                                @endphp
                                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                    {{ $posterInitial }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <small class="d-block text-muted" style="font-size: 0.75rem;">Diposting Oleh</small>
                                            <span class="fw-semibold text-dark">{{ $r->author ?? 'Alumni' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Apply / Link -->
                                @if(!empty($r->link))
                                    <div class="d-grid mt-4">
                                        <a href="{{ $r->link }}" target="_blank" class="btn btn-primary rounded-pill py-2 fw-bold shadow-sm hover-scale">
                                            Lamar Sekarang 🚀
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: DESKRIPSI & KOMENTAR -->
                <div class="col-lg-8">
                    
                    <!-- Card Deskripsi -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5 mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                            <h5 class="fw-bold mb-0 text-dark">Deskripsi Pekerjaan</h5>
                            
                            <!-- TOMBOL KELOLA (HANYA ADMIN/OWNER ALUMNI, bukan Mahasiswa) -->
                            @auth
                                @if(auth()->user()->role !== 'mahasiswa' && (auth()->user()->role === 'admin' || auth()->user()->id === $r->user_id))
                                    <a href="{{ route('recruitment') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">
                                        <i class="bi bi-pencil-square me-1"></i> Kelola di Recruitment
                                    </a>
                                @endif
                            @endauth
                        </div>

                        <div class="text-secondary" style="line-height: 1.8; font-size: 1rem;">
                            @if(!empty($r->description))
                                {!! nl2br(e($r->description)) !!}
                            @else
                                <div class="alert alert-light border-dashed text-center text-muted">
                                    <i class="bi bi-text-paragraph fs-1 d-block mb-2 opacity-50"></i>
                                    Deskripsi pekerjaan belum tersedia.
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Card Komentar -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5 class="fw-bold mb-0 text-dark">Diskusi <span class="text-muted fw-normal">({{ $comments->count() }})</span></h5>
                            <span class="badge bg-light text-dark border rounded-pill px-3">Q&A</span>
                        </div>

                        <div class="comments-list mb-4">
                            @forelse($comments as $c)
                                <div class="d-flex gap-3 mb-4 animate-fade-in">
                                    <!-- Avatar -->
                                    <div class="flex-shrink-0">
                                        @if(!empty($c->author_image))
                                            @php
                                                $commentUrl = filter_var($c->author_image, FILTER_VALIDATE_URL)
                                                    ? $c->author_image
                                                    : asset('storage/profile_photos/' . $c->author_image);
                                                $commentInitial = substr($c->author ?? 'A', 0, 1);
                                            @endphp
                                            <img src="{{ $commentUrl }}" class="rounded-circle shadow-sm comment-avatar" width="45" height="45" style="object-fit: cover;" data-initial="{{ $commentInitial }}">
                                        @else
                                            <div class="avatar-comment bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" 
                                                 style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                <span class="fw-bold">{{ substr($c->author ?? 'A', 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-grow-1">
                                        <div class="bg-light p-3 rounded-4 rounded-top-left-0" style="border-top-left-radius: 0 !important;">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $c->author ?? 'Anon' }}</span>
                                                <small class="text-muted" style="font-size: 0.75rem;">{{ \Carbon\Carbon::parse($c->created_at)->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-0 text-secondary" style="font-size: 0.9rem;">{{ $c->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 bg-light rounded-4 border border-dashed mb-3">
                                    <i class="bi bi-chat-square-quote fs-1 text-muted opacity-25 mb-2"></i>
                                    <p class="text-muted mb-0">Belum ada diskusi. Jadilah yang pertama bertanya!</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Form Tambah Komentar -->
                        <div class="mt-auto">
                            <form method="POST" action="{{ route('recruitment.comment', ['id' => $r->id]) }}">
                                @csrf
                                <div class="d-flex gap-3 align-items-start">
                                    <div class="flex-shrink-0">
                                        @if(auth()->check() && auth()->user()->image)
                                            @php
                                                $userAvatarUrl = filter_var(auth()->user()->image, FILTER_VALIDATE_URL)
                                                    ? auth()->user()->image
                                                    : asset('storage/profile_photos/' . auth()->user()->image);
                                            @endphp
                                            <img src="{{ $userAvatarUrl }}" class="rounded-circle user-avatar" width="45" height="45" style="object-fit: cover;">
                                        @else
                                            <div class="avatar-comment bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                <i class="bi bi-person-fill fs-5"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="w-100">
                                        <div class="position-relative">
                                            <textarea name="comment" class="form-control bg-light border-0 ps-3 pt-3" rows="2" placeholder="Tulis pertanyaan atau komentar..." required style="resize: none; border-radius: 1rem; padding-right: 60px;"></textarea>
                                            <button type="submit" class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 end-0 m-2 shadow-sm" style="width: 32px; height: 32px;">
                                                <i class="bi bi-send-fill" style="font-size: 0.8rem;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tombol Kembali -->
                    <div class="mt-5 text-center">
                        <a href="{{ route('recruitment') }}" class="btn btn-light border px-4 py-2 rounded-pill fw-semibold shadow-sm text-muted hover-scale">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script>
        // Handle image error untuk foto profil komentar
        document.querySelectorAll('.comment-avatar').forEach(img => {
            img.addEventListener('error', function() {
                const initial = this.getAttribute('data-initial') || 'A';
                const fallback = document.createElement('div');
                fallback.className = 'avatar-comment bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm';
                fallback.style.width = '45px';
                fallback.style.height = '45px';
                fallback.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                fallback.innerHTML = `<span class="fw-bold">${initial}</span>`;
                this.parentElement.replaceChild(fallback, this);
            });
        });

        // Handle image error untuk foto profil user di form
        document.querySelectorAll('.user-avatar').forEach(img => {
            img.addEventListener('error', function() {
                const fallback = document.createElement('div');
                fallback.className = 'avatar-comment bg-dark text-white rounded-circle d-flex align-items-center justify-content-center';
                fallback.style.width = '45px';
                fallback.style.height = '45px';
                fallback.innerHTML = '<i class="bi bi-person-fill fs-5"></i>';
                this.parentElement.replaceChild(fallback, this);
            });
        });

        // Handle image error untuk foto profil pemosting
        document.querySelectorAll('.poster-avatar').forEach(img => {
            img.addEventListener('error', function() {
                const initial = this.getAttribute('data-initial') || 'A';
                const fallback = document.createElement('div');
                fallback.className = 'rounded-circle d-flex align-items-center justify-content-center text-white fw-bold';
                fallback.style.width = '45px';
                fallback.style.height = '45px';
                fallback.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                fallback.innerHTML = initial;
                this.parentElement.replaceChild(fallback, this);
            });
        });
    </script>

@endsection