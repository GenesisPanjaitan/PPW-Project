<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Favorit Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:#e6eef8; }
        .topbar { background:linear-gradient(180deg,#fff,#f3f7fb); box-shadow:0 2px 6px rgba(0,0,0,.03); }
        .brand { font-weight:700; }
        .page-title { color:#3b6db4; }
        .card-fav{
            border-radius:14px;
            border:1px solid #e6e9ee;
            padding:18px;
            position:relative;
            display:flex;
            gap:12px;
            align-items:center;
            background:#fff;
            box-shadow:0 1px 0 rgba(0,0,0,.02);
        }
        .card-fav + .card-fav{ margin-top:14px; }
        .avatar{ width:64px; height:64px; object-fit:cover; border-radius:8px; }
        .avatar-fallback{ width:64px; height:64px; border-radius:8px; display:flex; align-items:center; justify-content:center; background:#6c757d; color:#fff; font-weight:700; }
        .remove-btn{
            position:absolute;
            right:16px;
            top:50%;
            transform:translateY(-50%);
            width:36px;
            height:36px;
            border-radius:50%;
            background:#ff5c64;
            color:#fff;
            border:none;
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow:0 4px 10px rgba(255,92,100,.12);
        }
        .small-muted{ font-size:.85rem; color:#6c757d; }
        .meta-line{ font-size:.9rem; color:#6b7280; }
        .badge-custom{ background:#eef6ff; color:#1e63b8; font-weight:600; font-size:.78rem; padding:.25rem .5rem; border-radius:.5rem; }
        a.text-decoration-none:hover{ text-decoration:underline; color:#123e78; }
        @media (max-width:576px){
            .remove-btn{ right:10px; top:14px; transform:none; }
        }
    </style>
</head>
<body>
    <header class="topbar py-2">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <strong class="brand h5 mb-0">CareerConnect</strong>
                <nav class="d-none d-md-flex gap-3">
                    <a class="text-decoration-none text-muted" href="/">Home</a>
                    <a class="text-decoration-none text-muted" href="/recruitment">Recruitment</a>
                    <a class="text-decoration-none text-muted" href="/profile">My Profile</a>
                </nav>
            </div>
            <div class="text-muted">User</div>
        </div>
    </header>

    <main class="container py-5">
        <div class="text-center mb-4">
            <h2 class="mb-1 page-title">Favorit Anda</h2>
            <div class="small text-muted">Pilihan Terbaik Menuju Karier Impian</div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- if you want search/filters, re-enable below --}}
                {{-- <div class="card mb-4"><div class="card-body">...filters...</div></div> --}}

                @if(isset($favorites) && $favorites->count())
                    <div class="d-flex flex-column">
                        @foreach($favorites as $fav)
                            <div class="card-fav">
                                <div class="d-flex align-items-center">
                                    @if(!empty($fav->image))
                                        <img src="{{ $fav->image }}" alt="" class="avatar">
                                    @else
                                        <div class="avatar-fallback">
                                            {{ strtoupper(substr($fav->title ?? '', 0, 1)) }}
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-grow-1">
                                    <h5 class="mb-1">
                                        @if($fav->type === 'job')
                                            <a href="{{ url('/jobs/'.$fav->slug) }}" class="text-decoration-none">{{ $fav->title }}</a>
                                        @else
                                            <a href="{{ url('/companies/'.$fav->id) }}" class="text-decoration-none">{{ $fav->title }}</a>
                                        @endif
                                    </h5>

                                    <div class="d-flex gap-2 align-items-center mb-1">
                                        @if(!empty($fav->company))
                                            <div class="meta-line">{{ $fav->company }}</div>
                                        @elseif(!empty($fav->category))
                                            <div class="meta-line">{{ $fav->category }}</div>
                                        @endif
                                        <div class="small-muted">· {{ $fav->location ?? '—' }}</div>
                                    </div>

                                    <div class="d-flex gap-2 align-items-center">
                                        @if(!empty($fav->salary))
                                            <span class="badge-custom">Salary: {{ $fav->salary }}</span>
                                        @endif
                                        <div class="small-muted">Saved {{ ($fav->saved_at ?? $fav->created_at)->diffForHumans() }}</div>
                                    </div>
                                </div>

                                <form action="{{ route('favorites.destroy', $fav->id) }}" method="POST" onsubmit="return confirm('Hapus dari favorit?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-btn" title="Remove">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $favorites->withQueryString()->links() }}
                    </div>
                @else
                    <div class="card text-center p-4">
                        <div class="card-body">
                            <p class="mb-0">Anda belum memiliki favorit.</p>
                            <a href="/jobs" class="btn btn-primary mt-3">Jelajahi Lowongan</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
