<style>
    .topbar { position: relative; background:linear-gradient(180deg,#fff,#f3f7fb); box-shadow:0 2px 6px rgba(0,0,0,.03); }
    .header-container { /* remove position: relative; */ }
    .centered-bar {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        display: inline-flex;
        gap: 1rem;
        background: #f7fbff;
        padding: .5rem 1.25rem;
        border-radius: 999px;
        box-shadow: 0 4px 14px rgba(17,24,39,.06);
        align-items: center;
    }
    @media (max-width: 767px) {
        .centered-bar { position: static; transform: none; margin: .5rem auto; }
    }
</style>

<header class="topbar py-2">
    <!-- centered pill/nav now centered relative to .topbar -->
    <nav class="centered-bar d-none d-md-flex">
        <a class="text-decoration-none text-muted" href="#">Informasi Dasar</a>
        <a class="text-decoration-none text-muted" href="#">Akademik & Karir</a>
        <a class="text-decoration-none text-muted" href="#">Pengaturan</a>
    </nav>

    <div class="container header-container d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <strong class="brand h5 mb-0">CareerConnect</strong>
        </div>

        <div class="text-muted">User</div>
    </div>
</header>
