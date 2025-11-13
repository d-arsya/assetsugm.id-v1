<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Ketua ASSETS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
            opacity: 0.3;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: #ffffff;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }

        .header h1 {
            color: #ffffff;
            font-size: 28px;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            position: relative;
            z-index: 1;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .message {
            color: #666;
            line-height: 1.8;
            margin-bottom: 30px;
            font-size: 15px;
        }

        .info-box {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-left: 4px solid #667eea;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .info-box p {
            color: #333;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .info-box p:last-child {
            margin-bottom: 0;
        }

        .info-box strong {
            color: #667eea;
        }

        .button-container {
            text-align: center;
            margin: 40px 0;
        }

        .vote-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 16px 50px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
        }

        .vote-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #ddd, transparent);
            margin: 30px 0;
        }

        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #eee;
        }

        .footer p {
            color: #999;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .footer .brand {
            color: #667eea;
            font-weight: 600;
            font-size: 14px;
            margin-top: 15px;
        }

        .icon {
            display: inline-block;
            width: 24px;
            height: 24px;
            margin-right: 8px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">🗳️</div>
            <h1>Voting Ketua ASSETS</h1>
            <p>Periode 2025-2026</p>
        </div>

        <div class="content">
            <div class="greeting">
                Halo, {{ $name }}! 👋
            </div>

            <div class="message">
                <p>Kami dengan senang hati mengumumkan bahwa <strong>voting untuk memilih Ketua ASSETS periode 2025-2026
                        telah resmi dibuka!</strong></p>
                <br>
                <p>Suara Anda sangat berarti dalam menentukan pemimpin yang akan membawa ASSETS menjadi lebih baik. Mari
                    gunakan hak suara Anda dengan bijak.</p>
            </div>

            <div class="info-box">
                <p><strong>📋 Penting untuk diketahui:</strong></p>
                <p>• Link voting bersifat personal dan rahasia</p>
                <p>• Setiap mahasiswa hanya dapat memberikan 1 suara</p>
                <p>• Pastikan memilih dengan pertimbangan yang matang</p>
                <p>• Jangan bagikan link ini kepada orang lain</p>
            </div>

            <div class="button-container">
                <a href="{{ $votingLink }}" class="vote-button">
                    🗳️ Mulai Voting Sekarang
                </a>
            </div>

            <div class="divider"></div>

            <div class="message" style="font-size: 13px; color: #999;">
                <p>Jika tombol di atas tidak berfungsi, Anda dapat menyalin dan membuka link berikut di browser:</p>
                <p style="word-break: break-all; color: #667eea; margin-top: 10px;">{{ $votingLink }}</p>
            </div>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>Jika Anda mengalami kendala, silakan hubungi pengurus ASSETS.</p>
            <div class="brand">
                <strong>ASSETS</strong> - Association of Software Engineering Technology Students<br>
                Program Studi Teknologi Rekayasa Perangkat Lunak<br>
                Sekolah Vokasi, Universitas Gadjah Mada
            </div>
        </div>
    </div>
</body>

</html>
