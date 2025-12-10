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
                                <div class="row justify-content-center">
                                    <div class="col-md-4 mb-3">
                                        <a href="{{ route('admin.mahasiswa') }}" class="btn btn-outline-primary w-100 py-3">
                                            <i class="bi bi-mortarboard-fill d-block mb-2" style="font-size: 2rem;"></i>
                                            Kelola Mahasiswa
                                        </a>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <a href="{{ route('admin.alumni') }}" class="btn btn-outline-success w-100 py-3">
                                            <i class="bi bi-people-fill d-block mb-2" style="font-size: 2rem;"></i>
                                            Kelola Alumni
                                        </a>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <a href="{{ route('admin.lowongan') }}" class="btn btn-outline-warning w-100 py-3">
                                            <i class="bi bi-briefcase-fill d-block mb-2" style="font-size: 2rem;"></i>
                                            Kelola Lowongan
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
                                            @forelse($recentRegistrations as $registration)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($registration->name) }}&background={{ $registration->role == 'mahasiswa' ? '667eea' : '48c78e' }}&color=fff&size=32" 
                                                             class="rounded-circle me-2" width="32" height="32" alt="Avatar">
                                                        <span>{{ $registration->name }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($registration->role == 'mahasiswa')
                                                        <span class="badge bg-primary">Mahasiswa</span>
                                                    @else
                                                        <span class="badge bg-success">Alumni</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $registration->created_at->format('d M Y') }}</small>
                                                    @if($registration->created_at->isToday())
                                                        <span class="badge bg-warning bg-opacity-25 text-warning ms-1">Baru</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">
                                                    <i class="bi bi-inbox me-2"></i>Belum ada pendaftaran terbaru
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('admin.registrations') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Categories Chart -->
                    <div class="col-xl-6 col-lg-6 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold text-primary">Kategori Lowongan</h6>
                                <span class="badge bg-light text-dark">{{ $lowonganCount ?? 0 }} Total</span>
                            </div>
                            <div class="card-body">
                    
                          
                            <div class="card-body">
                                @php
                                    // Hitung data aktual dari database
                                    $actualFulltime = DB::table('recruitment')
                                        ->join('jobtype', 'recruitment.jobtype_id', '=', 'jobtype.id')
                                        ->where('jobtype.name', 'Full Time')
                                        ->count();
                                    
                                    $actualParttime = DB::table('recruitment')
                                        ->join('jobtype', 'recruitment.jobtype_id', '=', 'jobtype.id')
                                        ->where('jobtype.name', 'Part Time')
                                        ->count();
                                    
                                    $actualInternship = DB::table('recruitment')
                                        ->join('jobtype', 'recruitment.jobtype_id', '=', 'jobtype.id')
                                        ->whereIn('jobtype.name', ['Internship', 'Magang'])
                                        ->count();
                                    
                                    $total = $actualFulltime + $actualParttime + $actualInternship;
                                    
                                    // Hitung persentase
                                    $percentFulltime = $total > 0 ? round(($actualFulltime / $total) * 100, 1) : 0;
                                    $percentParttime = $total > 0 ? round(($actualParttime / $total) * 100, 1) : 0;
                                    $percentInternship = $total > 0 ? round(($actualInternship / $total) * 100, 1) : 0;
                                @endphp
                                
                            
<div class="text-center mb-4" style="max-width: 200px; margin: 0 auto;">
    <canvas id="jobTypeChart" width="180" height="180"></canvas>
</div>
                                
                                
                                <!-- Legend -->
                                <div class="d-flex justify-content-around mt-4">
                                    <div class="text-center">
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <div style="width: 12px; height: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; margin-right: 8px;"></div>
                                            <small class="fw-bold">Full-time</small>
                                        </div>
                                        <div class="text-muted small">{{ $actualFulltime }} ({{ $percentFulltime }}%)</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <div style="width: 12px; height: 12px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border-radius: 50%; margin-right: 8px;"></div>
                                            <small class="fw-bold">Part-time</small>
                                        </div>
                                        <div class="text-muted small">{{ $actualParttime }} ({{ $percentParttime }}%)</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <div style="width: 12px; height: 12px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; margin-right: 8px;"></div>
                                            <small class="fw-bold">Internship</small>
                                        </div>
                                        <div class="text-muted small">{{ $actualInternship }} ({{ $percentInternship }}%)</div>
                                    </div>
                                </div>
                                
                                <div class="text-center mt-3">
                                    <a href="{{ route('admin.lowongan') }}" class="btn btn-sm btn-primary rounded-pill px-4">
                                        <i class="bi bi-eye me-1"></i> Lihat Detail
                                    </a>
                                </div>
                                
                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    const ctx = document.getElementById('jobTypeChart');
                                    new Chart(ctx, {
                                        type: 'doughnut',
                                        data: {
                                            labels: ['Full-time', 'Part-time', 'Internship'],
                                            datasets: [{
                                                data: [{{ $actualFulltime }}, {{ $actualParttime }}, {{ $actualInternship }}],
                                                backgroundColor: [
                                                    '#667eea',
                                                    '#11998e',
                                                    '#f093fb'
                                                ],
                                                borderWidth: 0
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: true,
                                            plugins: {
                                                legend: {
                                                    display: false
                                                },
                                                tooltip: {
                                                    callbacks: {
                                                        label: function(context) {
                                                            let label = context.label || '';
                                                            if (label) {
                                                                label += ': ';
                                                            }
                                                            label += context.parsed + ' lowongan';
                                                            return label;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    });
                                </script>
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

<style>
    .chart-container .bar {
        position: relative;
        animation: growUp 1s ease-out;
    }
    
    .chart-container .bar-item:hover .bar {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2) !important;
    }
    
    .chart-container .bar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255,255,255,0.1);
        border-radius: 8px 8px 0 0;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .chart-container .bar-item:hover .bar::before {
        opacity: 1;
    }
    
    .bar-value .badge {
        animation: fadeInDown 1.2s ease-out;
    }
    
    .bar-label {
        animation: fadeInUp 1.4s ease-out;
    }
    
    @keyframes growUp {
        from {
            height: 0 !important;
        }
        to {
            height: var(--final-height);
        }
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .stats-card {
        transition: transform 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
    }
    
    .stats-number {
        font-size: 2rem;
        font-weight: bold;
    }
    
    .stats-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
</style>

@endsection