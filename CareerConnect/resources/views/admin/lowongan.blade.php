@extends('layouts.admin')

@section('title', 'Data Lowongan - Admin CareerConnect')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <h1 class="h3 mb-1 text-gray-800 fw-bold">Data Lowongan</h1>
            <p class="text-muted mb-0">Kelola lowongan kerja yang diposting oleh alumni</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 1rem;">
            <div class="card-header py-3 bg-white border-0" style="border-bottom: 2px solid #f0f0f0; border-radius: 1rem 1rem 0 0;">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-dark">
                        <i class="bi bi-briefcase-fill me-2 text-warning"></i>Daftar Lowongan dari Alumni
                    </h6>
                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">Total: {{ count($lowongan) }} lowongan</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="border-radius: 0 0 1rem 1rem; overflow: hidden;">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 text-muted fw-semibold" width="5%">No</th>
                                <th class="px-4 py-3 text-muted fw-semibold" width="12%">Logo</th>
                                <th class="px-4 py-3 text-muted fw-semibold" width="18%">Perusahaan</th>
                                <th class="px-4 py-3 text-muted fw-semibold" width="15%">Posisi</th>
                                <th class="px-4 py-3 text-muted fw-semibold" width="12%">Lokasi</th>
                                <th class="px-4 py-3 text-muted fw-semibold" width="10%">Kategori</th>
                                <th class="px-4 py-3 text-muted fw-semibold" width="10%">Tipe</th>
                                <th class="px-4 py-3 text-muted fw-semibold" width="10%">Diposting</th>
                                <th class="px-4 py-3 text-muted fw-semibold" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($lowongan) && count($lowongan) > 0)
                                @foreach($lowongan as $index => $job)
                                <tr class="border-bottom">
                                    <td class="px-4 py-3 text-muted">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @if($job->image && file_exists(public_path('storage/recruitment/' . $job->image)))
                                            <img src="{{ asset('storage/recruitment/' . $job->image) }}" 
                                                 class="rounded shadow-sm" width="60" height="45" alt="Logo {{ $job->company_name }}" style="object-fit: cover;">
                                        @else
                                            <div class="bg-warning bg-opacity-10 rounded shadow-sm d-flex align-items-center justify-content-center mx-auto" style="width: 60px; height: 45px;">
                                                <i class="bi bi-building text-warning fs-5"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="fw-semibold text-dark">{{ $job->company_name }}</div>
                                        <small class="text-muted"><i class="bi bi-person-circle me-1"></i>{{ $job->posted_by }}</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-dark fw-medium">{{ $job->position }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-muted"><i class="bi bi-geo-alt-fill me-1"></i>{{ $job->location }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">{{ $job->category_name }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">{{ $job->jobtype_name }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($job->created_at)->format('d M Y') }}</small>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.lowongan.detail', $job->id) }}" class="btn btn-sm btn-outline-primary rounded-pill" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.lowongan.delete', $job->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lowongan ini? Semua komentar yang terkait juga akan terhapus!')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" title="Hapus Lowongan">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                            <p class="mb-0">Belum ada data lowongan kerja</p>
                                            <small>Lowongan yang diposting alumni akan muncul di sini</small>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection