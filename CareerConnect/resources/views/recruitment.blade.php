@extends('layouts.app')

@section('content')

    <!-- Navbar (TETAP) -->
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
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>
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

    <!-- PERUBAHAN: Mengganti bg-light dengan background-color lavender -->
    <main class="py-5" style="background-color: #F8F7FF; min-height: 100vh;">
        <div class="container">

            <!-- HEADER SECTION -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-end mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-primary">Recruitment Hub</h2>
                    <p class="text-muted mb-0 small">Temukan peluang karir terbaik dari alumni.</p>
                </div>
                
                <div class="mt-3 mt-md-0">
                    @auth
                        @if(auth()->user()->role === 'alumni' || auth()->user()->role === 'admin')
                            <button id="openPostingBtn" class="btn btn-dark btn-sm rounded-pill px-4 py-2 shadow-sm hover-scale fw-bold">
                                <i class="bi bi-plus-lg me-1"></i> Posting Lowongan
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-dark btn-sm rounded-pill px-4 py-2 shadow-sm hover-scale fw-bold">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login untuk Posting
                        </a>
                    @endauth
                </div>
            </div>

            <!-- SEARCH & FILTER BAR -->
            <div class="card border-0 shadow-sm rounded-4 mb-5 p-2">
                <div class="card-body p-1">
                    <form action="{{ route('recruitment') }}" method="GET">
                        <div class="row g-2 align-items-center">
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-0 text-muted ps-3"><i class="bi bi-search"></i></span>
                                    <input type="text" name="q" class="form-control border-0 shadow-none" placeholder="Cari posisi atau perusahaan..." value="{{ request('q') }}">
                                </div>
                            </div>
                            <div class="col-auto d-none d-lg-block">
                                <div class="vr h-100 text-muted opacity-25"></div>
                            </div>
                            <div class="col-lg-3">
                                <select name="type" class="form-select border-0 shadow-none text-muted cursor-pointer" style="background-position: right 0.75rem center;">
                                    <option value="">Semua Tipe Pekerjaan</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Internship">Internship</option>
                                </select>
                            </div>
                            <div class="col-auto d-none d-lg-block">
                                <div class="vr h-100 text-muted opacity-25"></div>
                            </div>
                            <div class="col-lg-2">
                                <select name="category" class="form-select border-0 shadow-none text-muted cursor-pointer">
                                    <option value="">Semua Kategori</option>
                                    <option value="Teknologi">Teknologi</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Desain">Desain</option>
                                </select>
                            </div>
                            <div class="col-lg-1 d-grid">
                                <button type="submit" class="btn btn-primary rounded-3 shadow-sm"><i class="bi bi-arrow-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- LIST LOWONGAN -->
            <div class="row">
                @if(session('success'))
                    <div class="col-12 mb-4">
                        <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center">
                            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    </div>
                @endif

                @forelse($recruitments ?? [] as $r)
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow-sm rounded-4 hover-shadow transition-all bg-white position-relative overflow-hidden">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    
                                    <!-- Kiri: Info Utama -->
                                    <div class="col-lg-8 mb-3 mb-lg-0">
                                        <div class="d-flex align-items-start">
                                            <!-- Logo Placeholder -->
                                            <div class="bg-light rounded-4 d-flex align-items-center justify-content-center me-4 border" style="width: 65px; height: 65px; min-width: 65px;">
                                                <i class="bi bi-building fs-3 text-secondary opacity-50"></i>
                                            </div>
                                            
                                            <div>
                                                <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                                                    <h5 class="fw-bold mb-0 text-dark">
                                                        <!-- STRETCHED LINK MEMBUAT SELURUH KARTU KLIKABLE -->
                                                        <a href="{{ route('recruitment.detail', ['id' => $r->id]) }}" class="text-decoration-none text-dark stretched-link">
                                                            {{ $r->position }}
                                                        </a>
                                                    </h5>
                                                    @if($r->jobtype)
                                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 border border-primary border-opacity-10">{{ $r->jobtype }}</span>
                                                    @endif
                                                </div>
                                                
                                                <p class="text-muted mb-2 fw-medium" style="font-size: 0.95rem;">
                                                    {{ $r->company_name }} 
                                                    <span class="mx-2 text-light-gray">•</span> 
                                                    <span class="text-secondary"><i class="bi bi-geo-alt-fill text-danger small me-1"></i> {{ $r->location }}</span>
                                                </p>
                                                
                                                <div class="d-flex align-items-center text-muted small">
                                                    <span class="me-3 d-flex align-items-center bg-light px-2 py-1 rounded border border-light">
                                                        <i class="bi bi-person-circle me-2"></i> {{ $r->author ?? 'Alumni' }}
                                                    </span>
                                                    <span><i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($r->date)->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kanan: Tombol Aksi -->
                                    <div class="col-lg-4 text-lg-end position-relative" style="z-index: 2;">
                                        <button class="btn btn-light rounded-circle border mb-3 btn-bookmark-anim shadow-sm" data-bs-toggle="tooltip" title="Simpan">
                                            <i class="bi bi-bookmark"></i>
                                        </button>
                                        
                                        <!-- Tombol Edit & Hapus (Hanya Admin/Owner) -->
                                        @auth
                                            @if(auth()->user()->role === 'admin' || auth()->user()->id === $r->user_id)
                                                <div class="d-flex gap-2 justify-content-lg-end mt-1">
                                                    <button class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-semibold" onclick='openEditModal(@json($r))'>
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>
                                                    <button data-id="{{ $r->id }}" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold btn-delete">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>

                                </div>
                            </div>
                        </div>
                        
                        <!-- Hidden Delete Form -->
                        <form id="delete-form-{{ $r->id }}" action="{{ route('recruitment.destroy', ['id' => $r->id]) }}" method="POST" class="d-none">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5 text-muted">
                            <div class="mb-3 opacity-25">
                                <i class="bi bi-briefcase fs-1"></i>
                            </div>
                            <h5>Belum ada lowongan tersedia</h5>
                            <p>Jadilah yang pertama memposting peluang karir!</p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </main>

    <!-- MODAL POSTING (CREATE) -->
    <div class="modal fade" id="postingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 550px;">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden"> 
                <div class="modal-header border-0 pb-0 pt-4 px-4 bg-white">
                    <div>
                        <h5 class="modal-title fw-bold text-dark">✨ Posting Lowongan</h5>
                        <p class="text-muted small mb-0">Bagikan peluang karir untuk rekan mahasiswa</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-white">
                    <form id="postingForm" method="POST" action="{{ route('recruitment.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Nama Perusahaan</label>
                                <input type="text" name="company" class="form-control bg-light border-0" placeholder="TechCorp..." required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Posisi</label>
                                <input type="text" name="position" class="form-control bg-light border-0" placeholder="Frontend Dev..." required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Kategori</label>
                                <select name="kategori" class="form-select form-select-sm bg-light border-0" required>
                                    <option value="" selected disabled>Pilih...</option>
                                    <option value="Teknologi">Teknologi</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Desain">Desain</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Tipe</label>
                                <select name="tipe" class="form-select form-select-sm bg-light border-0" required>
                                    <option value="" selected disabled>Pilih Tipe</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Internship">Internship</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control bg-light border-0" placeholder="Jakarta, Indonesia">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Deskripsi Singkat</label>
                            <textarea name="deskripsi" class="form-control bg-light border-0" rows="3" placeholder="Jelaskan kualifikasi utama..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Link Pendaftaran</label>
                            <input type="text" name="link" class="form-control bg-light border-0" placeholder="https://...">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">Banner / Logo (Opsional)</label>
                            <div class="upload-area p-3 text-center rounded-3">
                                <i class="bi bi-cloud-arrow-up fs-3 text-muted"></i>
                                <p class="small text-muted mb-0">Klik atau drag gambar ke sini</p>
                                <input type="file" name="gambar" class="file-input-hidden">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 rounded-pill fw-bold py-2 shadow-sm">Posting Sekarang 🚀</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 550px;">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header border-0 pb-0 pt-4 px-4 bg-white">
                    <div>
                        <h5 class="modal-title fw-bold text-dark">✏️ Edit Lowongan</h5>
                        <p class="text-muted small mb-0">Perbarui informasi lowongan ini</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-white">
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Nama Perusahaan</label>
                                <input type="text" id="edit_company" name="company" class="form-control bg-light border-0" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Posisi</label>
                                <input type="text" id="edit_position" name="position" class="form-control bg-light border-0" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Kategori</label>
                                <select id="edit_kategori" name="kategori" class="form-select form-select-sm bg-light border-0">
                                    <option value="">Pilih...</option>
                                    <option value="Teknologi">Teknologi</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Desain">Desain</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Tipe</label>
                                <select id="edit_tipe" name="tipe" class="form-select form-select-sm bg-light border-0">
                                    <option value="">Pilih...</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Internship">Internship</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Lokasi</label>
                            <input type="text" id="edit_lokasi" name="lokasi" class="form-control bg-light border-0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Deskripsi</label>
                            <textarea id="edit_deskripsi" name="deskripsi" class="form-control bg-light border-0" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Link Lamaran</label>
                            <input type="text" id="edit_link" name="link" class="form-control bg-light border-0">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">Update Gambar</label>
                            <div class="upload-area p-3 text-center rounded-3">
                                <i class="bi bi-cloud-arrow-up fs-3 text-muted"></i>
                                <p class="small text-muted mb-0" id="current_image_text">Ganti gambar...</p>
                                <input type="file" name="gambar" class="file-input-hidden">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 rounded-pill fw-bold py-2 shadow-sm">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-body text-center p-4">
                    <div class="mb-3 text-danger"><i class="bi bi-exclamation-circle display-4"></i></div>
                    <h6 class="fw-bold mb-2">Hapus Postingan?</h6>
                    <p class="text-muted small">Tindakan ini tidak bisa dibatalkan.</p>
                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <button type="button" class="btn btn-light btn-sm rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="button" id="confirmDeleteBtn" class="btn btn-danger btn-sm rounded-pill px-4">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        // Change from DOMContentLoaded to window.addEventListener('load', ...) to ensure Bootstrap is fully loaded
        window.addEventListener('load', function() {
            if (typeof bootstrap !== 'undefined') {
                // Logic Create
                const openPostingBtn = document.getElementById('openPostingBtn');
                if (openPostingBtn) {
                    const postingModal = new bootstrap.Modal(document.getElementById('postingModal'));
                    openPostingBtn.addEventListener('click', () => {
                        document.getElementById('postingForm').reset();
                        postingModal.show();
                    });
                }
                
                // Auto-hide Toast Notification
                const toasts = document.querySelectorAll('.toast');
                toasts.forEach(t => {
                    const bsToast = new bootstrap.Toast(t, { delay: 3000 }); // Hilang dalam 3 detik
                    bsToast.show();
                });

                // Logic Delete
                let cardToDelete = null;
                const deleteModalElement = document.getElementById('deleteConfirmModal');
                const deleteModal = deleteModalElement ? new bootstrap.Modal(deleteModalElement) : null;

                document.addEventListener('click', function(e) {
                    if (e.target.closest('.btn-delete')) {
                        const btn = e.target.closest('.btn-delete');
                        const id = btn.getAttribute('data-id');
                        cardToDelete = { id: id };
                        if(deleteModal) deleteModal.show();
                    }
                });

                const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
                if (confirmDeleteBtn) {
                    confirmDeleteBtn.addEventListener('click', function() {
                        if (cardToDelete && cardToDelete.id) {
                            const form = document.getElementById('delete-form-' + cardToDelete.id);
                            if (form) form.submit();
                        }
                        if(deleteModal) deleteModal.hide();
                    });
                }
            } else {
                console.error('Bootstrap JS not loaded');
            }
        });

        // Logic Edit
        function openEditModal(data) {
            if (typeof bootstrap !== 'undefined') {
                var myModal = new bootstrap.Modal(document.getElementById('editModal'));
                myModal.show();

                document.getElementById('edit_company').value = data.company_name;
                document.getElementById('edit_position').value = data.position;
                document.getElementById('edit_lokasi').value = data.location;
                document.getElementById('edit_deskripsi').value = data.description;
                document.getElementById('edit_link').value = data.link;
                
                // Set select values
                document.getElementById('edit_kategori').value = data.kategori || data.category_name; 
                document.getElementById('edit_tipe').value = data.jobtype || data.jobtype_name;

                let imgText = document.getElementById('current_image_text');
                if(data.image) imgText.innerText = "Gambar saat ini tersimpan (Upload baru untuk mengganti)";
                
                let form = document.getElementById('editForm');
                form.action = "/recruitment/" + data.id; 
            } else {
                console.error('Bootstrap JS not loaded');
            }
        }
    </script>

@endsection