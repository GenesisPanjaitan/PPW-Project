@extends('layouts.app')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">
            
            <!-- Logo -->
            <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">
                <img src="{{ asset('images/logokita.png') }}" 
                     alt="CareerConnect Logo" 
                     style="height: 30px;" 
                     class="ms-2"> CareerConnect
            </a>
            
            <!-- Tombol Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navDashboard" aria-controls="navDashboard" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navDashboard">
                
                <!-- Menu Tengah -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3">
                        <a class="nav-link {{ Request::is('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link {{ Request::is('recruitment*') ? 'active fw-semibold' : '' }}" href="/recruitment">Recruitment</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link {{ Request::is('profile*') ? 'active fw-semibold' : '' }}" href="/profile">My Profile</a>
                    </li>
                </ul>
                
                <!-- Menu Kanan (Dropdown Profil) -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <!-- Tombol Pemicu Dropdown -->
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>
                            @auth
                                {{ auth()->user()->name }}
                            @else
                                {{ optional(auth()->user())->name ?? 'Kevin Gultom' }}
                            @endauth
                        </a>
                        
                        <!-- Isi Dropdown -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('favorit') }}">
                                    <i class="bi bi-bookmark-fill me-2"></i> Favorit Anda
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <!-- Link Logout -->
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Keluar Akun
                                </a>
                                <!-- Form Logout (Tersembunyi) -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <main class="py-5">
        <div class="container">

            <div class="mb-4">
                <h2 class="fw-bold mb-1 text-header-blue">Detail Lengkap</h2>
                <p class="text-muted">Lowongan pekerjaan yang dibagikan langsung oleh alumni di berbagai perusahaan</p>
            </div>

            <div class="row g-5">
                
                <div class="col-lg-5">
                        @if(!empty($r->image))
                            <img src="{{ asset('storage/' . $r->image) }}" alt="Gambar Perusahaan" class="img-building">
                        @else
                            <img src="{{ asset('images/jwmarriot.jpg') }}" alt="Gambar Perusahaan" class="img-building">
                        @endif

                        <div class="job-info-card p-4 shadow-sm">
                            <h5 class="fw-bold mb-1">{{ $r->position }}</h5>
                            <p class="text-muted mb-4 fw-medium">{{ $r->company_name }}</p>
                        
                            <div class="d-flex justify-content-between align-items-center text-muted small">
                                <span><i class="bi bi-geo-alt me-1"></i> {{ $r->location }}</span>
                                <span>{{ \Carbon\Carbon::parse($r->date)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                <div class="col-lg-7">
                    <div class="d-flex justify-content-end mb-3">
                        @auth
                            @if(auth()->user()->role === 'admin' || auth()->user()->id === $r->user_id)
                                <a href="{{ route('recruitment.edit', ['id'=>$r->id]) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                                <form action="{{ route('recruitment.destroy', ['id'=>$r->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus postingan ini?')">Hapus</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                    <h5 class="fw-bold mb-3">Deskripsi Pekerjaan</h5>
                    <div class="text-dark" style="line-height: 1.7; font-size: 0.95rem;">
                        @if(!empty($r->description))
                            {{-- Render description from DB, preserve newlines --}}
                            {!! nl2br(e($r->description)) !!}
                        @else
                            <p class="text-muted">Deskripsi pekerjaan belum tersedia untuk postingan ini.</p>
                        @endif
                    </div>

                    <p class="mt-4 text-sm">
                        Detail : <a href="https://id.jobstreet.com/id/jw-marriot-jobs/in-Medan-Sumatera-Utara" class="text-primary text-decoration-none fw-semibold">Lihat Selengkapnya..</a>
                    </p>
                </div>

            </div>

            <div class="mt-5">
                <div class="card shadow-sm border-0" style="border-radius: 1.5rem;">
                    <div class="card-body p-4 p-md-5">
                        
                        <h5 class="fw-bold mb-1">Diskusi & Pertanyaan</h5>
                            <p class="text-muted small mb-4">Tanyakan hal-hal yang ingin kamu ketahui tentang posisi ini</p>

                            <div class="comments-list mb-5">
                                @if(!empty($comments) && $comments->count())
                                    @foreach($comments as $c)
                                        <div class="comment-bubble">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span class="fw-bold text-dark">{{ $c->author ?? 'Anon' }}</span>
                                                <span class="text-muted small">{{ \Carbon\Carbon::parse($c->created_at)->diffForHumans() }}</span>
                                            </div>
                                            <p class="mb-0 text-secondary small">{{ $c->content }}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-info">Belum ada komentar.</div>
                                @endif
                            </div>

                            <div>
                                <label class="fw-bold small mb-2">Tambah Komentar</label>
                                <form method="POST" action="{{ route('recruitment.comment', ['id' => $r->id]) }}">
                                    @csrf
                                    <input type="text" name="comment" class="form-control input-comment mb-3" placeholder="Tulis komentar ..." required>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn-send-comment d-flex align-items-center btn btn-primary">
                                            <i class="bi bi-send-fill me-2"></i> Kirim Komentar
                                        </button>
                                    </div>
                                </form>
                            </div>

                    </div>
                </div>
            </div>
            <div class="mt-5">
                </div>


            <div class="mt-5 mb-5 text-center">
                <a href="{{ route('recruitment') }}" class="btn btn-light border px-4 py-2 rounded-pill fw-semibold shadow-sm text-muted" style="font-size: 0.85rem; transition: all 0.2s;">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
                </a>
            </div>
            </div> </main>
        </div>
    </main>

@endsection