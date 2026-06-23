<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi - Tiketara</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #020D1A; color: #ffffff; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 40px 20px; text-align: center; }
        .box { background-color: #041830; padding: 40px; border-radius: 12px; border: 1px solid rgba(255, 255, 255, 0.05); }
        h1 { color: #C9A84C; font-size: 24px; margin-top: 0; }
        p { color: #4A9FD4; font-size: 16px; line-height: 1.6; margin-bottom: 30px; }
        .btn { display: inline-block; background-color: #C9A84C; color: #020D1A; font-weight: bold; text-decoration: none; padding: 14px 32px; border-radius: 8px; font-size: 16px; margin-bottom: 30px; }
        .footer { margin-top: 30px; font-size: 12px; color: #4A9FD4; opacity: 0.7; }
        .link-text { font-size: 12px; word-break: break-all; color: #4A9FD4; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>Halo, {{ $notifiable->name ?? 'Pengguna Tiketara' }}!</h1>
            <p>Anda menerima email ini karena kami menerima permintaan penyetelan ulang kata sandi untuk akun Anda.</p>
            
            <a href="{{ $url }}" class="btn">Reset Kata Sandi</a>
            
            <p>Tautan reset kata sandi ini akan kedaluwarsa dalam 60 menit.<br>
            Jika Anda tidak meminta penyetelan ulang kata sandi, tidak ada tindakan lebih lanjut yang diperlukan.</p>

            <div class="link-text">
                Jika Anda kesulitan mengeklik tombol "Reset Kata Sandi", salin dan tempel URL di bawah ini ke browser web Anda:<br>
                <a href="{{ $url }}" style="color: #C9A84C;">{{ $url }}</a>
            </div>
        </div>
        
        <div class="footer">
            &copy; {{ date('Y') }} Tiketara. All rights reserved.<br>
            Pesan otomatis, mohon tidak membalas email ini.
        </div>
    </div>
</body>
</html>
