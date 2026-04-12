<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kamar</title>
    <link rel="stylesheet" href="{{ asset('css/katalog.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#fffaf5] text-[#333] font-sans">

    <header class="w-full bg-gradient-to-r from-[#f2994a] to-[#f2c94c] px-[5%] py-4 flex justify-between items-center shadow-lg">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTE5hirGcGYW4VJKa63FFemb3xfb23CdjNJlg&s" 
             class="h-20 w-auto rounded-[30px]" alt="Logo">
        
        <div class="flex gap-4">
            <a href="/login" class="bg-white text-[#f5923c] px-6 py-1.5 rounded-md font-bold no-underline hover:bg-gray-100 transition">Login</a>
            <a href="/register" class="bg-white text-[#f89640] px-6 py-1.5 rounded-md font-bold no-underline hover:bg-gray-100 transition">Registrasi</a>
        </div>
    </header>

    <nav class="w-full bg-white px-[5%] py-3 border-b border-gray-300">
        <div class="inline-flex items-center border border-[#f2994a] rounded-lg bg-white overflow-hidden">
            <div class="flex flex-col px-5 py-2 border-r border-[#f2994a]">
                <span class="text-[11px] text-[#f2994a] font-bold uppercase">Check-in / Out</span>
                <span class="text-[13px] font-bold text-gray-800">{{ $checkin }} - {{ $checkout }}</span>
            </div>
            <div class="flex flex-col px-5 py-2 border-r border-[#f2994a]">
                <span class="text-[11px] text-[#f2994a] font-bold uppercase">Guests</span>
                <span class="text-[13px] font-bold text-gray-800">{{ $guests ?? 2 }} Person</span>
            </div>
            <div class="px-4">
                <button class="bg-[#f2994a] text-white px-4 py-1.5 rounded font-bold text-sm cursor-pointer hover:bg-[#e68a3d] transition">Change</button>
            </div>
        </div>
    </nav>

    <main class="w-full px-[5%] py-8">
        @foreach($kamars as $kamar)
        <div class="bg-white w-full flex mb-6 rounded-[20px] border-[10px] border-white shadow-[-10px_-5px_18px_rgba(0,0,0,0.1)] min-h-[260px] h-auto overflow-visible">
            
            <div class="w-[350px] shrink-0">
                <img src="{{ $kamar->gambar }}" class="w-full h-full object-cover block" alt="Foto Kamar">
            </div>

            <div class="grow p-8 flex flex-col gap-4 min-w-0">
                <div class="flex gap-3">
                    <div class="bg-[#e6fffa] text-[#0d9488] px-3 py-1 text-[11px] font-bold rounded border border-[#b2f5ea]">
                        {{ $kamar->available }} Room Available
                    </div>
                    <div class="bg-[#fffaf0] text-[#d97706] px-3 py-1 text-[11px] font-bold rounded border border-[#feebc8]">
                        ★ {{ $kamar->rating }}
                    </div>
                </div>

                <h2 class="text-[25px] font-[800] uppercase tracking-tight">{{ $kamar->nama_tipe }}</h2>

                <p class="text-[15px] text-[#666] leading-relaxed break-all whitespace-normal">
                    {{ $kamar->fasilitas }}
                </p>
            </div>

            <div class="w-[280px] p-8 bg-[#fffaf5] border-l border-dashed border-gray-300 flex flex-col justify-center items-center shrink-0">
                <span class="text-xs text-gray-400 uppercase">Start From</span>
                <div class="text-[24px] font-[900] text-[#f2994a]">
                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                </div>
                <span class="text-xs text-gray-400">/ Night</span>
                <button class="w-full bg-[#f2994a] text-white mt-5 py-4 rounded-lg font-bold uppercase tracking-wide cursor-pointer hover:bg-[#e68a3d] transition-all shadow-md">
                    BOOK NOW
                </button>
            </div>

        </div>
        @endforeach
    </main>

</body>
</html>
