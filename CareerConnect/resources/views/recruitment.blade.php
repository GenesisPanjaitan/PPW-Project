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

    <!-- =======================
    Konten Utama
    ======================== -->
    <main class="py-5"> 
        <div class="container">

            <!-- Header & Filter Section -->
            <div class="mb-5">
                <h2 class="fw-bold mb-1 text-recruitment-blue">Recruitment Hub</h2>
                <p class="text-muted mb-4">Lowongan pekerjaan yang dibagikan langsung oleh alumni di berbagai perusahaan</p>

                <!-- Filter Row 1 (Grid System Diperbarui agar search bar pendek) -->
                <div class="row g-3 align-items-end mb-3">
                    
                    <!-- Job Type -->
                    <div class="col-md-3">
                        <label class="fw-bold text-dark small mb-1">Job Type:</label>
                        <select class="form-select form-select-sm bg-input-gray" style="border-radius: 6px;">
                            <option>Semua</option>
                            <option>Full-time</option>
                            <option>Part-time</option>
                            <option>Internship</option>
                        </select>
                    </div>

                    <!-- Search Bar (Diperpendek) -->
                    <div class="col-md-4">
    <label class="fw-bold text-dark small mb-1">Cari:</label>
    <div class="input-group">
        <input type="text" class="form-control bg-input-gray border-0 py-2 ps-3" placeholder="Cari lowongan..." style="border-radius: 8px 0 0 8px;">
        
        <button class="btn btn-primary border-0 px-3" type="button" style="border-radius: 0 8px 8px 0; background-color: #4F6BF0;">
            <i class="bi bi-search text-white"></i>
        </button>
    </div>
</div>

                    <!-- Tombol Posting (hanya untuk alumni) -->
                    <div class="col-md-5 text-md-end">
                        @auth
                            @if(auth()->user()->role === 'alumni' || auth()->user()->role === 'admin')
                                <button id="openPostingBtn" class="btn btn-black text-white fw-semibold px-2" style="background-color: #000; border-radius: 8px;">
                                    <i class="bi bi-plus-lg me-1"></i> Posting Lowongan
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-black text-white fw-semibold px-2" style="background-color: #000; border-radius: 8px;">
                                <i class="bi bi-plus-lg me-1"></i> Login untuk Posting
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Filter Row 2 (Kategori) -->
                <div class="d-flex align-items-center gap-2">
                    <label class="fw-bold text-dark small">Kategori:</label>
                    <select class="form-select form-select-sm bg-input-gray" style="width: 200px; border-radius: 6px;">
                        <option>Semua Kategori</option>
                        <option>Teknologi & IT</option>
                        <option>Design & Creative</option>
                        <option>Business & Marketing</option>
                        <option>Data & Analytics</option>
                        <option>Finance & Banking</option>
                    </select>
                </div>
            </div>

            <!-- =======================
            DAFTAR POSTINGAN (Card Utama) - Render from DB
            ======================== -->
            <div class="mb-4">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @forelse($recruitments ?? [] as $r)
                    <div class="card shadow-sm border-1 mb-4" style="border-radius: 1.5rem; border-color: #eee;">
                        <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="bi bi-person-circle fs-1 text-dark"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">{{ $r->author ?? 'Anon' }}</h6>
                                        <p class="text-muted small mb-0">{{ $r->jobtype ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 align-items-center">
                                    <a href="{{ route('recruitment.detail', ['id' => $r->id]) }}" class="btn-detail-gray text-decoration-none">Lihat Detail</a>

                                    @auth
                                        @if(auth()->user()->role === 'admin' || auth()->user()->id === $r->user_id)
                                            <a href="{{ route('recruitment.edit', ['id' => $r->id]) }}" class="btn btn-sm btn-outline-primary btn-edit">Edit</a>
                                            <button type="button" data-id="{{ $r->id }}" class="btn btn-sm btn-outline-danger btn-delete">Hapus</button>
                                        @endif
                                    @endauth
                                </div>
                            </div>

                            <div class="job-box p-3 mb-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="bi bi-building fs-2 text-dark"></i>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <h6 class="fw-bold mb-0 text-dark">{{ $r->position }}</h6>
                                                <span class="badge-job-cream">{{ $r->jobtype ?? '—' }}</span>
                                            </div>
                                            <p class="small text-dark mb-0 fw-semibold">{{ $r->company_name }}</p>
                                            <p class="small text-muted mb-0"><i class="bi bi-geo-alt me-1"></i> {{ $r->location }}</p>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <p class="text-muted small mb-2" style="font-size: 0.75rem;">{{ 
                                            \Carbon\Carbon::parse($r->date)->diffForHumans() }}
                                        </p>
                                        <button class="btn btn-light btn-sm rounded-circle shadow-sm border">
                                            <i class="bi bi-bookmark"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <p class="text-muted small mb-4" style="line-height: 1.6;">{{ \Illuminate\Support\Str::limit($r->description, 300) }}</p>

                            <hr class="text-muted opacity-25 mb-4">

                            <!-- Placeholder comments area (implement comment relations later) -->
                            <div class="mb-4">
                                <div class="comment-box mb-2">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold small text-dark">Ahmad Fauzi</span>
                                        <span class="text-muted small" style="font-size: 0.7rem;">1 jam lalu</span>
                                    </div>
                                    <p class="small text-dark mb-0 mt-1">Wah opportunity bagus nih! Requirements-nya cocok sama background saya. Thanks for sharing kak!</p>
                                </div>

                                <div class="comment-box">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold small text-dark">Maya Sari Sibuea</span>
                                        <span class="text-muted small" style="font-size: 0.7rem;">2 jam lalu</span>
                                    </div>
                                    <p class="small text-dark mb-0 mt-1">Company culture-nya gimana kak? Apakah beginner-friendly untuk fresh graduate?</p>
                                </div>
                            </div>

                            <div class="mt-3">
                                <form method="POST" action="{{ route('recruitment.comment', ['id' => $r->id]) }}">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" name="comment" class="form-control bg-input-gray" placeholder="Tulis komentar..." style="border-radius: 8px; padding: 10px;">
                                        <button class="btn btn-secondary btn-sm fw-semibold px-3" type="submit" style="background-color: #9CA3AF; border:none; border-radius: 6px;">
                                            <i class="bi bi-send-fill me-1"></i> Kirim
                                        </button>
                                    </div>
                                </form>
                                {{-- Hidden delete form for server-side deletion --}}
                                <form id="delete-form-{{ $r->id }}" action="{{ route('recruitment.destroy', ['id' => $r->id]) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">Belum ada postingan lowongan.</div>
                @endforelse
            </div>

        </div>
    </main>

    <!-- ========================================== -->
    <!-- MODAL POSTING LOWONGAN (DESAIN BARU) -->
    <!-- ========================================== -->
    <div class="modal fade" id="postingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <!-- Gunakan kelas 'register-card' yang sudah ada di CSS Anda untuk styling -->
            <div class="modal-content register-card border-0 shadow-lg"> 
                <div class="modal-body p-4 p-md-5">
                    
                    <!-- Tombol Close (X) -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 1.5rem; right: 1.5rem;"></button>

                    <!-- Header -->
                    <h4 class="fw-bold mb-1">Posting Lowongan Baru</h4>
                    <p class="text-muted small mb-4">Bagikan informasi lowongan di perusahaan Anda kepada adik-adik mahasiswa</p>

                    <form id="postingForm" method="POST" action="{{ route('recruitment.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            
                            <!-- Nama Perusahaan -->
                            <div class="col-md-6">
                                <label for="postingCompany" class="form-label-custom fw-bold">Nama Perusahaan</label>
                                <input type="text" id="postingCompany" name="company" class="form-control form-control-custom" placeholder="e.g. TechCorp Indonesia">
                            </div>
                            
                            <!-- Posisi -->
                            <div class="col-md-6">
                                <label for="postingPosition" class="form-label-custom fw-bold">Posisi</label>
                                <input type="text" id="postingPosition" name="position" class="form-control form-control-custom" placeholder="e.g. Frontend Developer">
                            </div>

                            <!-- Kategori -->
                            <div class="col-md-6">
                                <label for="postingKategoriInput" class="form-label-custom fw-bold">Kategori</label>
                                <select id="postingKategoriInput" name="kategori" class="form-select form-control-custom">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    <option value="Teknologi">Teknologi & IT</option>
                                    <option value="Design">Design & Creative</option>
                                    <option value="Bisnis">Business & Marketing</option>
                                    <option value="Data">Data & Analytics</option>
                                    <option value="Finance">Finance & Banking</option>
                                </select>
                            </div>

                            <!-- Tipe Pekerjaan -->
                            <div class="col-md-6">
                                <label for="postingTipeInput" class="form-label-custom fw-bold">Tipe Pekerjaan</label>
                                <select id="postingTipeInput" name="tipe" class="form-select form-control-custom">
                                    <option value="" selected disabled>Pilih Tipe Pekerjaan</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Internship">Internship</option>
                                </select>
                            </div>

                            <!-- Lokasi -->
                            <div class="col-12">
                                <label for="postingLokasi" class="form-label-custom fw-bold">Lokasi</label>
                                <input type="text" id="postingLokasi" name="lokasi" class="form-control form-control-custom" placeholder="e.g. Jakarta">
                            </div>

                            <!-- Deskripsi Pekerjaan -->
                            <div class="col-12">
                                <label for="postingDeskripsi" class="form-label-custom fw-bold">Deskripsi Pekerjaan</label>
                                <textarea id="postingDeskripsi" name="deskripsi" class="form-control form-control-custom" rows="4" placeholder="Jelaskan tentang posisi ini, tanggung jawab dan apa yang dicari (Opsional)"></textarea>
                            </div>
                            
                            <!-- Link -->
                            <div class="col-12">
                                <label for="postingLink" class="form-label-custom fw-bold">Link</label>
                                <input type="text" id="postingLink" name="link" class="form-control form-control-custom" placeholder="e.g. https://www.TechCorp.com/...">
                            </div>

                            <!-- Gambar -->
                            <div class="col-12">
                                <label class="form-label-custom fw-bold">Gambar</label>
                                <div>
                                    <!-- Input file disembunyikan -->
                                    <input type="file" class="form-control d-none" id="postingGambarInput" name="gambar">
                                    <!-- Label ini berfungsi sebagai tombol -->
                                    <label for="postingGambarInput" class="btn btn-upload-foto">
                                        Upload Foto
                                    </label>
                                </div>
                            </div>

                        </div>
                        
                        <!-- Tombol Submit -->
                        <div class="text-center mt-4">
                            <button type="submit" id="submitPosting" class="btn btn-posting-black">Posting</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
                <div class="modal-body text-center p-4">
                    <h5 class="fw-bold mb-2">Hapus Posting?</h5>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="button" id="confirmDeleteBtn" class="btn btn-danger btn-sm px-4">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logic Modal Posting
            const openPostingBtn = document.getElementById('openPostingBtn');
            const postingModalElement = document.getElementById('postingModal');
            if (openPostingBtn && postingModalElement) {
                const postingModal = new bootstrap.Modal(postingModalElement);
                openPostingBtn.addEventListener('click', () => {
                    // Reset form
                    document.getElementById('postingForm').reset();
                    document.getElementById('submitPosting').textContent = 'Posting';
                    postingModal.show();
                });
            }

            // Logic Edit
            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-edit')) {
                    const postingModal = new bootstrap.Modal(document.getElementById('postingModal'));
                    
                    // Simulasi isi data (ganti dengan data asli nanti)
                    document.getElementById('postingCompany').value = "JW Marriott";
                    document.getElementById('postingPosition').value = "Frontend Developer";
                    document.getElementById('postingLokasi').value = "Medan";
                    document.getElementById('postingDeskripsi').value = "Kami sedang mencari Frontend Developer...";
                    document.getElementById('postingLink').value = "https://...";
                    document.getElementById('postingTipeInput').value = "Full-time";
                    document.getElementById('postingKategoriInput').value = "Teknologi";
                    
                    document.getElementById('submitPosting').textContent = 'Simpan Perubahan';
                    postingModal.show();
                }
            });

            // Logic Hapus
            let cardToDelete = null;
            const deleteModalElement = document.getElementById('deleteConfirmModal');
            const deleteModal = deleteModalElement ? new bootstrap.Modal(deleteModalElement) : null;

            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-delete')) {
                    cardToDelete = e.target.closest('.card');
                    if(deleteModal) deleteModal.show();
                }
            });

            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            if (confirmDeleteBtn) {
                confirmDeleteBtn.addEventListener('click', function() {
                    if (cardToDelete) {
                        const id = cardToDelete.getAttribute('data-id');
                        // submit server-side delete form if available
                        const form = document.getElementById('delete-form-' + id);
                        if (form) {
                            form.submit();
                        } else {
                            // fallback: remove from DOM
                            cardToDelete.remove();
                        }
                        if(deleteModal) deleteModal.hide();
                    }
                });
            }

            // when clicking delete button, set cardToDelete to the card element and show modal
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-delete');
                if (btn) {
                    const id = btn.getAttribute('data-id');
                    const card = btn.closest('.card');
                    if (card) card.setAttribute('data-id', id);
                    cardToDelete = card;
                    if(deleteModal) deleteModal.show();
                }
            });
        });
    </script>

@endsection