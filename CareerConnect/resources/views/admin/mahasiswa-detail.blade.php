@extends('layouts.admin')

@section('title', 'Detail Mahasiswa - Admin CareerConnect')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Mahasiswa</h1>
            <a href="{{ route('admin.mahasiswa') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Mahasiswa</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" style="width: 200px;">Nama Lengkap:</td>
                                <td>{{ $mahasiswa->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Email:</td>
                                <td>{{ $mahasiswa->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">NIM:</td>
                                <td>{{ $mahasiswa->nim ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Program Studi:</td>
                                <td>{{ $mahasiswa->study_program ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Kelas:</td>
                                <td>{{ $mahasiswa->class ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Daftar:</td>
                                <td>{{ $mahasiswa->created_at ? $mahasiswa->created_at->format('d M Y H:i') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Last Login:</td>
                                <td>{{ $mahasiswa->updated_at ? $mahasiswa->updated_at->format('d M Y H:i') : 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    @if($mahasiswa->image && file_exists(public_path('storage/profile_photos/' . $mahasiswa->image)))
                                        <img src="{{ asset('storage/profile_photos/' . $mahasiswa->image) }}" 
                                             class="rounded-circle" width="120" height="120" alt="Foto Profil" style="object-fit: cover;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->name ?? 'User') }}&background=667eea&color=fff&size=120" 
                                             class="rounded-circle" width="120" height="120" alt="Avatar">
                                    @endif
                                </div>
                                <h6 class="card-title">Status Akun</h6>
                                <span class="badge bg-success fs-6">Aktif</span>
                                <hr>
                                <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash me-2"></i>Hapus Akun
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(isset($mahasiswa->skills) && $mahasiswa->skills)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6 class="fw-bold mb-3">Skills:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(explode(',', $mahasiswa->skills) as $skill)
                                <span class="badge bg-primary">{{ trim($skill) }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($mahasiswa->bio) && $mahasiswa->bio)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6 class="fw-bold mb-3">Bio:</h6>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($mahasiswa->bio)) !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Aktivitas Mahasiswa -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Aktivitas & Statistik</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="border-end">
                            <h4 class="text-primary">0</h4>
                            <small class="text-muted">Lamaran Dikirim</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border-end">
                            <h4 class="text-warning">0</h4>
                            <small class="text-muted">Dalam Review</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border-end">
                            <h4 class="text-success">0</h4>
                            <small class="text-muted">Diterima</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="text-info">0</h4>
                        <small class="text-muted">Favorit Lowongan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection