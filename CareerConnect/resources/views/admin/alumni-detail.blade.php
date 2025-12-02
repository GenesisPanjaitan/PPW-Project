@extends('layouts.admin')

@section('title', 'Detail Alumni - Admin CareerConnect')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Alumni</h1>
            <a href="{{ route('admin.alumni') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Alumni</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" style="width: 200px;">Nama Lengkap:</td>
                                <td>{{ $alumni->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Email:</td>
                                <td>{{ $alumni->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">NIM:</td>
                                <td>{{ $alumni->nim ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Program Studi:</td>
                                <td>{{ $alumni->study_program ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tahun Lulus:</td>
                                <td>{{ $alumni->graduation_year ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Perusahaan Saat Ini:</td>
                                <td>{{ $alumni->current_company ?? 'Belum bekerja' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Posisi:</td>
                                <td>{{ $alumni->current_position ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Daftar:</td>
                                <td>{{ $alumni->created_at ? $alumni->created_at->format('d M Y H:i') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Last Login:</td>
                                <td>{{ $alumni->updated_at ? $alumni->updated_at->format('d M Y H:i') : 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-gradient-light shadow-sm border-0">
                            <div class="card-body text-center p-4">
                                <div class="position-relative mb-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($alumni->name ?? 'User') }}&background=48c78e&color=fff&size=120" 
                                         class="rounded-circle shadow-sm" width="120" height="120" alt="Avatar">
                                    <div class="position-absolute bottom-0 end-0 bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                        <i class="bi bi-check-lg text-white"></i>
                                    </div>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">{{ $alumni->name ?? 'N/A' }}</h5>
                                <p class="text-muted small mb-3">{{ $alumni->current_position ?? 'Alumni' }}</p>
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 fs-6">
                                    <i class="bi bi-check-circle me-1"></i>Aktif
                                </span>
                                <hr class="my-3">
                                <div class="d-grid">
                                    <form action="{{ route('admin.alumni.delete', $alumni->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun alumni ini? Data tidak dapat dikembalikan!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash me-2"></i>Hapus Akun
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(isset($alumni->skills) && $alumni->skills)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6 class="fw-bold mb-3">Skills & Keahlian:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(explode(',', $alumni->skills) as $skill)
                                <span class="badge bg-success">{{ trim($skill) }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($alumni->experience) && $alumni->experience)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6 class="fw-bold mb-3">Pengalaman Kerja:</h6>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($alumni->experience)) !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($alumni->bio) && $alumni->bio)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6 class="fw-bold mb-3">Bio:</h6>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($alumni->bio)) !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Aktivitas Alumni -->
<div class="row mt-4">
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-gradient-success text-white py-3">
                <h6 class="m-0 fw-bold"><i class="bi bi-briefcase-fill me-2"></i>Kontribusi Alumni</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="p-3">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="bi bi-briefcase-fill text-success fs-4"></i>
                            </div>
                            <h4 class="text-success mt-2 mb-0">{{ $lowonganCount ?? 0 }}</h4>
                            <small class="text-muted">Lowongan Dibuat</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="bi bi-chat-dots-fill text-warning fs-4"></i>
                            </div>
                            <h4 class="text-warning mt-2 mb-0">{{ $forumCount ?? 0 }}</h4>
                            <small class="text-muted">Forum Aktif</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Login Activity -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-gradient-info text-white py-3">
                <h6 class="m-0 fw-bold"><i class="bi bi-activity me-2"></i>Aktivitas Login</h6>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-clock-history text-info fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-info">Last Login</h6>
                        <small class="text-muted">{{ $alumni->updated_at ? $alumni->updated_at->diffForHumans() : 'Belum pernah login' }}</small>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-calendar-check text-primary fs-5"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-primary">Bergabung</h6>
                        <small class="text-muted">{{ $alumni->created_at ? $alumni->created_at->format('d M Y') : 'N/A' }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection