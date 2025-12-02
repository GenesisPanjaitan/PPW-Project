@extends('layouts.admin')

@section('title', 'Data Lowongan - Admin CareerConnect')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Lowongan</h1>
            <a href="#" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Lowongan
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Lowongan Kerja</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Lowongan</th>
                                <th>Perusahaan</th>
                                <th>Lokasi</th>
                                <th>Tipe</th>
                                <th>Tanggal Posting</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($lowongan) && count($lowongan) > 0)
                                @foreach($lowongan as $index => $job)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $job->title ?? 'N/A' }}</td>
                                    <td>{{ $job->company ?? 'N/A' }}</td>
                                    <td>{{ $job->location ?? 'Remote' }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $job->job_type ?? 'Full-time' }}</span>
                                    </td>
                                    <td>{{ $job->created_at ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-success">Aktif</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.lowongan.detail', $job->id ?? 1) }}" class="btn btn-sm btn-info">Detail</a>
                                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data lowongan</td>
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