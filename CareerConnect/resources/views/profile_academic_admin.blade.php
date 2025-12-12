@extends('layouts.app')

@section('content')

 
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">
                <img src="{{ asset('images/logokita.png') }}" alt="CareerConnect Logo" style="height: 30px;" class="ms-2"> CareerConnect
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navDashboard" aria-controls="navDashboard" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navDashboard">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3"><a class="nav-link {{ Request::is('home') ? 'active fw-semibold' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item mx-3"><a class="nav-link {{ Request::is('recruitment*') ? 'active fw-semibold' : '' }}" href="/recruitment">Recruitment</a></li>
                    <li class="nav-item mx-3"><a class="nav-link {{ Request::is('profile*') ? 'active fw-semibold' : '' }}" href="/profile">My Profile</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(auth()->user() && auth()->user()->image)
                                @php
                                    $avatarUrl = filter_var(auth()->user()->image, FILTER_VALIDATE_URL)
                                        ? auth()->user()->image
                                        : asset('storage/profile_photos/' . auth()->user()->image);
                                @endphp
                                <img src="{{ $avatarUrl }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;">
                            @else
                                <i class="bi bi-person-circle me-1"></i>
                            @endif
                            @auth {{ auth()->user()->name }} @else {{ optional(auth()->user())->name ?? 'Admin' }} @endauth
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('favorit') }}"><i class="bi bi-bookmark-fill me-2"></i> Favorit Anda</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Keluar Akun
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">

            <h2 class="fw-bold mb-1" style="color: #6b5ce7;">My Profile</h2>
            <p class="text-muted mb-4">Dashboard statistik lowongan dan pengguna</p>

            <div class="d-flex justify-content-between align-items-center mb-4">
                
                <div class="profile-tabs-container">
                    <a href="/profile" class="tab-link {{ Request::is('profile') ? 'active' : '' }}">Informasi Dasar</a>
                    <a href="/profile/academic" class="tab-link {{ Request::is('profile/academic') ? 'active' : '' }}">Informasi Lowongan</a>
                    <a href="{{ route('profile.settings') }}" class="tab-link {{ Request::is('profile/settings') ? 'active' : '' }}">Pengaturan</a>
                </div>

            </div>

            {{-- Header Card --}}
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card border-0 shadow-sm" style="border-radius: 1rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="card-body p-4">
                            <div class="text-white">
                                <h5 class="fw-bold mb-2"><i class="bi bi-bar-chart-line-fill me-2"></i>Dashboard Lowongan & Pengguna</h5>
                                <p class="mb-0 opacity-75">Visualisasi data lowongan kerja dan statistik pengguna</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Diagram Perbandingan Mahasiswa & Alumni --}}
            <div class="row mb-4">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3"><i class="bi bi-people-fill me-2 text-primary"></i>Perbandingan Mahasiswa & Alumni</h5>
                            <div style="height: 300px; position: relative;">
                                <canvas id="userComparisonChart"></canvas>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex justify-content-around text-center">
                                    <div>
                                        <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                            <i class="bi bi-people-fill me-1"></i>Mahasiswa
                                        </div>
                                        <h4 class="fw-bold mt-2 mb-0">{{ $mahasiswaCount ?? 0 }}</h4>
                                    </div>
                                    <div>
                                        <div class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                            <i class="bi bi-mortarboard-fill me-1"></i>Alumni
                                        </div>
                                        <h4 class="fw-bold mt-2 mb-0">{{ $alumniCount ?? 0 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Diagram Lowongan per Kategori --}}
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3"><i class="bi bi-pie-chart-fill me-2 text-warning"></i>Lowongan per Kategori</h5>
                            <div style="height: 300px; position: relative;">
                                <canvas id="categoryChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Diagram Lowongan per Tipe --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0" style="border-radius: 1rem;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3"><i class="bi bi-bar-chart-fill me-2 text-info"></i>Lowongan per Tipe Pekerjaan</h5>
                            <div style="height: 250px; position: relative;">
                                <canvas id="jobTypeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="card-body p-4 text-white text-center">
                            <i class="bi bi-people-fill fs-1 mb-3 d-block"></i>
                            <h3 class="fw-bold">{{ $mahasiswaCount ?? 0 }}</h3>
                            <p class="mb-0 opacity-75">Total Mahasiswa</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem; background: linear-gradient(135deg, #48c78e 0%, #06d6a0 100%);">
                        <div class="card-body p-4 text-white text-center">
                            <i class="bi bi-mortarboard-fill fs-1 mb-3 d-block"></i>
                            <h3 class="fw-bold">{{ $alumniCount ?? 0 }}</h3>
                            <p class="mb-0 opacity-75">Total Alumni</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem; background: linear-gradient(135deg, #ffa726 0%, #ff7043 100%);">
                        <div class="card-body p-4 text-white text-center">
                            <i class="bi bi-briefcase-fill fs-1 mb-3 d-block"></i>
                            <h3 class="fw-bold">{{ $lowonganByCategory->sum('total') ?? 0 }}</h3>
                            <p class="mb-0 opacity-75">Total Lowongan</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Diagram Perbandingan Mahasiswa & Alumni
    const userCtx = document.getElementById('userComparisonChart').getContext('2d');
    new Chart(userCtx, {
        type: 'doughnut',
        data: {
            labels: ['Mahasiswa', 'Alumni'],
            datasets: [{
                data: [{{ $mahasiswaCount ?? 0 }}, {{ $alumniCount ?? 0 }}],
                backgroundColor: ['#667eea', '#48c78e'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: { size: 14, weight: '500' }
                    }
                }
            }
        }
    });

    // Diagram Lowongan per Kategori
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($lowonganByCategory->pluck('category_name')) !!},
            datasets: [{
                data: {!! json_encode($lowonganByCategory->pluck('total')) !!},
                backgroundColor: ['#667eea', '#48c78e', '#ffa726', '#ff7043', '#42a5f5', '#ab47bc'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: { size: 12, weight: '500' }
                    }
                }
            }
        }
    });

    // Diagram Lowongan per Tipe
    const jobTypeCtx = document.getElementById('jobTypeChart').getContext('2d');
    new Chart(jobTypeCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($lowonganByType->pluck('type_name')) !!},
            datasets: [{
                label: 'Jumlah Lowongan',
                data: {!! json_encode($lowonganByType->pluck('total')) !!},
                backgroundColor: 'rgba(102, 126, 234, 0.8)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 2,
                borderRadius: 8,
                maxBarThickness: 60,
                barPercentage: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
</script>

<style>
    .profile-tabs-container {
        display: flex;
        gap: 0.5rem;
        background-color: #f8f9fa;
        padding: 0.375rem;
        border-radius: 0.75rem;
        border: 1px solid #e9ecef;
    }

    .tab-link {
        padding: 0.5rem 1rem;
        color: #6c757d;
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-weight: 500;
        white-space: nowrap;
    }

    .tab-link:hover:not(.active) {
        background-color: rgba(107, 92, 231, 0.05);
        color: #5a4dc4;
    }

    .tab-link.active {
        background-color: white;
        color: #6b5ce7;
        box-shadow: 0 4px 12px rgba(107, 92, 231, 0.15),
                    0 2px 4px rgba(0, 0, 0, 0.05);
        font-weight: 600;
        transform: translateY(-2px);
    }
</style>

@endsection
