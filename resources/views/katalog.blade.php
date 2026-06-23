<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kamar</title>
    <link rel="stylesheet" href="{{ asset('css/katalog.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display, h1, h2, h3 { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#FFF4DE]">

    @include('components.navbar')

    <nav class="w-full bg-[#254117] px-[5%] py-4 border-b border-white/10 flex justify-center fixed">
        <div class="bg-white flex items-center border border-gray-200 rounded-xl shadow-md overflow-hidden min-w-[600px]">

            <div class="flex-1 flex flex-col px-40 py-2 border-r border-gray-400">
                <span class="text-[9px] text-gray-500 font-bold uppercase tracking-[0.1em]">Check-In / Check-Out</span>
                <span class="text-[13px] font-bold text-[#0f172a] whitespace-nowrap">
                    {{ $checkin ? \Carbon\Carbon::parse($checkin)->format('d M Y') : '-' }} - {{ $checkout ? \Carbon\Carbon::parse($checkout)->format('d M Y') : '-' }}
                </span>
            </div>

            <div class="flex-1 flex flex-col px-40 py-2 border-r border-gray-400">
                <span class="text-[9px] text-gray-500 font-bold uppercase tracking-[0.1em]">Jumlah Tamu</span>
                <span class="text-[13px] font-bold text-[#0f172a] whitespace-nowrap">{{ $guests ?? 2 }} Orang</span>
            </div>

            <div class="px-40 py-2 bg-gray-50/50">
                <a href="/home?checkin={{ $checkin }}&checkout={{ $checkout }}&guests={{ $guests }}"
                class="text-[#254117] font-extrabold text-xs uppercase tracking-tighter hover:text-[#1a2f0f] transition-colors">
                    Ubah
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-8xl mx-auto px-6 py-10 pt-32 bg-[#FFF4DE]">
        @foreach($kamars as $index => $kamar)
        <div class="bg-white w-full flex mb-8 rounded-2xl shadow-[0_10px_25px_-5px_rgba(0,0,0,0.05)] overflow-hidden border border-gray-100 transition-transform">

            <div class="w-[380px] shrink-0 overflow-hidden h-[230px]">
                <img src="{{ $kamar->gambar }}" class="w-full h-full object-cover transition-transform duration-500" alt="Foto Kamar">
            </div>

            <div class="grow p-8 flex flex-col gap-4">
                <div class="flex gap-3 flex-wrap">
                    <div class="bg-blue-50 text-[#1E40AF] px-3 py-1 text-[11px] font-bold rounded-full border border-blue-100">
                        {{ $kamar->available }} Kamar Tersedia
                    </div>
                    <div class="bg-forest-50 text-forest-700 px-3 py-1 text-[11px] font-bold rounded-full border border-forest-100">
                        Kapasitas: {{ $kamar->jumlah_tamu }} Orang
                    </div>
                    <div class="bg-amber-50 text-amber-600 px-3 py-1 text-[11px] font-bold rounded-full border border-amber-100">
                        ★ {{ $kamar->rating }} Ulasan
                    </div>
                </div>

                <h2 class="text-2xl font-extrabold text-[#0f172a] tracking-tight">{{ $kamar->nama_tipe }}</h2>

                <p class="text-[15px] text-gray-500 leading-relaxed max-w-xl">
                    {{ $kamar->fasilitas }}
                </p>
            </div>

            <div class="w-[280px] p-8 bg-slate-50 flex flex-col justify-center items-center shrink-0 border-l border-gray-100">
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Mulai Dari</span>
                <div class="text-[23px] font-black text-[black]">
                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                </div>
                <span class="text-xs text-gray-400">/ Malam</span>
                @if($kamar->available > 0)
                    <a href="{{ route('kamar.show', array_merge(['id' => $kamar->id_tipe_kamar], request()->query())) }}"
                       class="w-full bg-[#254117] text-white mt-6 py-4 rounded-xl font-bold uppercase tracking-widest text-sm text-center block cursor-pointer transition-all shadow-md hover:bg-[#1a2f0f]">
                       Pesan Sekarang
                    </a>
                @else
                    <button type="button" disabled
                       class="w-full bg-slate-300 text-slate-700 mt-6 py-4 rounded-xl font-bold uppercase tracking-widest text-sm text-center block cursor-not-allowed">
                       Penuh
                    </button>
                @endif
            </div>

        </div>
        @endforeach
    </main>

    @include('components.footer')

</body>
</html>
