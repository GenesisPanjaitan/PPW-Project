@extends('layouts.admin')

@section('title', 'Profil Admin - CareerConnect')

@section('content')

<!-- Page Heading -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-lg" style="border-radius: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); overflow: hidden;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="text-white">
                        <h1 class="h2 mb-2 fw-bold">
                            <i class="bi bi-person-circle me-3"></i>Profil Administrator
                        </h1>
                        <p class="mb-0 opacity-90">
                            <i class="bi bi-info-circle me-2"></i>Kelola informasi profil dan keamanan akun Anda
                        </p>
                    </div>
                    <nav aria-label="breadcrumb" class="mt-3 mt-md-0">
                        <ol class="breadcrumb mb-0 bg-white bg-opacity-10 rounded-pill px-4 py-2">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none">
                                    <i class="bi bi-house-fill me-1"></i>Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-white fw-bold">Profil</li>
                        </ol>
                    </nav>
                </div>
            </div>
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
        <div class="card shadow-lg border-0 mb-4 profile-card" style="border-radius: 1rem; overflow: hidden;">
            <div class="card-header py-3" style="background: linear-gradient(135deg, rgba(107, 92, 231, 0.1) 0%, rgba(107, 92, 231, 0.05) 100%); border-bottom: 2px solid rgba(107, 92, 231, 0.1);">
                <h6 class="m-0 fw-bold" style="color: #6b5ce7;">
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
                                <div class="profile-photo-preview position-relative">
                                    @if($admin->image && file_exists(public_path('storage/profile_photos/' . $admin->image)))
                                        <img src="{{ asset('storage/profile_photos/' . $admin->image) }}" 
                                             class="rounded-circle border" width="100" height="100" alt="Current Photo" id="photoPreview" 
                                             style="object-fit: cover;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=6b5ce7&color=fff&size=100" 
                                             class="rounded-circle border" width="100" height="100" alt="Default Avatar" id="photoPreview">
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
        <div class="card shadow-lg border-0 mb-4 profile-summary-card" style="border-radius: 1rem; overflow: hidden;">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    @if($admin->image && file_exists(public_path('storage/profile_photos/' . $admin->image)))
                        <img src="{{ asset('storage/profile_photos/' . $admin->image) }}" 
                             class="rounded-circle shadow-lg profile-img-large" width="140" height="140" alt="Admin Photo" 
                             style="object-fit: cover; border: 4px solid #fff;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=6b5ce7&color=fff&size=140" 
                             class="rounded-circle shadow-lg profile-img-large" width="140" height="140" alt="Admin Avatar" style="border: 4px solid #fff;">
                    @endif
                </div>
                <h5 class="fw-bold">{{ $admin->name }}</h5>
                <p class="text-muted mb-3">{{ $admin->email }}</p>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                    <i class="bi bi-shield-check me-1"></i>Administrator
                </span>
                @if($admin->image && file_exists(public_path('storage/profile_photos/' . $admin->image)))
                <div class="mt-3">
                    <button onclick="showPhoto('{{ asset('storage/profile_photos/' . $admin->image) }}')" class="btn btn-sm btn-outline-primary rounded-pill">
                        <i class="bi bi-eye me-1"></i>Lihat Foto
                    </button>
                </div>
                @endif
                <hr class="my-3">
                <div class="small text-muted">
                    <div><strong>ID:</strong> {{ $admin->id }}</div>
                    <div><strong>Terakhir Update:</strong> {{ $admin->updated_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Simple Photo Lightbox -->
<div id="photoLightbox" class="photo-lightbox" onclick="closePhoto()" style="display: none;">
    <button class="photo-close-btn" onclick="closePhoto()">
        <i class="bi bi-x-lg"></i>
    </button>
    <img id="lightboxImage" src="" alt="Profile Photo" onclick="event.stopPropagation()">
</div>

@endsection

@section('custom-styles')
<style>
    /* Profile Card Animations */
    .profile-card {
        animation: fadeInUp 0.5s ease-out;
    }

    .profile-summary-card {
        animation: fadeInRight 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Profile Photo Hover Effects */
    .profile-img-large {
        transition: all 0.4s ease;
    }

    .profile-img-large:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 30px rgba(107, 92, 231, 0.4) !important;
    }

    /* Form Input Focus */
    .form-control:focus {
        border-color: #6b5ce7;
        box-shadow: 0 0 0 0.2rem rgba(107, 92, 231, 0.25);
    }

    /* Button Hover Effects */
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(107, 92, 231, 0.4);
    }
    
    #profile_photo {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    #profile_photo:hover {
        border-color: #6b5ce7;
        box-shadow: 0 0 0 0.2rem rgba(107, 92, 231, 0.25);
    }

    /* Simple Photo Lightbox */
    .photo-lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease;
    }

    .photo-lightbox img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 1rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        animation: zoomIn 0.3s ease;
    }

    .photo-close-btn {
        position: fixed;
        top: 30px;
        right: 30px;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 1.5rem;
        color: #333;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        z-index: 10000;
    }

    .photo-close-btn:hover {
        background: #fff;
        transform: scale(1.1) rotate(90deg);
        color: #6b5ce7;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
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

    // Photo lightbox functions
    function showPhoto(imageUrl) {
        const lightbox = document.getElementById('photoLightbox');
        const image = document.getElementById('lightboxImage');
        image.src = imageUrl;
        lightbox.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closePhoto() {
        const lightbox = document.getElementById('photoLightbox');
        lightbox.style.display = 'none';
        document.body.style.overflow = '';
    }

    // Close on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePhoto();
        }
    });
</script>
@endsection