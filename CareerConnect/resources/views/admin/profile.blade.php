@extends('layouts.admin')

@section('title', 'Profil Admin - CareerConnect')

@section('content')

<!-- Page Heading -->
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2 text-gray-800">Profil Administrator</h1>
                <p class="text-muted">Kelola informasi profil dan keamanan akun Anda</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profil</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->has('general'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first('general') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">
    <!-- Profile Information -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-gradient-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-person-circle me-2"></i>Informasi Profil
                </h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Profile Photo Upload -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="fw-bold mb-3">
                                <i class="bi bi-camera me-2"></i>Foto Profil
                            </h6>
                            <div class="d-flex align-items-center gap-3">
                                <div class="profile-photo-preview">
                                    @if($admin->image && file_exists(public_path('storage/profile_photos/' . $admin->image)))
                                        <img src="{{ asset('storage/profile_photos/' . $admin->image) }}" 
                                             class="rounded-circle border" width="80" height="80" alt="Current Photo" id="photoPreview" style="object-fit: cover;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=6b5ce7&color=fff&size=80" 
                                             class="rounded-circle border" width="80" height="80" alt="Default Avatar" id="photoPreview">
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" 
                                           id="profile_photo" name="profile_photo" accept="image/*" onchange="previewPhoto(this)">
                                    @error('profile_photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                    @if($admin->image)
                                        <br><small class="text-success">Foto saat ini: {{ $admin->image }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label fw-bold">Role</label>
                            <input type="text" class="form-control" value="Administrator" readonly>
                            <small class="text-muted">Role tidak dapat diubah</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="created_at" class="form-label fw-bold">Bergabung Sejak</label>
                            <input type="text" class="form-control" value="{{ $admin->created_at->format('d F Y') }}" readonly>
                            <small class="text-muted">Terakhir diperbarui: {{ $admin->updated_at->format('d F Y H:i') }}</small>
                        </div>
                    </div>

                    <hr class="my-4">
                    
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-shield-lock me-2"></i>Ubah Password (Opsional)
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                   id="new_password" name="new_password">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" 
                                   id="new_password_confirmation" name="new_password_confirmation">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Profile Summary -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <div class="mb-3">
                    @if($admin->image && file_exists(public_path('storage/profile_photos/' . $admin->image)))
                        <img src="{{ asset('storage/profile_photos/' . $admin->image) }}" 
                             class="rounded-circle shadow" width="120" height="120" alt="Admin Photo" style="object-fit: cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=6b5ce7&color=fff&size=120" 
                             class="rounded-circle shadow" width="120" height="120" alt="Admin Avatar">
                    @endif
                </div>
                <h5 class="fw-bold">{{ $admin->name }}</h5>
                <p class="text-muted mb-3">{{ $admin->email }}</p>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                    <i class="bi bi-shield-check me-1"></i>Administrator
                </span>
                <hr class="my-3">
                <div class="small text-muted">
                    <div><strong>ID:</strong> {{ $admin->id }}</div>
                    <div><strong>Terakhir Update:</strong> {{ $admin->updated_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>

        <!-- Account Statistics -->
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik Akun</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="fw-bold text-primary mb-1">{{ \App\Models\User::where('role', 'mahasiswa')->count() }}</h4>
                            <small class="text-muted">Mahasiswa</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="fw-bold text-success mb-1">{{ \App\Models\User::where('role', 'alumni')->count() }}</h4>
                        <small class="text-muted">Alumni</small>
                    </div>
                </div>
                <hr class="my-3">
                <div class="text-center">
                    <h5 class="fw-bold text-warning mb-1">{{ \Illuminate\Support\Facades\DB::table('recruitment')->count() }}</h5>
                    <small class="text-muted">Total Lowongan</small>
                </div>
                <hr class="my-3">
                <div class="d-grid">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-speedometer2 me-1"></i>Lihat Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('custom-styles')
<style>
    .profile-photo-preview img {
        border: 3px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .profile-photo-preview img:hover {
        border-color: #6b5ce7;
        transform: scale(1.05);
    }
    
    #profile_photo {
        cursor: pointer;
    }
    
    #profile_photo:hover {
        border-color: #6b5ce7;
    }
</style>
@endsection

@section('custom-scripts')
<script>
    // Auto-hide success alert after 5 seconds
    setTimeout(function() {
        var alert = document.querySelector('.alert-success');
        if (alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);

    // Password field validation
    document.getElementById('new_password').addEventListener('input', function() {
        var currentPassword = document.getElementById('current_password');
        if (this.value.length > 0) {
            currentPassword.setAttribute('required', 'required');
        } else {
            currentPassword.removeAttribute('required');
        }
    });
    
    // Simple photo preview function
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('photoPreview').src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection