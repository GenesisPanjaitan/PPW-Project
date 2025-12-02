<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - CareerConnect')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* == CONFIG == */
        :root {
            --admin-bg: #F8F9FC;
            --sidebar-width: 260px;
            --primary-color: #6b5ce7; /* Ungu CareerConnect */
            --text-color: #333;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--admin-bg);
            overflow-x: hidden;
        }

        /* == SIDEBAR == */
        #sidebar-wrapper {
            min-height: 100vh;
            width: var(--sidebar-width);
            margin-left: 0;
            transition: margin 0.25s ease-out;
            background-color: #fff;
            border-right: 1px solid #e0e0e0;
            position: fixed;
            z-index: 1000;
        }
        
        .sidebar-heading {
            padding: 1.5rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #f0f0f0;
        }

        .list-group-item {
            border: none;
            padding: 1rem 1.5rem;
            font-size: 0.95rem;
            color: #6c757d; /* Abu-abu */
            font-weight: 500;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }
        
        .list-group-item:hover {
            background-color: #f8f9fa;
            color: var(--primary-color);
        }
        
        /* Style untuk menu yang sedang aktif */
        .list-group-item.active {
            background-color: #f0f0ff;
            color: var(--primary-color);
            border-left-color: var(--primary-color);
            font-weight: 600;
        }
        
        .list-group-item i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        /* Label Kategori di Sidebar */
        .sidebar-label {
            color: #adb5bd;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            padding: 1.5rem 1.5rem 0.5rem;
            letter-spacing: 0.5px;
        }

        /* == KONTEN == */
        #page-content-wrapper {
            width: 100%;
            margin-left: var(--sidebar-width); /* Geser konten ke kanan */
            transition: margin 0.25s ease-out;
        }

        /* == TOP NAVBAR == */
        .admin-navbar {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            padding: 0.8rem 1.5rem;
            height: 70px;
        }

        /* Tampilan Mobile (Toggle) */
        body.sb-sidenav-toggled #sidebar-wrapper {
            margin-left: calc(-1 * var(--sidebar-width)); /* Sembunyikan sidebar */
        }
        body.sb-sidenav-toggled #page-content-wrapper {
            margin-left: 0; /* Konten memenuhi layar */
        }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar-wrapper { margin-left: calc(-1 * var(--sidebar-width)); }
            #page-content-wrapper { margin-left: 0; }
            body.sb-sidenav-toggled #sidebar-wrapper { margin-left: 0; }
            body.sb-sidenav-toggled #page-content-wrapper { margin-left: 0; }
        }

        /* Custom card styles */
        .stats-card {
            border-radius: 0.75rem;
            border: none;
            overflow: hidden;
        }

        .stats-card .card-body {
            padding: 1.5rem;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
        }

        .stats-label {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }

        /* Notification dropdown styles */
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        .dropdown-item.notification-item {
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }
        
        .dropdown-item.notification-item:hover {
            border-left-color: var(--primary-color);
            background-color: #f0f0ff;
        }
        
        .notification-badge {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @yield('custom-styles')
    </style>
</head>
<body>

    <div class="d-flex" id="wrapper">

        <!-- ==================== SIDEBAR ==================== -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">
                <!-- Logo Kecil -->
                <img src="{{ asset('images/logokita.png') }}" alt="Logo" style="height: 30px;"> 
                CareerConnect
            </div>
            
            <div class="list-group list-group-flush my-3">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>

                <!-- Menu Data Master -->
                <div class="sidebar-label">DATA MASTER</div>
                <a href="{{ route('admin.mahasiswa') }}" class="list-group-item list-group-item-action {{ Request::is('admin/mahasiswa') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard-fill"></i> Mahasiswa
                </a>
                <a href="{{ route('admin.alumni') }}" class="list-group-item list-group-item-action {{ Request::is('admin/alumni') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> Alumni
                </a>

                <!-- Menu Kelola -->
                <div class="sidebar-label">KELOLA</div>
                <a href="{{ route('admin.lowongan') }}" class="list-group-item list-group-item-action {{ Request::is('admin/lowongan') ? 'active' : '' }}">
                    <span><i class="bi bi-briefcase-fill"></i> Lowongan</span>
                </a>

                <div class="mt-4"></div>
                <a href="{{ route('home') }}" class="list-group-item list-group-item-action text-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Kembali ke Web
                </a>
            </div>
        </div>

        <!-- ==================== PAGE CONTENT WRAPPER ==================== -->
        <div id="page-content-wrapper">

            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg admin-navbar">
                <div class="container-fluid">
                    <!-- Tombol Toggle Sidebar -->
                    <button class="btn btn-light text-primary" id="menu-toggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>

                    <!-- Menu Kanan Navbar -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0 align-items-center">
                            
                            <!-- Notifikasi Dropdown -->
                            <li class="nav-item dropdown me-3">
                                <a class="nav-link dropdown-toggle position-relative text-secondary" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-bell fs-5"></i>
                                    @if(isset($newNotifications) && $newNotifications > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notification-badge">
                                        {{ $newNotifications > 99 ? '99+' : $newNotifications }}
                                        <span class="visually-hidden">notifikasi baru</span>
                                    </span>
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end border-0 shadow" style="width: 350px; max-height: 400px; overflow-y: auto;">
                                    <div class="dropdown-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Notifikasi Terbaru</h6>
                                        <small class="text-muted">{{ isset($newNotifications) ? $newNotifications : 0 }} baru</small>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    
                                    @if(isset($recentMahasiswa) && $recentMahasiswa->count() > 0)
                                    <div class="px-3 py-2">
                                        <small class="text-muted fw-bold d-block mb-2">
                                            <i class="bi bi-mortarboard-fill text-primary me-1"></i>MAHASISWA TERBARU
                                        </small>
                                        @foreach($recentMahasiswa as $mahasiswa)
                                        <a href="{{ route('admin.mahasiswa.detail', $mahasiswa->id) }}" class="dropdown-item py-2 border-0">
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->name) }}&background=667eea&color=fff&size=32" 
                                                     class="rounded-circle me-2" width="32" height="32">
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold small">{{ $mahasiswa->name }}</div>
                                                    <div class="text-muted" style="font-size: 0.75rem;">{{ $mahasiswa->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    @endif
                                    
                                    @if(isset($recentAlumni) && $recentAlumni->count() > 0)
                                    <div class="px-3 py-2">
                                        <small class="text-muted fw-bold d-block mb-2">
                                            <i class="bi bi-people-fill text-success me-1"></i>ALUMNI TERBARU
                                        </small>
                                        @foreach($recentAlumni as $alumni)
                                        <a href="{{ route('admin.alumni.detail', $alumni->id) }}" class="dropdown-item py-2 border-0">
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($alumni->name) }}&background=48c78e&color=fff&size=32" 
                                                     class="rounded-circle me-2" width="32" height="32">
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold small">{{ $alumni->name }}</div>
                                                    <div class="text-muted" style="font-size: 0.75rem;">{{ $alumni->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    @endif
                                    
                                    @if(isset($recentLowongan) && $recentLowongan->count() > 0)
                                    <div class="px-3 py-2">
                                        <small class="text-muted fw-bold d-block mb-2">
                                            <i class="bi bi-briefcase-fill text-warning me-1"></i>LOWONGAN TERBARU
                                        </small>
                                        @foreach($recentLowongan as $lowongan)
                                        <a href="{{ route('admin.lowongan.detail', $lowongan->id) }}" class="dropdown-item py-2 border-0">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-2">
                                                    <i class="bi bi-briefcase-fill text-warning"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fw-semibold small">{{ Str::limit($lowongan->position ?? 'Lowongan Kerja', 25) }}</div>
                                                    <div class="text-muted" style="font-size: 0.75rem;">{{ $lowongan->company_name ?? 'Perusahaan' }} • {{ \Carbon\Carbon::parse($lowongan->created_at)->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    @endif
                                    
                                    <div class="text-center p-2">
                                        <a href="{{ route('admin.registrations') }}" class="btn btn-primary btn-sm w-100">
                                            <i class="bi bi-eye me-1"></i>Lihat Semua Notifikasi
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const notificationDropdown = document.getElementById('notificationDropdown');
                                const notificationBadge = document.getElementById('notification-badge');
                                
                                // Check if notifications are already marked as read from localStorage
                                const notificationReadTime = localStorage.getItem('notifications_read_time');
                                const currentTime = new Date().getTime();
                                
                                if (notificationReadTime && (currentTime - parseInt(notificationReadTime)) < 3600000) { // 1 hour
                                    if (notificationBadge) {
                                        notificationBadge.style.display = 'none';
                                    }
                                }
                                
                                if (notificationDropdown) {
                                    // Mark notifications as read when dropdown is clicked
                                    notificationDropdown.addEventListener('click', function(e) {
                                        console.log('Marking notifications as read...');
                                        
                                        // Hide badge immediately for better UX
                                        if (notificationBadge) {
                                            notificationBadge.style.display = 'none';
                                        }
                                        
                                        // Save to localStorage with timestamp
                                        localStorage.setItem('notifications_read_time', new Date().getTime().toString());
                                        
                                        fetch('{{ route("admin.notifications.markRead") }}', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Content-Type': 'application/json',
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            console.log('Mark read response:', data);
                                            if (data.success) {
                                                console.log('Notifications marked as read successfully');
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error marking notifications as read:', error);
                                            // Show badge again if request fails
                                            if (notificationBadge) {
                                                notificationBadge.style.display = 'block';
                                            }
                                            localStorage.removeItem('notifications_read_time');
                                        });
                                    });
                                }
                                
                                // Reset localStorage if there are new notifications (check on page load)
                                @if(isset($newNotifications) && $newNotifications > 0)
                                    // If there are new notifications, remove the "read" status
                                    localStorage.removeItem('notifications_read_time');
                                @endif
                            });
                            </script>

                            <div class="vr h-50 mx-2 text-secondary"></div>

                            <!-- Admin Profile Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center text-dark fw-semibold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    @if(auth()->user()->image && file_exists(public_path('storage/profile_photos/' . auth()->user()->image)))
                                        <img src="{{ asset('storage/profile_photos/' . auth()->user()->image) }}" class="rounded-circle me-2" width="32" height="32" style="object-fit: cover;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=6b5ce7&color=fff" class="rounded-circle me-2" width="32" height="32">
                                    @endif
                                    {{ auth()->user()->name ?? 'Administrator' }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                            <i class="bi bi-person me-2"></i>Profil
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.settings') }}">
                                            <i class="bi bi-gear me-2"></i>Pengaturan
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </a>
                                    </li>
                                </ul>
                                <!-- Form Logout -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Konten Utama Halaman -->
            <div class="container-fluid px-4 py-4">
                @yield('content')
            </div>
            
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Script untuk toggle sidebar
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("sb-sidenav-toggled");
        };
    </script>

    @yield('custom-scripts')
</body>
</html>