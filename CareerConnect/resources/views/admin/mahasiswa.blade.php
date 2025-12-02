@extends('layouts.admin')

@section('title', 'Data Mahasiswa - Admin CareerConnect')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Mahasiswa</h1>
            <a href="#" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Mahasiswa
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Mahasiswa Terdaftar</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($mahasiswa) && count($mahasiswa) > 0)
                                @foreach($mahasiswa as $index => $mhs)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mhs->name ?? 'N/A' }}</td>
                                    <td>{{ $mhs->email ?? 'N/A' }}</td>
                                    <td>{{ $mhs->created_at ? $mhs->created_at->format('d/m/Y') : 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-success">Aktif</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.mahasiswa.detail', $mhs->id ?? 1) }}" class="btn btn-sm btn-info">Detail</a>
                                        <form action="{{ route('admin.mahasiswa.delete', $mhs->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun mahasiswa {{ $mhs->name }}? Tindakan ini tidak dapat dibatalkan!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data mahasiswa</td>
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