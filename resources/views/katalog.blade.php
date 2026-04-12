<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kamar</title>
    <link rel="stylesheet" href="{{ asset('css/katalog.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#f8fafc] text-[#1e293b] font-sans">

    <header class="w-full bg-[#1E40AF] px-[5%] py-4 flex justify-between items-center shadow-lg">
        <div class="flex items-center gap-2">
            <div class="bg-white p-2 rounded-lg">
                <span class="text-[#1E40AF] font-bold text-2xl tracking-tighter">STAY<span class="text-[#3B82F6]">ease</span></span>
            </div>
        </div>
        
        <div class="flex gap-4">
            <a href="/login" class="bg-[#1E3A8A] text-white px-6 py-1.5 rounded-md font-medium no-underline hover:bg-white/10 transition">Masuk</a>
            <a href="/register" class="bg-[#1E3A8A] text-white px-6 py-1.5 rounded-md font-bold no-underline hover:bg-[#172554] transition shadow-md">Daftar Sekarang →</a>
        </div>
    </header>

    <nav class="w-full bg-white px-[5%] py-3 border-b border-gray-200">
        <div class="inline-flex items-center border border-blue-100 rounded-lg bg-white shadow-sm overflow-hidden">
            <div class="flex flex-col px-5 py-2 border-r border-gray-100">
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Check-in / Out</span>
                <span class="text-[13px] font-bold text-[#1e293b]">{{ $checkin }} - {{ $checkout }}</span>
            </div>
            <div class="flex flex-col px-5 py-2 border-r border-gray-100">
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Guests</span>
                <span class="text-[13px] font-bold text-[#1e293b]">{{ $guests ?? 2 }} Person</span>
            </div>
            <div class="px-4">
                <button class="text-[#1E40AF] font-bold text-sm cursor-pointer hover:underline">Change</button>
            </div>
        </div>
    </nav>

    <main class="w-full px-[5%] py-8">
        @foreach($kamars as $kamar)
        <div class="bg-white w-full flex mb-8 rounded-2xl shadow-[0_10px_25px_-5px_rgba(0,0,0,0.05)] overflow-hidden border border-gray-100 transition-transform">
            
            <div class="w-[380px] shrink-0 overflow-hidden">
                <img src="{{ $kamar->gambar }}" class="w-full h-full object-cover transition-transform duration-500" alt="Foto Kamar">
            </div>

            <div class="grow p-8 flex flex-col gap-4">
                <div class="flex gap-3">
                    <div class="bg-blue-50 text-[#1E40AF] px-3 py-1 text-[11px] font-bold rounded-full border border-blue-100">
                        {{ $kamar->available }} Kamar Tersedia
                    </div>
                    <div class="bg-amber-50 text-amber-600 px-3 py-1 text-[11px] font-bold rounded-full border border-amber-100">
                        ★ {{ $kamar->rating }} Rating
                    </div>
                </div>

                <h2 class="text-2xl font-extrabold text-[#0f172a] tracking-tight">{{ $kamar->nama_tipe }}</h2>

                <p class="text-[15px] text-gray-500 leading-relaxed max-w-xl">
                    {{ $kamar->fasilitas }}
                </p>
            </div>

            <div class="w-[280px] p-8 bg-slate-50 flex flex-col justify-center items-center shrink-0 border-l border-gray-100">
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Mulai Dari</span>
                <div class="text-2xl font-black text-[#1E40AF]">
                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                </div>
                <span class="text-xs text-gray-400">/ Malam</span>
                <button class="w-full bg-[#1E40AF] text-white mt-6 py-4 rounded-xl font-bold uppercase tracking-widest text-sm cursor-pointer hover:bg-[#1E40AF] transition-all shadow-lg hover:shadow-blue-200">
                    Pesan Sekarang
                </button>
            </div>

        </div>
        @endforeach
    </main>

</body>
</html>
