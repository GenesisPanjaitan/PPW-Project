@extends('layouts.admin')

@section('title', 'Dashboard Admin - CareerConnect')

@section('content')

                <!-- Hero Section dengan Logo CareerConnect -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-lg" style="border-radius: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); overflow: hidden;">
                            <div class="card-body p-5">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-white rounded-circle p-3 me-3 shadow" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-building" style="font-size: 2.5rem; color: #667eea;"></i>
                                            </div>
                                            <div>
                                                <h1 class="h2 mb-1 text-white fw-bold">CareerConnect</h1>
                                                <p class="text-white-50 mb-0">Admin Dashboard - Institut Teknologi Del</p>
                                            </div>
                                        </div>
                                        <p class="text-white mb-0 opacity-90">
                                            <i class="bi bi-shield-check me-2"></i>
                                            Kelola data mahasiswa, alumni, dan lowongan kerja dengan mudah
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                        <div class="bg-white bg-opacity-10 rounded-3 p-4 backdrop-blur">
                                            <div class="text-white">
                                                <i class="bi bi-calendar3 me-2"></i>
                                                <small>{{ date('d F Y') }}</small>
                                            </div>
                                            <div class="text-white mt-2">
                                                <i class="bi bi-clock me-2"></i>
                                                <small id="current-time"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Content -->
                <div class="row">
                    <div class="col-12">
                        <h1 class="h3 mb-4 text-gray-800 fw-bold">Statistik Sistem</h1>
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
                        <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
                            <div class="card-header py-3" style="background: linear-gradient(135deg, rgba(107, 92, 231, 0.1) 0%, rgba(107, 92, 231, 0.05) 100%); border-bottom: 2px solid rgba(107, 92, 231, 0.1);">
                                <h6 class="m-0 fw-bold" style="color: #6b5ce7;">
                                    <i class="bi bi-lightning-charge-fill me-2"></i>Aksi Cepat
                                </h6>
                            </div>
                            <div class="card-body p-4">
                                <div class="row justify-content-center g-3">
                                    <div class="col-md-4">
                                        <a href="{{ route('admin.mahasiswa') }}" class="quick-action-card text-decoration-none d-block">
                                            <div class="p-4 text-center h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 1rem; position: relative; overflow: hidden;">
                                                <div class="quick-action-icon-wrapper mb-3">
                                                    <i class="bi bi-mortarboard-fill text-white" style="font-size: 3rem;"></i>
                                                </div>
                                                <h6 class="text-white fw-bold mb-2">Kelola Mahasiswa</h6>
                                                <p class="text-white-50 small mb-0">Lihat & kelola data mahasiswa</p>
                                                <div class="quick-action-arrow">
                                                    <i class="bi bi-arrow-right-circle-fill text-white" style="font-size: 1.5rem;"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('admin.alumni') }}" class="quick-action-card text-decoration-none d-block">
                                            <div class="p-4 text-center h-100" style="background: linear-gradient(135deg, #48c78e 0%, #06d6a0 100%); border-radius: 1rem; position: relative; overflow: hidden;">
                                                <div class="quick-action-icon-wrapper mb-3">
                                                    <i class="bi bi-people-fill text-white" style="font-size: 3rem;"></i>
                                                </div>
                                                <h6 class="text-white fw-bold mb-2">Kelola Alumni</h6>
                                                <p class="text-white-50 small mb-0">Lihat & kelola data alumni</p>
                                                <div class="quick-action-arrow">
                                                    <i class="bi bi-arrow-right-circle-fill text-white" style="font-size: 1.5rem;"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('admin.lowongan') }}" class="quick-action-card text-decoration-none d-block">
                                            <div class="p-4 text-center h-100" style="background: linear-gradient(135deg, #ffa726 0%, #ff7043 100%); border-radius: 1rem; position: relative; overflow: hidden;">
                                                <div class="quick-action-icon-wrapper mb-3">
                                                    <i class="bi bi-briefcase-fill text-white" style="font-size: 3rem;"></i>
                                                </div>
                                                <h6 class="text-white fw-bold mb-2">Kelola Lowongan</h6>
                                                <p class="text-white-50 small mb-0">Lihat & kelola lowongan kerja</p>
                                                <div class="quick-action-arrow">
                                                    <i class="bi bi-arrow-right-circle-fill text-white" style="font-size: 1.5rem;"></i>
                                                </div>
                                            </div>
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
                        <div class="card shadow-lg border-0 h-100" style="border-radius: 1rem; overflow: hidden;">
                            <div class="card-header py-3" style="background: linear-gradient(135deg, rgba(107, 92, 231, 0.1) 0%, rgba(107, 92, 231, 0.05) 100%); border-bottom: 2px solid rgba(107, 92, 231, 0.1);">
                                <h6 class="m-0 fw-bold" style="color: #6b5ce7;">
                                    <i class="bi bi-person-plus-fill me-2"></i>Pendaftaran Terbaru
                                </h6>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    @forelse($recentRegistrations as $index => $registration)
                                    <div class="list-group-item border-0 registration-item" style="animation: fadeInLeft {{ 0.1 * ($index + 1) }}s ease-out;">
                                        <div class="d-flex align-items-center justify-content-between py-2">
                                            <div class="d-flex align-items-center flex-grow-1">
                                                <div class="position-relative me-3">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($registration->name) }}&background={{ $registration->role == 'mahasiswa' ? '667eea' : '48c78e' }}&color=fff&size=48" 
                                                         class="rounded-circle avatar-img" width="48" height="48" alt="Avatar">
                                                    <span class="position-absolute bottom-0 end-0 badge rounded-pill" style="background: {{ $registration->role == 'mahasiswa' ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' : 'linear-gradient(135deg, #48c78e 0%, #06d6a0 100%)' }};">
                                                        <i class="bi {{ $registration->role == 'mahasiswa' ? 'bi-mortarboard-fill' : 'bi-briefcase-fill' }}" style="font-size: 0.7rem;"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1 fw-semibold" style="color: #2d3748;">{{ $registration->name }}</h6>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="badge" style="background: {{ $registration->role == 'mahasiswa' ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' : 'linear-gradient(135deg, #48c78e 0%, #06d6a0 100%)' }}; font-size: 0.75rem;">
                                                            {{ $registration->role == 'mahasiswa' ? 'Mahasiswa' : 'Alumni' }}
                                                        </span>
                                                        @if($registration->created_at->isToday())
                                                            <span class="badge bg-warning bg-opacity-25 text-warning pulse-badge">
                                                                <i class="bi bi-star-fill me-1"></i>Baru
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <small class="text-muted d-block">
                                                    <i class="bi bi-calendar3 me-1"></i>{{ $registration->created_at->format('d M Y') }}
                                                </small>
                                                <small class="text-muted">
                                                    <i class="bi bi-clock me-1"></i>{{ $registration->created_at->format('H:i') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="list-group-item border-0 text-center py-5">
                                        <i class="bi bi-inbox" style="font-size: 3rem; color: #cbd5e0;"></i>
                                        <p class="text-muted mt-3 mb-0">Belum ada pendaftaran terbaru</p>
                                    </div>
                                    @endforelse
                                </div>
                                @if($recentRegistrations->isNotEmpty())
                                <div class="text-center p-3 border-top">
                                    <a href="{{ route('admin.registrations') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4 hover-lift">
                                        <i class="bi bi-eye me-2"></i>Lihat Semua Pendaftaran
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Job Categories Chart -->
                    <div class="col-xl-6 col-lg-6 mb-4">
                        <div class="card shadow-lg border-0 h-100" style="border-radius: 1rem; overflow: hidden;">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, rgba(107, 92, 231, 0.1) 0%, rgba(107, 92, 231, 0.05) 100%); border-bottom: 2px solid rgba(107, 92, 231, 0.1);">
                                <h6 class="m-0 fw-bold" style="color: #6b5ce7;">
                                    <i class="bi bi-pie-chart-fill me-2"></i>Kategori Lowongan
                                </h6>
                                <span class="badge rounded-pill" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 0.5rem 1rem;">
                                    {{ $lowonganCount ?? 0 }} Total
                                </span>
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
                                        ->where('jobtype.name', 'Magang')
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
                                            <small class="fw-bold">Full Time</small>
                                        </div>
                                        <div class="text-muted small">{{ $actualFulltime }} ({{ $percentFulltime }}%)</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <div style="width: 12px; height: 12px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border-radius: 50%; margin-right: 8px;"></div>
                                            <small class="fw-bold">Part Time</small>
                                        </div>
                                        <div class="text-muted small">{{ $actualParttime }} ({{ $percentParttime }}%)</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <div style="width: 12px; height: 12px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; margin-right: 8px;"></div>
                                            <small class="fw-bold">Magang</small>
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
                                            labels: ['Full Time', 'Part Time', 'Magang'],
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
    /* Quick Action Cards Animation */
    .quick-action-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: block;
    }

    .quick-action-card > div {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .quick-action-card:hover > div {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    .quick-action-icon-wrapper {
        transition: transform 0.4s ease;
    }

    .quick-action-card:hover .quick-action-icon-wrapper {
        transform: scale(1.15) rotate(5deg);
    }

    .quick-action-arrow {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s ease;
    }

    .quick-action-card:hover .quick-action-arrow {
        opacity: 1;
        transform: translateX(0);
    }

    .quick-action-card > div::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.1);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .quick-action-card:hover > div::before {
        opacity: 1;
    }

    /* Registration Items Animation */
    .registration-item {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-left: 3px solid transparent !important;
    }

    .registration-item:hover {
        background: linear-gradient(90deg, rgba(107, 92, 231, 0.05) 0%, transparent 100%) !important;
        border-left-color: #6b5ce7 !important;
        transform: translateX(5px);
    }

    .registration-item .avatar-img {
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .registration-item:hover .avatar-img {
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(107, 92, 231, 0.3);
    }

    .pulse-badge {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.05);
            opacity: 0.9;
        }
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(107, 92, 231, 0.3);
    }

    /* Chart Container */
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

@section('scripts')
<script>
    // Real-time clock
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('current-time').textContent = timeString;
    }
    updateTime();
    setInterval(updateTime, 1000);
</script>
@endsection