@extends('layouts.admin')

@section('title', 'Pengaturan Admin - CareerConnect')

@section('content')

<!-- Page Heading -->
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2 text-gray-800">Pengaturan Sistem</h1>
                <p class="text-muted">Kelola pengaturan dan konfigurasi sistem CareerConnect</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pengaturan</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <!-- System Configuration -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3 bg-gradient-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-gear me-2"></i>Konfigurasi Sistem
                </h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <div>
                            <h6 class="mb-1">Registrasi Mahasiswa</h6>
                            <small class="text-muted">Izinkan pendaftaran mahasiswa baru</small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="studentRegistration" checked>
                        </div>
                    </div>
                    
                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <div>
                            <h6 class="mb-1">Registrasi Alumni</h6>
                            <small class="text-muted">Izinkan pendaftaran alumni baru</small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="alumniRegistration" checked>
                        </div>
                    </div>

                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <div>
                            <h6 class="mb-1">Notifikasi Email</h6>
                            <small class="text-muted">Kirim notifikasi ke admin via email</small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="emailNotification" checked>
                        </div>
                    </div>

                    <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        <div>
                            <h6 class="mb-1">Mode Maintenance</h6>
                            <small class="text-muted">Nonaktifkan akses publik sementara</small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="maintenanceMode">
                        </div>
                    </div>
                </div>

                <hr class="my-3">
                
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-primary btn-sm">
                        <i class="bi bi-save me-2"></i>Simpan Pengaturan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Database Management -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3 bg-gradient-warning text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-database me-2"></i>Manajemen Database
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6>Backup Database</h6>
                    <p class="text-muted small">Buat cadangan data sistem secara manual</p>
                    <button type="button" class="btn btn-outline-success btn-sm w-100">
                        <i class="bi bi-download me-2"></i>Buat Backup Sekarang
                    </button>
                </div>

                <hr>

                <div class="mb-3">
                    <h6>Pembersihan Data</h6>
                    <p class="text-muted small">Hapus data lama dan file tidak terpakai</p>
                    <button type="button" class="btn btn-outline-info btn-sm w-100">
                        <i class="bi bi-trash3 me-2"></i>Bersihkan Data Lama
                    </button>
                </div>

                <hr>

                <div class="mb-3">
                    <h6>Reset Statistik</h6>
                    <p class="text-muted small">Reset counter dan data statistik</p>
                    <button type="button" class="btn btn-outline-warning btn-sm w-100">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>Reset Statistik
                    </button>
                </div>

                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <small>Pastikan untuk membuat backup sebelum melakukan operasi database.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Security Settings -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 bg-gradient-danger text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-shield-lock me-2"></i>Keamanan
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Session Timeout (menit)</label>
                    <select class="form-select">
                        <option value="30">30 menit</option>
                        <option value="60" selected>1 jam</option>
                        <option value="120">2 jam</option>
                        <option value="240">4 jam</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Maksimal Login Gagal</label>
                    <select class="form-select">
                        <option value="3">3 kali</option>
                        <option value="5" selected>5 kali</option>
                        <option value="10">10 kali</option>
                    </select>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="twoFactorAuth">
                    <label class="form-check-label" for="twoFactorAuth">
                        Aktifkan Two-Factor Authentication
                    </label>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="loginNotification" checked>
                    <label class="form-check-label" for="loginNotification">
                        Notifikasi login admin
                    </label>
                </div>

                <button type="button" class="btn btn-danger btn-sm w-100">
                    <i class="bi bi-shield-check me-2"></i>Update Keamanan
                </button>
            </div>
        </div>
    </div>

    <!-- System Information -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 bg-gradient-info text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-info-circle me-2"></i>Informasi Sistem
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="fw-bold">Versi PHP:</td>
                        <td>{{ PHP_VERSION }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Versi Laravel:</td>
                        <td>{{ app()->version() }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Server:</td>
                        <td>{{ $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Database:</td>
                        <td>MySQL</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Environment:</td>
                        <td>
                            <span class="badge bg-{{ config('app.env') == 'production' ? 'success' : 'warning' }}">
                                {{ strtoupper(config('app.env')) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Debug Mode:</td>
                        <td>
                            <span class="badge bg-{{ config('app.debug') ? 'danger' : 'success' }}">
                                {{ config('app.debug') ? 'ON' : 'OFF' }}
                            </span>
                        </td>
                    </tr>
                </table>

                <hr>

                <div class="text-center">
                    <h6 class="fw-bold">Storage Usage</h6>
                    <div class="progress mb-2">
                        <div class="progress-bar bg-info" style="width: 45%"></div>
                    </div>
                    <small class="text-muted">45% dari 10 GB digunakan</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-2 mb-3">
                        <button type="button" class="btn btn-outline-primary w-100">
                            <i class="bi bi-arrow-clockwise d-block mb-1" style="font-size: 1.5rem;"></i>
                            <small>Cache Clear</small>
                        </button>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="button" class="btn btn-outline-success w-100">
                            <i class="bi bi-download d-block mb-1" style="font-size: 1.5rem;"></i>
                            <small>Export Data</small>
                        </button>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="button" class="btn btn-outline-warning w-100">
                            <i class="bi bi-upload d-block mb-1" style="font-size: 1.5rem;"></i>
                            <small>Import Data</small>
                        </button>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="button" class="btn btn-outline-info w-100">
                            <i class="bi bi-journal-text d-block mb-1" style="font-size: 1.5rem;"></i>
                            <small>View Logs</small>
                        </button>
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="button" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-tools d-block mb-1" style="font-size: 1.5rem;"></i>
                            <small>Maintenance</small>
                        </button>
                    </div>
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark w-100">
                            <i class="bi bi-house d-block mb-1" style="font-size: 1.5rem;"></i>
                            <small>Dashboard</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-scripts')
<script>
    // Settings page functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle switches with confirmation
        const toggleSwitches = document.querySelectorAll('.form-check-input[type="checkbox"]');
        
        toggleSwitches.forEach(function(toggle) {
            toggle.addEventListener('change', function() {
                if (this.id === 'maintenanceMode' && this.checked) {
                    if (!confirm('Yakin ingin mengaktifkan mode maintenance? Pengguna tidak akan dapat mengakses website.')) {
                        this.checked = false;
                        return;
                    }
                }
                
                // Show toast notification
                showToast('Pengaturan diperbarui', 'success');
            });
        });

        // Button click handlers
        document.querySelectorAll('button[type="button"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const text = this.textContent.trim();
                
                if (text.includes('Backup')) {
                    showToast('Backup database dimulai...', 'info');
                } else if (text.includes('Bersihkan')) {
                    if (confirm('Yakin ingin menghapus data lama? Tindakan ini tidak dapat dibatalkan.')) {
                        showToast('Pembersihan data dimulai...', 'warning');
                    }
                } else if (text.includes('Reset')) {
                    if (confirm('Yakin ingin reset statistik? Data statistik akan hilang.')) {
                        showToast('Statistik berhasil direset', 'success');
                    }
                } else {
                    showToast('Fitur sedang dikembangkan', 'info');
                }
            });
        });
    });

    function showToast(message, type) {
        // Simple toast notification
        const toastContainer = document.createElement('div');
        toastContainer.className = `alert alert-${type} position-fixed`;
        toastContainer.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        toastContainer.innerHTML = `
            <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
            ${message}
        `;
        
        document.body.appendChild(toastContainer);
        
        setTimeout(() => {
            toastContainer.remove();
        }, 3000);
    }
</script>
@endsection