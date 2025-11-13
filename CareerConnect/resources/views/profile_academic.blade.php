<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil - Akademik & Karir | CareerConnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
      :root{--accent:#4b63ff;--outer:#dfe7ff;--muted:#9aa0b7}
      html,body{height:100%;margin:0;font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial}
      body{background:var(--outer);}
      .site{max-width:1180px;margin:18px auto;background:#fff;border-radius:6px;overflow:hidden}
      header.site-header{display:flex;align-items:center;justify-content:space-between;padding:18px 28px;background:linear-gradient(90deg,#fff 0%, rgba(75,99,255,0.04) 70%);border-bottom:1px solid rgba(0,0,0,0.04)}
      .logo{display:flex;align-items:center;gap:12px;font-weight:700}
      .logo .icon{width:28px;height:28px;border-radius:6px;background:#fff;color:var(--accent);display:inline-flex;align-items:center;justify-content:center;border:1px solid rgba(0,0,0,0.04)}
      nav.center{display:flex;gap:28px;align-items:center}
      nav.center a{color:#111;text-decoration:none}
      nav.center a.active{color:var(--accent);font-weight:600}
      .user{display:flex;align-items:center;gap:8px}
      .container{padding:28px}
      .page-title{color:var(--accent);font-weight:600;margin:8px 0}
      .subtitle{color:var(--muted);margin:6px 0 22px}
      .tabs{display:flex;gap:12px;background:#f3f4f6;padding:10px;border-radius:999px;align-items:center}
      .tab{padding:8px 18px;border-radius:999px;color:var(--muted)}
      .tab.active{background:#fff;box-shadow:0 8px 20px rgba(16,24,40,0.06);color:var(--accent);}
      .card{background:#fff;border-radius:12px;padding:18px;margin-top:18px;border:1px solid rgba(0,0,0,0.06);box-shadow:0 10px 28px rgba(2,6,23,0.04)}
      .card + .card{margin-top:22px}
      .card h4{margin:0 0 6px}
      .card p.desc{color:var(--muted);margin:0 0 12px}
      .item{background:#f3f4f6;padding:12px;border-radius:10px;display:flex;align-items:center;gap:12px}
      .chip{display:inline-block;background:#f3f4f6;padding:8px 12px;border-radius:10px;margin-right:8px}
      @media (max-width:900px){.container{padding:18px}.logo{font-size:16px}}
    </style>
  </head>
  <body>
    <div class="site">
      <header class="site-header">
        <div class="logo">
          <span class="icon">CC</span>
          <span>CareerConnect</span>
        </div>

        <nav class="center">
          <a href="/home">Home</a>
          <a href="/recruitment">Recruitment</a>
          <a class="active" href="/profile">My Profile</a>
        </nav>

        <div class="user">
          @auth
            {{ Auth::user()->name }}
          @else
            Guest
          @endauth
        </div>
      </header>

      <div class="container">
        <h2 class="page-title">My Profile</h2>
        <p class="subtitle">Kelola informasi profil dan pengaturan akun Anda</p>

        <div style="display:flex;align-items:center;justify-content:space-between;gap:18px">
          <div style="flex:1">
            <div class="tabs" role="tablist">
              <div class="tab">Informasi Dasar</div>
              <div class="tab active">Akademik & Karir</div>
              <div class="tab">Pengaturan</div>
            </div>
          </div>
        </div>

        <!-- Informasi Akademik -->
        <div class="card">
          <h4>Informasi Akademik</h4>
          <p class="desc">Detail tentang pendidikan dan program studi Anda</p>

          <label style="font-size:13px;color:var(--muted);margin-bottom:8px;display:block">Jurusan / Program Studi</label>
          <div class="item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM4 20c0-3.31 2.69-6 6-6h4c3.31 0 6 2.69 6 6" stroke="#888" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div>Sistem Informasi</div>
          </div>
        </div>

        <!-- Minat & Karir -->
        <div class="card">
          <h4>Minat & Karir</h4>
          <p class="desc">Bidang pekerjaan yang Anda minati</p>

          <label style="font-size:13px;color:var(--muted);margin-bottom:8px;display:block">Minat Karir</label>
          <div class="item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 2l3 7h7l-5.5 4.5L20 21l-8-5-8 5 1.5-7.5L0 9h7l3-7z" stroke="#888" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <div>Software Development</div>
          </div>
        </div>

        <!-- Skills & Keahlian -->
        <div class="card">
          <h4>Skills & Keahlian</h4>
          <p class="desc">Skill teknis dan soft skill yang Anda kuasai</p>

          <div style="display:flex;gap:8px;flex-wrap:wrap">
            <span class="chip">Python</span>
            <span class="chip">Javascript</span>
            <span class="chip">C++</span>
          </div>
        </div>

      </div>
    </div>
  </body>
</html>
