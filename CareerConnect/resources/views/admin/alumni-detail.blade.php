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
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($alumni->name ?? 'User') }}&background=48c78e&color=fff&size=120" 
                                         class="rounded-circle" width="120" height="120" alt="Avatar">
                                </div>
                                <h6 class="card-title">Status Akun</h6>
                                <span class="badge bg-success fs-6">Aktif</span>
                                <hr>
                                <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-warning btn-sm">
                                        <i class="bi bi-lock me-2"></i>Suspend Akun
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash me-2"></i>Hapus Akun
                                    </a>
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
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kontribusi Alumni</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="border-end">
                            <h4 class="text-success">0</h4>
                            <small class="text-muted">Lowongan Dibuat</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border-end">
                            <h4 class="text-info">0</h4>
                            <small class="text-muted">Mahasiswa Direkrut</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border-end">
                            <h4 class="text-warning">0</h4>
                            <small class="text-muted">Forum Aktif</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="text-primary">0</h4>
                        <small class="text-muted">Mentoring</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection