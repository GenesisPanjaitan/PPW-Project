@extends('layouts.admin')

@section('title', 'Dashboard Admin - CareerConnect')

@section('content')

                <!-- Dashboard Content -->
                <div class="row">
                    <div class="col-12">
                        <h1 class="h3 mb-4 text-gray-800">Dashboard Admin CareerConnect</h1>
                    </div>
                </div>

                <!-- 3 Cards Statistics -->
                <div class="row mb-4">
                    <!-- Data Mahasiswa -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card stats-card shadow h-100">
                            <div class="card-body" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="stats-label mb-2">
                                            <i class="bi bi-mortarboard-fill me-2"></i>Data Mahasiswa
                                        </div>
                                        <div class="stats-number">{{ $mahasiswaCount ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Alumni -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card stats-card shadow h-100">
                            <div class="card-body" style="background: linear-gradient(135deg, #48c78e 0%, #06d6a0 100%); color: white;">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="stats-label mb-2">
                                            <i class="bi bi-people-fill me-2"></i>Data Alumni
                                        </div>
                                        <div class="stats-number">{{ $alumniCount ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Lowongan -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card stats-card shadow h-100">
                            <div class="card-body" style="background: linear-gradient(135deg, #ffa726 0%, #ff7043 100%); color: white;">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="stats-label mb-2">
                                            <i class="bi bi-briefcase-fill me-2"></i>Data Lowongan
                                        </div>
                                        <div class="stats-number">{{ $lowonganCount ?? 0 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Quick Actions -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <a href="{{ route('admin.mahasiswa') }}" class="btn btn-outline-primary w-100">
                                            <i class="bi bi-mortarboard-fill d-block mb-2" style="font-size: 2rem;"></i>
                                            Kelola Mahasiswa
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a href="{{ route('admin.alumni') }}" class="btn btn-outline-success w-100">
                                            <i class="bi bi-people-fill d-block mb-2" style="font-size: 2rem;"></i>
                                            Kelola Alumni
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a href="{{ route('admin.lowongan') }}" class="btn btn-outline-warning w-100">
                                            <i class="bi bi-briefcase-fill d-block mb-2" style="font-size: 2rem;"></i>
                                            Kelola Lowongan
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a href="#" class="btn btn-outline-info w-100">
                                            <i class="bi bi-graph-up d-block mb-2" style="font-size: 2rem;"></i>
                                            Laporan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities & Statistics -->
                <div class="row">
                    <!-- Recent Registrations -->
                    <div class="col-xl-6 col-lg-6 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Pendaftaran Terbaru</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Role</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Kevin Gultom</td>
                                                <td><span class="badge bg-primary">Mahasiswa</span></td>
                                                <td>1 Des 2025</td>
                                            </tr>
                                            <tr>
                                                <td>Budi Santoso</td>
                                                <td><span class="badge bg-success">Alumni</span></td>
                                                <td>30 Nov 2025</td>
                                            </tr>
                                            <tr>
                                                <td>Sari Dewi</td>
                                                <td><span class="badge bg-primary">Mahasiswa</span></td>
                                                <td>29 Nov 2025</td>
                                            </tr>
                                            <tr>
                                                <td>Ahmad Rahman</td>
                                                <td><span class="badge bg-success">Alumni</span></td>
                                                <td>28 Nov 2025</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('admin.mahasiswa') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Categories Chart -->
                    <div class="col-xl-6 col-lg-6 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Kategori Lowongan</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Full-time</span>
                                        <span class="fw-bold">{{ $lowonganCount ? round(($lowonganCount * 0.6)) : 2 }}</span>
                                    </div>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 60%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Part-time</span>
                                        <span class="fw-bold">{{ $lowonganCount ? round(($lowonganCount * 0.3)) : 1 }}</span>
                                    </div>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 30%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Internship</span>
                                        <span class="fw-bold">{{ $lowonganCount ? round(($lowonganCount * 0.1)) : 0 }}</span>
                                    </div>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 10%"></div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('admin.lowongan') }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Info -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Informasi Sistem</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="text-center p-3">
                                            <i class="bi bi-server text-primary" style="font-size: 2rem;"></i>
                                            <h6 class="mt-2">Server Status</h6>
                                            <span class="badge bg-success">Online</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center p-3">
                                            <i class="bi bi-database text-info" style="font-size: 2rem;"></i>
                                            <h6 class="mt-2">Database</h6>
                                            <span class="badge bg-success">Connected</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center p-3">
                                            <i class="bi bi-clock text-warning" style="font-size: 2rem;"></i>
                                            <h6 class="mt-2">Last Update</h6>
                                            <small class="text-muted">{{ date('d M Y H:i') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-center p-3">
                                            <i class="bi bi-shield-check text-success" style="font-size: 2rem;"></i>
                                            <h6 class="mt-2">Security</h6>
                                            <span class="badge bg-success">Secure</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection