@extends('layouts.admin')

@section('title', 'Pendaftaran Terbaru - Admin CareerConnect')

@section('content')

<!-- Page Heading -->
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2 text-gray-800">Pendaftaran Terbaru</h1>
                <p class="text-muted">Kelola data mahasiswa dan alumni yang baru bergabung</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pendaftaran Terbaru</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Mahasiswa Terdaftar
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mahasiswaCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-mortarboard-fill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Alumni Terdaftar
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alumniCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="row">
    <!-- Mahasiswa Section -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3 bg-gradient-primary text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">
                        <i class="bi bi-mortarboard-fill me-2"></i>Mahasiswa Terbaru
                    </h6>
                    <span class="badge bg-light text-primary">{{ $mahasiswaCount }} Total</span>
                </div>
            </div>
            <div class="card-body">
                @if($recentMahasiswa->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Profil</th>
                                    <th>Informasi</th>
                                    <th>Tanggal Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentMahasiswa as $mahasiswa)
                                <tr>
                                    <td>
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->name) }}&background=667eea&color=fff&size=40" 
                                             class="rounded-circle" width="40" height="40" alt="Avatar">
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $mahasiswa->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $mahasiswa->email }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <small>{{ $mahasiswa->created_at->format('d M Y') }}</small>
                                        @if($mahasiswa->created_at->isToday())
                                            <br><span class="badge bg-warning">Hari ini</span>
                                        @elseif($mahasiswa->created_at->isYesterday())
                                            <br><span class="badge bg-info">Kemarin</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-2">Belum ada mahasiswa yang mendaftar</p>
                    </div>
                @endif
                
                <div class="text-center mt-3">
                    <a href="{{ route('admin.mahasiswa') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-eye me-1"></i>Lihat Semua Mahasiswa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alumni Section -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3 bg-gradient-success text-white">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold">
                        <i class="bi bi-people-fill me-2"></i>Alumni Terbaru
                    </h6>
                    <span class="badge bg-light text-success">{{ $alumniCount }} Total</span>
                </div>
            </div>
            <div class="card-body">
                @if($recentAlumni->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Profil</th>
                                    <th>Informasi</th>
                                    <th>Tanggal Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentAlumni as $alumni)
                                <tr>
                                    <td>
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($alumni->name) }}&background=48c78e&color=fff&size=40" 
                                             class="rounded-circle" width="40" height="40" alt="Avatar">
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $alumni->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $alumni->email }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <small>{{ $alumni->created_at->format('d M Y') }}</small>
                                        @if($alumni->created_at->isToday())
                                            <br><span class="badge bg-warning">Hari ini</span>
                                        @elseif($alumni->created_at->isYesterday())
                                            <br><span class="badge bg-info">Kemarin</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-2">Belum ada alumni yang mendaftar</p>
                    </div>
                @endif
                
                <div class="text-center mt-3">
                    <a href="{{ route('admin.alumni') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-eye me-1"></i>Lihat Semua Alumni
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.mahasiswa') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="bi bi-mortarboard-fill d-block mb-2" style="font-size: 2rem;"></i>
                            <strong>Kelola Mahasiswa</strong>
                            <small class="d-block text-muted">Lihat, edit, hapus data mahasiswa</small>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.alumni') }}" class="btn btn-outline-success w-100 py-3">
                            <i class="bi bi-people-fill d-block mb-2" style="font-size: 2rem;"></i>
                            <strong>Kelola Alumni</strong>
                            <small class="d-block text-muted">Lihat, edit, hapus data alumni</small>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.lowongan') }}" class="btn btn-outline-warning w-100 py-3">
                            <i class="bi bi-briefcase-fill d-block mb-2" style="font-size: 2rem;"></i>
                            <strong>Kelola Lowongan</strong>
                            <small class="d-block text-muted">Lihat, edit, hapus lowongan kerja</small>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-info w-100 py-3">
                            <i class="bi bi-speedometer2 d-block mb-2" style="font-size: 2rem;"></i>
                            <strong>Kembali ke Dashboard</strong>
                            <small class="d-block text-muted">Lihat statistik keseluruhan</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection