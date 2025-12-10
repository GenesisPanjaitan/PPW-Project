<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Baru - CareerConnect</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 30px 20px;
        }
        .job-card {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .job-title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin: 0 0 10px 0;
        }
        .company-name {
            font-size: 18px;
            color: #667eea;
            margin: 0 0 15px 0;
        }
        .job-details {
            margin: 15px 0;
        }
        .detail-row {
            display: flex;
            margin: 8px 0;
            font-size: 14px;
        }
        .detail-label {
            font-weight: 600;
            color: #555;
            min-width: 100px;
        }
        .detail-value {
            color: #333;
        }
        .description {
            margin: 15px 0;
            padding: 15px;
            background-color: #fff;
            border-radius: 4px;
            line-height: 1.6;
            color: #555;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
            transition: transform 0.2s;
        }
        .cta-button:hover {
            transform: translateY(-2px);
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #e0e0e0;
        }
        .footer p {
            margin: 5px 0;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }
            .content {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>🎉 Lowongan Baru Tersedia!</h1>
            <p>Ada peluang karir menarik untukmu</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p style="font-size: 16px; color: #333;">Halo,</p>
            <p style="color: #555; line-height: 1.6;">
                Kami ingin memberitahukan bahwa ada lowongan pekerjaan baru yang mungkin sesuai dengan minat dan keahlianmu. 
                Jangan lewatkan kesempatan ini!
            </p>

            <div class="job-card">
                <h2 class="job-title">{{ $recruitment->position }}</h2>
                <p class="company-name">{{ $recruitment->company_name }}</p>

                <div class="job-details">
                    @if(!empty($recruitment->category))
                    <div class="detail-row">
                        <span class="detail-label">Kategori:</span>
                        <span class="detail-value">{{ $recruitment->category }}</span>
                    </div>
                    @endif

                    @if(!empty($recruitment->jobtype))
                    <div class="detail-row">
                        <span class="detail-label">Tipe Pekerjaan:</span>
                        <span class="detail-value">{{ $recruitment->jobtype }}</span>
                    </div>
                    @endif

                    @if(!empty($recruitment->location))
                    <div class="detail-row">
                        <span class="detail-label">Lokasi:</span>
                        <span class="detail-value">📍 {{ $recruitment->location }}</span>
                    </div>
                    @endif

                    <div class="detail-row">
                        <span class="detail-label">Tanggal Posting:</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($recruitment->date)->format('d M Y') }}</span>
                    </div>
                </div>

                @if(!empty($recruitment->description))
                <div class="description">
                    <strong>Deskripsi:</strong><br>
                    {{ Str::limit($recruitment->description, 200) }}
                </div>
                @endif
            </div>

            <center>
                <a href="{{ url('/recruitment/' . $recruitment->id) }}" class="cta-button">
                    Lihat Detail Lowongan →
                </a>
            </center>

            <p style="color: #777; font-size: 13px; margin-top: 30px; line-height: 1.6;">
                <strong>Tips:</strong> Segera daftar jika lowongan ini sesuai dengan minatmu. 
                Persiapkan CV dan portfolio terbaikmu sebelum melamar.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>CareerConnect</strong></p>
            <p>Platform Lowongan Kerja untuk Mahasiswa & Alumni</p>
            <p style="margin-top: 10px;">
                Email ini dikirim otomatis. Jangan balas email ini.<br>
                Kunjungi website kami di <a href="{{ url('/') }}" style="color: #667eea;">{{ url('/') }}</a>
            </p>
        </div>
    </div>
</body>
</html>
