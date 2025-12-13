@extends('layouts.admin')

@section('title', 'Data Mahasiswa - Admin CareerConnect')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <h1 class="h3 mb-1 text-gray-800 fw-bold">Data Mahasiswa</h1>
            <p class="text-muted mb-0">Kelola data mahasiswa yang terdaftar di CareerConnect</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 1rem;">
            <div class="card-header py-3 bg-white border-0" style="border-bottom: 2px solid #f0f0f0; border-radius: 1rem 1rem 0 0;">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-dark">
                        <i class="bi bi-people-fill me-2 text-primary"></i>Daftar Mahasiswa Terdaftar
                    </h6>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">Total: {{ count($mahasiswa) }} mahasiswa</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="border-radius: 0 0 1rem 1rem; overflow: hidden;">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 text-muted fw-semibold" style="width: 5%;">No</th>
                                <th class="px-4 py-3 text-muted fw-semibold" style="width: 28%;">Nama</th>
                                <th class="px-4 py-3 text-muted fw-semibold" style="width: 30%;">Email</th>
                                <th class="px-4 py-3 text-muted fw-semibold" style="width: 20%;">Tanggal Daftar</th>
                                <th class="px-4 py-3 text-muted fw-semibold" style="width: 17%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($mahasiswa) && count($mahasiswa) > 0)
                                @foreach($mahasiswa as $index => $mhs)
                                <tr class="border-bottom">
                                    <td class="px-4 py-3 text-muted">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="bi bi-person-fill text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-dark">{{ $mhs->name ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-muted"><i class="bi bi-envelope me-1"></i>{{ $mhs->email ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $mhs->created_at ? $mhs->created_at->format('d/m/Y') : 'N/A' }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.mahasiswa.detail', $mhs->id ?? 1) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.mahasiswa.delete', $mhs->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun mahasiswa {{ $mhs->name }}? Tindakan ini tidak dapat dibatalkan!')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                                            <p class="mb-0 fw-semibold">Belum ada data mahasiswa</p>
                                            <small>Data mahasiswa yang mendaftar akan muncul di sini</small>
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