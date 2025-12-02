@extends('layouts.admin')

@section('title', 'Data Lowongan - Admin CareerConnect')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Data Lowongan</h1>
                <p class="text-muted mb-0">Lowongan kerja yang diposting oleh alumni</p>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3 bg-gradient-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">
                        <i class="bi bi-briefcase-fill me-2"></i>Daftar Lowongan dari Alumni
                    </h6>
                    <small>Total: {{ count($lowongan) }} lowongan</small>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Logo Perusahaan</th>
                                <th width="20%">Perusahaan</th>
                                <th width="15%">Posisi</th>
                                <th width="12%">Lokasi</th>
                                <th width="10%">Kategori</th>
                                <th width="10%">Tipe</th>
                                <th width="8%">Diposting</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($lowongan) && count($lowongan) > 0)
                                @foreach($lowongan as $index => $job)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="text-center">
                                        @if($job->image && file_exists(public_path('storage/recruitment/' . $job->image)))
                                            <img src="{{ asset('storage/recruitment/' . $job->image) }}" 
                                                 class="rounded" width="60" height="40" alt="Logo {{ $job->company_name }}" style="object-fit: cover;">
                                        @else
                                            <div class="bg-primary bg-opacity-10 rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 40px;">
                                                <i class="bi bi-building text-primary"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $job->company_name }}</div>
                                        <small class="text-muted">Diposting oleh: {{ $job->posted_by }}</small>
                                    </td>
                                    <td>{{ $job->position }}</td>
                                    <td>
                                        <i class="bi bi-geo-alt-fill text-muted me-1"></i>{{ $job->location }}
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">{{ $job->category_name }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info">{{ $job->jobtype_name }}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($job->created_at)->format('d M Y') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.lowongan.detail', $job->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.lowongan.delete', $job->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lowongan ini? Semua komentar yang terkait juga akan terhapus!')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Lowongan">
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