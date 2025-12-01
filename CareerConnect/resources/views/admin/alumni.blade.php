@extends('layouts.admin')

@section('title', 'Data Alumni - Admin CareerConnect')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Alumni</h1>
            <a href="#" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Alumni
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Alumni Terdaftar</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tahun Lulus</th>
                                <th>Perusahaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($alumni) && count($alumni) > 0)
                                @foreach($alumni as $index => $alum)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $alum->name ?? 'N/A' }}</td>
                                    <td>{{ $alum->email ?? 'N/A' }}</td>
                                    <td>{{ $alum->graduation_year ?? '2024' }}</td>
                                    <td>{{ $alum->company ?? 'Belum bekerja' }}</td>
                                    <td>
                                        <span class="badge bg-success">Aktif</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.alumni.detail', $alum->id ?? 1) }}" class="btn btn-sm btn-info">Detail</a>
                                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data alumni</td>
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