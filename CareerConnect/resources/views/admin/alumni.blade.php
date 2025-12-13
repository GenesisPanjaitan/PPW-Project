@extends('layouts.admin')

@section('title', 'Data Alumni - Admin CareerConnect')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <h1 class="h3 mb-1 text-gray-800 fw-bold">Data Alumni</h1>
            <p class="text-muted mb-0">Kelola data alumni yang terdaftar di CareerConnect</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 1rem;">
            <div class="card-header py-3 bg-white border-0" style="border-bottom: 2px solid #f0f0f0; border-radius: 1rem 1rem 0 0;">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-dark">
                        <i class="bi bi-mortarboard-fill me-2 text-success"></i>Daftar Alumni Terdaftar
                    </h6>
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">Total: {{ count($alumni) }} alumni</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="border-radius: 0 0 1rem 1rem; overflow: hidden;">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 text-muted fw-semibold" style="width: 5%;">No</th>
                                <th class="px-4 py-3 text-muted fw-semibold" style="width: 24%;">Nama</th>
                                <th class="px-4 py-3 text-muted fw-semibold" style="width: 24%;">Email</th>
                                <th class="px-4 py-3 text-muted fw-semibold" style="width: 14%;">Tahun Lulus</th>
                                <th class="px-4 py-3 text-muted fw-semibold" style="width: 20%;">Bidang</th>
                                <th class="px-4 py-3 text-muted fw-semibold" style="width: 13%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($alumni) && count($alumni) > 0)
                                @foreach($alumni as $index => $alum)
                                <tr class="border-bottom">
                                    <td class="px-4 py-3 text-muted">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="bi bi-mortarboard-fill text-success"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-dark">{{ $alum->name ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-muted"><i class="bi bi-envelope me-1"></i>{{ $alum->email ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                            <i class="bi bi-calendar-check me-1"></i>{{ $alum->graduation_year ?? '2024' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($alum->current_field)
                                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                                @switch($alum->current_field)
                                                    @case('swe') <i class="bi bi-code-slash me-1"></i>Software Engineering @break
                                                    @case('uiux') <i class="bi bi-palette me-1"></i>UI/UX Design @break
                                                    @case('data') <i class="bi bi-bar-chart me-1"></i>Data Science @break
                                                    @case('product') <i class="bi bi-box-seam me-1"></i>Product Management @break
                                                    @case('digital_marketing') <i class="bi bi-megaphone me-1"></i>Digital Marketing @break
                                                    @case('qa_testing') <i class="bi bi-bug me-1"></i>QA & Testing @break
                                                    @case('cybersecurity') <i class="bi bi-shield-lock me-1"></i>Cybersecurity @break
                                                    @case('operations') <i class="bi bi-gear me-1"></i>Operations @break
                                                    @case('lainnya') <i class="bi bi-three-dots me-1"></i>Lainnya @break
                                                    @default <i class="bi bi-briefcase me-1"></i>{{ $alum->current_field }}
                                                @endswitch
                                            </span>
                                        @else
                                            <span class="text-muted fst-italic">Belum diatur</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.alumni.detail', $alum->id ?? 1) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.alumni.delete', $alum->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun alumni {{ $alum->name }}? Tindakan ini tidak dapat dibatalkan!')">
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
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                                            <p class="mb-0 fw-semibold">Belum ada data alumni</p>
                                            <small>Data alumni yang mendaftar akan muncul di sini</small>
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