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

    @include('components.navbar')

    <nav class="w-full bg-[#254117] px-[5%] py-3 border-b border-gray-200">
        <div class="bg-white inline-flex items-center border border-black rounded-lg bg- shadow-sm overflow-hidden">
            <div class="flex flex-col px-45 py-2 border-r border-black">
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Check-in / Out</span>
                <span class="text-[13px] font-bold text-[#1e293b]">{{ $checkin }} - {{ $checkout }}</span>
            </div>
            <div class="flex flex-col px-47 py-2 border-r border-black">
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Guests</span>
                <span class="text-[13px] font-bold text-[#1e293b]">{{ $guests ?? 2 }} Person</span>
            </div>
            <div class="px-46 py-2">
                <button class="text-[#254117] font-bold text-sm cursor-pointer hover:underline">Change</button>
            </div>
        </div>
    </nav>

    <main class="w-full px-[5%] py-8 bg-gray-200">
        @foreach($kamars as $index => $kamar)
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
                <div class="text-2xl font-black text-[black]">
                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                </div>
                <span class="text-xs text-gray-400">/ Malam</span>
                <a href="{{ route('kamar.show', $index) }}" 
                   class="w-full bg-[#8C6A1A] text-white mt-6 py-4 rounded-xl font-bold uppercase tracking-widest text-sm text-center block transition-all shadow-md hover:bg-[#5D4037] hover:shadow-lg">
                   Pesan Sekarang
                </a>
            </div>

        </div>
        @endforeach
    </main>

</body>
</html>
