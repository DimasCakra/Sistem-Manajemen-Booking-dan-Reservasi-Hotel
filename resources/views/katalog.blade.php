<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kamar</title>
    <link rel="stylesheet" href="{{ asset('css/katalog.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>

    <header class="header">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTE5hirGcGYW4VJKa63FFemb3xfb23CdjNJlg&s" 
        class="mx-auto h-20 w-auto rounded-[30px]" alt="Deskripsi">
        <div class="auth-buttons">
            <a href="/login" class="btn-login">Login</a>
            <a href="#" class="btn-register">Registrasi</a>
        </div>
    </header>

    <nav class="filter-nav">
    <div class="filter-box">
        <div class="filter-item border-right">
            <span class="label">CHECK-IN / OUT</span>
            <span class="value">{{ $checkin }} - {{ $checkout }}</span>
        </div>
        <div class="filter-item border-right">
            <span class="label">GUESTS</span>
            <span class="value">{{ $guests ?? 2 }} Person</span>
        </div>
        <div class="filter-item btn-edit-area">
            <button class="btn-change">Change</button>
        </div>
    </div>
</nav>

    <main class="content-container">
        @foreach($kamars as $kamar)
        <div class="card-katalog">
            
            <div class="box-foto">
                <img src="{{ $kamar->gambar }}" alt="Foto Kamar">
            </div>

            <div class="box-info">
                <div class="top-info">
                    <div class="badge-available">{{ $kamar->available }} Room Available</div>
                    <div class="badge-rating">★ {{ $kamar->rating }}</div>
                </div>

                <h2 class="tipe-kamar">{{ $kamar->nama_tipe }}</h2>

                <p class="deskripsi-kamar">{{ $kamar->fasilitas }}</p>
            </div>

            <div class="box-harga">
                <span class="price-label">Start From</span>
                <div class="price-value">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</div>
                <span class="price-unit">/ Night</span>
                <button class="btn-book">BOOK NOW</button>
            </div>

        </div>
        @endforeach
    </main>

</body>
</html>
