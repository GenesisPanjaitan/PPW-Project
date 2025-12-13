@extends('layouts.admin')

@section('title', 'Pendaftaran Terbaru - Admin CareerConnect')

@section('content')

<!-- Page Heading -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-lg" style="border-radius: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); overflow: hidden;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="text-white">
                        <h1 class="h2 mb-2 fw-bold">
                            <i class="bi bi-person-plus-fill me-3"></i>Pendaftaran Terbaru
                        </h1>
                        <p class="mb-0 opacity-90">
                            <i class="bi bi-info-circle me-2"></i>Kelola data mahasiswa dan alumni yang baru bergabung
                        </p>
                    </div>
                    <nav aria-label="breadcrumb" class="mt-3 mt-md-0">
                        <ol class="breadcrumb mb-0 bg-white bg-opacity-10 rounded-pill px-4 py-2">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none">
                                    <i class="bi bi-house-fill me-1"></i>Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-white fw-bold">Pendaftaran Terbaru</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="row">
    <!-- Mahasiswa Section -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow-lg border-0 h-100" style="border-radius: 1rem; overflow: hidden;">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-white">
                        <i class="bi bi-mortarboard-fill me-2"></i>Mahasiswa Terbaru
                    </h6>
                    <span class="badge rounded-pill bg-white text-primary px-3 py-2">{{ $mahasiswaCount }} Total</span>
                </div>
            </div>
            <div class="card-body p-0">
                @if($recentMahasiswa->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentMahasiswa as $index => $mahasiswa)
                        <div class="list-group-item border-0 registration-item" style="animation: fadeInLeft {{ 0.1 * ($index + 1) }}s ease-out;">
                            <div class="d-flex align-items-center justify-content-between py-2">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="position-relative me-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->name) }}&background=667eea&color=fff&size=56" 
                                             class="rounded-circle avatar-img" width="56" height="56" alt="Avatar">
                                        <span class="position-absolute bottom-0 end-0 badge rounded-pill" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            <i class="bi bi-mortarboard-fill" style="font-size: 0.75rem;"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-semibold" style="color: #2d3748;">{{ $mahasiswa->name }}</h6>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <small class="text-muted">
                                                <i class="bi bi-envelope me-1"></i>{{ $mahasiswa->email }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end ms-3">
                                    <small class="text-muted d-block">
                                        <i class="bi bi-calendar3 me-1"></i>{{ $mahasiswa->created_at->format('d M Y') }}
                                    </small>
                                    @if($mahasiswa->created_at->isToday())
                                        <span class="badge bg-warning bg-opacity-25 text-warning pulse-badge mt-1">
                                            <i class="bi bi-star-fill me-1"></i>Hari ini
                                        </span>
                                    @elseif($mahasiswa->created_at->isYesterday())
                                        <span class="badge bg-info bg-opacity-25 text-info mt-1">
                                            <i class="bi bi-clock me-1"></i>Kemarin
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 4rem; color: #cbd5e0;"></i>
                        <p class="text-muted mt-3 mb-0 fw-medium">Belum ada mahasiswa yang mendaftar</p>
                    </div>
                @endif
                
                <div class="text-center p-3 border-top bg-light">
                    <a href="{{ route('admin.mahasiswa') }}" class="btn btn-primary rounded-pill px-4 hover-lift">
                        <i class="bi bi-eye me-2"></i>Lihat Semua Mahasiswa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alumni Section -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow-lg border-0 h-100" style="border-radius: 1rem; overflow: hidden;">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #48c78e 0%, #06d6a0 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="m-0 fw-bold text-white">
                        <i class="bi bi-people-fill me-2"></i>Alumni Terbaru
                    </h6>
                    <span class="badge rounded-pill bg-white text-success px-3 py-2">{{ $alumniCount }} Total</span>
                </div>
            </div>
            <div class="card-body p-0">
                @if($recentAlumni->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentAlumni as $index => $alumni)
                        <div class="list-group-item border-0 registration-item alumni-item" style="animation: fadeInRight {{ 0.1 * ($index + 1) }}s ease-out;">
                            <div class="d-flex align-items-center justify-content-between py-2">
                                <div class="d-flex align-items-center flex-grow-1">
                                    <div class="position-relative me-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($alumni->name) }}&background=48c78e&color=fff&size=56" 
                                             class="rounded-circle avatar-img" width="56" height="56" alt="Avatar">
                                        <span class="position-absolute bottom-0 end-0 badge rounded-pill" style="background: linear-gradient(135deg, #48c78e 0%, #06d6a0 100%);">
                                            <i class="bi bi-briefcase-fill" style="font-size: 0.75rem;"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-semibold" style="color: #2d3748;">{{ $alumni->name }}</h6>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <small class="text-muted">
                                                <i class="bi bi-envelope me-1"></i>{{ $alumni->email }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end ms-3">
                                    <small class="text-muted d-block">
                                        <i class="bi bi-calendar3 me-1"></i>{{ $alumni->created_at->format('d M Y') }}
                                    </small>
                                    @if($alumni->created_at->isToday())
                                        <span class="badge bg-warning bg-opacity-25 text-warning pulse-badge mt-1">
                                            <i class="bi bi-star-fill me-1"></i>Hari ini
                                        </span>
                                    @elseif($alumni->created_at->isYesterday())
                                        <span class="badge bg-info bg-opacity-25 text-info mt-1">
                                            <i class="bi bi-clock me-1"></i>Kemarin
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 4rem; color: #cbd5e0;"></i>
                        <p class="text-muted mt-3 mb-0 fw-medium">Belum ada alumni yang mendaftar</p>
                    </div>
                @endif
                
                <div class="text-center p-3 border-top bg-light">
                    <a href="{{ route('admin.alumni') }}" class="btn btn-success rounded-pill px-4 hover-lift">
                        <i class="bi bi-eye me-2"></i>Lihat Semua Alumni
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
            <div class="card-header py-3" style="background: linear-gradient(135deg, rgba(107, 92, 231, 0.1) 0%, rgba(107, 92, 231, 0.05) 100%); border-bottom: 2px solid rgba(107, 92, 231, 0.1);">
                <h6 class="m-0 fw-bold" style="color: #6b5ce7;">
                    <i class="bi bi-lightning-charge-fill me-2"></i>Aksi Cepat
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="row text-center g-3">
                    <div class="col-md-3">
                        <a href="{{ route('admin.mahasiswa') }}" class="quick-action-link text-decoration-none">
                            <div class="quick-action-box p-4" style="border: 2px solid #667eea; border-radius: 1rem;">
                                <div class="quick-action-icon mb-3">
                                    <i class="bi bi-mortarboard-fill" style="font-size: 2.5rem; color: #667eea;"></i>
                                </div>
                                <h6 class="fw-bold mb-2" style="color: #2d3748;">Kelola Mahasiswa</h6>
                                <small class="text-muted">Lihat, edit, hapus data mahasiswa</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.alumni') }}" class="quick-action-link text-decoration-none">
                            <div class="quick-action-box p-4" style="border: 2px solid #48c78e; border-radius: 1rem;">
                                <div class="quick-action-icon mb-3">
                                    <i class="bi bi-people-fill" style="font-size: 2.5rem; color: #48c78e;"></i>
                                </div>
                                <h6 class="fw-bold mb-2" style="color: #2d3748;">Kelola Alumni</h6>
                                <small class="text-muted">Lihat, edit, hapus data alumni</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.lowongan') }}" class="quick-action-link text-decoration-none">
                            <div class="quick-action-box p-4" style="border: 2px solid #ffa726; border-radius: 1rem;">
                                <div class="quick-action-icon mb-3">
                                    <i class="bi bi-briefcase-fill" style="font-size: 2.5rem; color: #ffa726;"></i>
                                </div>
                                <h6 class="fw-bold mb-2" style="color: #2d3748;">Kelola Lowongan</h6>
                                <small class="text-muted">Lihat, edit, hapus lowongan kerja</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.dashboard') }}" class="quick-action-link text-decoration-none">
                            <div class="quick-action-box p-4" style="border: 2px solid #17a2b8; border-radius: 1rem;">
                                <div class="quick-action-icon mb-3">
                                    <i class="bi bi-speedometer2" style="font-size: 2.5rem; color: #17a2b8;"></i>
                                </div>
                                <h6 class="fw-bold mb-2" style="color: #2d3748;">Kembali ke Dashboard</h6>
                                <small class="text-muted">Lihat statistik keseluruhan</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Stats Cards Animation */
    .stats-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stats-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
    }

    /* Registration Items Animation */
    .registration-item {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-left: 3px solid transparent !important;
    }

    .registration-item:hover {
        background: linear-gradient(90deg, rgba(102, 126, 234, 0.05) 0%, transparent 100%) !important;
        border-left-color: #667eea !important;
        transform: translateX(5px);
    }

    .alumni-item:hover {
        background: linear-gradient(90deg, rgba(72, 199, 142, 0.05) 0%, transparent 100%) !important;
        border-left-color: #48c78e !important;
    }

    .registration-item .avatar-img {
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .registration-item:hover .avatar-img {
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .alumni-item:hover .avatar-img {
        box-shadow: 0 8px 20px rgba(72, 199, 142, 0.3);
    }

    .pulse-badge {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.05);
            opacity: 0.9;
        }
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    /* Quick Action Links */
    .quick-action-link {
        display: block;
        transition: all 0.3s ease;
    }

    .quick-action-box {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
    }

    .quick-action-link:hover .quick-action-box {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .quick-action-link:hover .quick-action-icon i {
        transform: scale(1.15) rotate(5deg);
        transition: transform 0.3s ease;
    }
</style>

@endsection