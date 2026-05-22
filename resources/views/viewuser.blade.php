<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User Aplikasi</title>
</head>
<body>

    <h1>Daftar Pengguna Sistem</h1>

    @if($users->isEmpty())
        <p>Belum ada data user yang tersimpan di database.</p>
    @else
        @foreach ($users as $index => $user)
            <div class="user-box">
                <h2>Pengguna #{{ $index + 1 }}</h2>
                
                <p><strong>Nama Lengkap:</strong> {{ $user->name }}</p>
                <p><strong>Alamat Email:</strong> {{ $user->email }}</p>
                <p><strong>Nomor WhatsApp:</strong> {{ $user->whatsapp ?? 'Tidak ada nomor' }}</p>
                <p><strong>Username Akun:</strong> {{ $user->username }}</p>
                
            </div>
        @endforeach
    @endif

</body>
</html>