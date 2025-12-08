@extends('layouts.admin')

@section('title', 'Detail Lowongan - Admin CareerConnect')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Lowongan</h1>
            <a href="{{ route('admin.lowongan') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Lowongan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-light mb-3">
                            <div class="card-body text-center">
                                <h6 class="card-title mb-3">Foto Perusahaan</h6>
                                @if($lowongan->company_image && file_exists(public_path('storage/company_photos/' . $lowongan->company_image)))
                                    <img src="{{ asset('storage/company_photos/' . $lowongan->company_image) }}" 
                                         class="img-fluid rounded" alt="Foto Perusahaan" style="max-height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary bg-opacity-10 rounded p-5">
                                        <i class="bi bi-building" style="font-size: 3rem; color: #6c757d;"></i>
                                        <p class="text-muted mt-2">Tidak ada foto perusahaan</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <td class="fw-bold" style="width: 200px;">Posisi:</td>
                                <td>{{ $lowongan->position ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Perusahaan:</td>
                                <td>{{ $lowongan->company_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Lokasi:</td>
                                <td>{{ $lowongan->location ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Kategori:</td>
                                <td>
                                    <span class="badge bg-primary">{{ $lowongan->category_name ?? 'N/A' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tipe Pekerjaan:</td>
                                <td>
                                    <span class="badge bg-info">{{ $lowongan->jobtype_name ?? 'Full-time' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Diposting oleh:</td>
                                <td>{{ $lowongan->posted_by ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Posting:</td>
                                <td>{{ $lowongan->created_at ? \Carbon\Carbon::parse($lowongan->created_at)->format('d M Y H:i') : 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h6 class="card-title">Status Lowongan</h6>
                                <span class="badge bg-success fs-6">Aktif</span>
                                <hr>
                                <div class="d-grid gap-2">
                                    <form action="{{ route('admin.lowongan.delete', $lowongan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lowongan ini? Semua komentar yang terkait juga akan terhapus!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash me-2"></i>Hapus Lowongan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(isset($lowongan->description) && $lowongan->description)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6 class="fw-bold mb-3">Deskripsi Pekerjaan:</h6>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($lowongan->description)) !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($lowongan->requirements) && $lowongan->requirements)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6 class="fw-bold mb-3">Persyaratan:</h6>
                        <div class="p-3 bg-light rounded">
                            {!! nl2br(e($lowongan->requirements)) !!}
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($lowongan->skills) && $lowongan->skills)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6 class="fw-bold mb-3">Skill yang Dibutuhkan:</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(explode(',', $lowongan->skills) as $skill)
                                <span class="badge bg-primary">{{ trim($skill) }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Statistik Lowongan -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik Lowongan</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="border-end">
                            <h4 class="text-primary">{{ $commentCount ?? 0 }}</h4>
                            <small class="text-muted">Total Komentar</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border-end">
                            <h4 class="text-warning">{{ $favoriteCount ?? 0 }}</h4>
                            <small class="text-muted">Dijadikan Favorit</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-info">{{ $lowongan->created_at ? \Carbon\Carbon::parse($lowongan->created_at)->diffForHumans() : 'N/A' }}</h4>
                        <small class="text-muted">Waktu Rilis</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection