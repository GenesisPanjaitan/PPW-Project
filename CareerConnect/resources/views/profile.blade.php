<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Profile - CareerConnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --accent:#6b5ce7;
            --muted:#f3f4fb;
            --soft:#eef0fb;
            --card-shadow: 0 8px 20px rgba(31,45,70,0.08);
            --pill-shadow: 0 2px 0 rgba(0,0,0,0.02);
            --text:#222;
        }
        html,body{height:100%}
        body{
            margin:0;
            font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #eef1fb;
            color:var(--text);
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
        }

        /* outer frame similar to screenshot */
        .frame{
            border:16px solid #bfc9f4;
            margin:18px;
            border-radius:6px;
            background:#fff;
        }

        /* page header */
        header{
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:26px 48px;
            background:linear-gradient(90deg,#fff,#fbfbff);
            border-bottom:1px solid rgba(15,23,42,0.03);
        }
        .brand{
            display:flex;
            align-items:center;
            gap:14px;
        }
        .logo{
            width:34px;height:34px;border-radius:6px;
            display:flex;align-items:center;justify-content:center;
            font-weight:700;color:var(--accent);
            box-shadow:var(--pill-shadow);
            background:linear-gradient(180deg,#fff,#f7f7ff);
            border:1px solid rgba(0,0,0,0.03);
        }
        .brand h1{margin:0;font-size:20px;letter-spacing:-0.3px}

        nav{display:flex;gap:28px;align-items:center;font-weight:600;color:#222;opacity:0.85}
        nav a{color:inherit;text-decoration:none}
        .user-mini{
            display:flex;align-items:center;gap:12px;color:#222;font-weight:600;
        }
        .user-mini .avatar{
            width:26px;height:26px;border-radius:50%;background:#111827;color:#fff;
            display:flex;align-items:center;justify-content:center;font-size:13px;
        }

        /* main content */
        .content{max-width:1100px;margin:34px auto;padding:0 24px 60px;}
        .page-title{color:var(--accent);font-weight:700;font-size:20px;margin:6px 0 6px}
        .subtitle{color:#9aa0b7;font-size:13px;margin-bottom:22px}

        /* tabs */
        .tabs{
            display:flex;gap:12px;align-items:center;
            background:var(--muted);padding:10px;border-radius:999px;max-width:720px;
            box-shadow:var(--pill-shadow);
            margin:18px 0 36px;
        }
        .tab{
            padding:10px 22px;border-radius:999px;background:transparent;color:#666;
            font-weight:600;font-size:14px;
        }
        .tab.active{
            background:white;border-radius:999px;padding:10px 22px;
            box-shadow:var(--card-shadow);color:var(--text);
        }

        .edit-btn{
            margin-left:auto;
            background:#0f1724;color:#fff;padding:10px 14px;border-radius:8px;font-weight:600;
            display:inline-flex;gap:8px;align-items:center;border:none;cursor:pointer;
            box-shadow:0 6px 18px rgba(15,23,36,0.08);
        }

        /* profile header area */
        .profile-head{display:flex;flex-direction:column;align-items:center;text-align:center;margin-bottom:26px}
        .avatar-large{
            width:92px;height:92px;border-radius:50%;background:#e7e7ee;color:#5a5a5a;
            display:flex;align-items:center;justify-content:center;font-size:30px;margin:12px 0;
            box-shadow:0 6px 16px rgba(18,24,38,0.05);
        }
        .photo-label{font-weight:700;margin:6px 0}
        .photo-sub{color:#9aa0b7;font-size:13px;margin-bottom:18px}

        /* info card */
        .card{
            background:white;border-radius:18px;padding:24px;box-shadow:var(--card-shadow);
            border:1px solid rgba(15,23,36,0.03);
        }
        .card-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;align-items:start}
        .card h3{margin:0 0 8px;font-size:15px}
        .card p.meta{margin:0;color:#9aa0b7;font-size:13px}

        .field{
            background:var(--soft);padding:14px;border-radius:10px;display:flex;gap:10px;align-items:center;
            color:#222;font-weight:600;border:1px solid rgba(15,23,36,0.02);
        }
        .field .icon{width:22px;height:22px;display:flex;align-items:center;justify-content:center;color:#6b7280}
        .field .value{flex:1;color:#444;font-weight:600}

        .badge{
            margin-left:auto;background:#4f7af0;color:#fff;padding:8px 12px;border-radius:999px;font-weight:700;
            display:inline-flex;align-items:center;gap:8px;font-size:13px;
        }

        /* responsive */
        @media (max-width:880px){
            .card-grid{grid-template-columns:1fr}
            header{padding:18px}
            .content{padding:0 18px}
            .tabs{flex-wrap:wrap}
        }
    </style>
</head>
<body>
    <div class="frame">
        <header>
            <div class="brand">
                <div class="logo">CC</div>
                <h1>CareerConnect</h1>
            </div>

            <nav>
                <a href="#">Home</a>
                <a href="#">Recruitment</a>
                <a href="#" style="color:var(--accent)">My Profile</a>
            </nav>

            <div class="user-mini">
                <div style="opacity:0.7;font-size:13px">User</div>
                <div class="avatar"></div>
            </div>
        </header>

        <main class="content">
            <div style="display:flex;align-items:center;gap:18px">
                <div>
                    <div class="page-title">My Profile</div>
                    <div class="subtitle">Kelola informasi profil dan pengaturan akun Anda</div>
                </div>
            </div>

            <div style="display:flex;align-items:center;gap:18px">
                <div class="tabs" role="tablist" aria-label="Profile sections" style="flex:1">
                    <div class="tab active">Informasi Dasar</div>
                    <div class="tab">Akademik & Karir</div>
                    <div class="tab">Pengaturan</div>
                </div>

                <button class="edit-btn" title="Edit Profil">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" style="filter:drop-shadow(0 1px 0 rgba(0,0,0,0.06))"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z" fill="white" opacity=".9"/><path d="M20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="white"/></svg>
                    Edit Profil
                </button>
            </div>

            <section class="profile-head" aria-labelledby="foto-profil">
                <div id="foto-profil" class="photo-label">Foto Profil</div>
                <div class="photo-sub">Upload foto profil untuk membantu orang mengenal Anda</div>
                <div class="avatar-large"></div>
            </section>

            <section class="card" aria-labelledby="informasi-personal" style="margin-top:18px">
                <div style="display:flex;align-items:flex-start;gap:18px">
                    <div>
                        <h3 id="informasi-personal">Informasi Personal</h3>
                        <p class="meta">Informasi dasar tentang diri Anda</p>
                    </div>

                    <div style="margin-left:auto">
                        <span class="badge">Mahasiswa</span>
                    </div>
                </div>

                <div style="height:18px"></div>

                <div class="card-grid">
                    <div style="display:flex;flex-direction:column;gap:14px">
                        <div class="field">
                            <div class="icon">👤</div>
                            <div class="value"> User</div>
                        </div>

                        <div class="field">
                            <div class="icon">🆔</div>
                            <div class="value">12S23001</div>
                        </div>
                    </div>

                    <div style="display:flex;flex-direction:column;gap:14px">
                        <div class="field">
                            <div class="icon">✉️</div>
                            <div class="value">User@gmail.com</div>
                        </div>

                        <div class="field">
                            <div class="icon">📞</div>
                            <div class="value">+62 811 2233 4455</div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>