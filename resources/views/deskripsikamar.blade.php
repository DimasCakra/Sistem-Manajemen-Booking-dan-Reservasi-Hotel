<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $kamar->nama_tipe }} - StayEase</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display, h1, h2, h3 { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#FFF4DE] text-[#1e293b] font-sans">

    @include('components.navbar')

    <main class="max-w-8xl mx-auto px-6 py-10">

        <div class="relative max-w-4xl mx-auto mb-10 overflow-hidden rounded-2xl shadow-sm border border-gray-100 bg-white">
            @if(is_array($kamar->foto_kamar) && count($kamar->foto_kamar) > 0)
                <!-- Wrapper Slider -->
                <div id="autoCarouselSlider" class="flex transition-transform duration-500 ease-out h-96 w-full" data-total="{{ count($kamar->foto_kamar) }}">
                    @foreach($kamar->foto_kamar as $index => $foto)
                        <div class="w-full h-full flex-shrink-0">
                            <img src="{{ asset('storage/' . $foto) }}"
                                class="w-full h-full object-cover"
                                alt="Foto Kamar {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>

                <!-- Tombol Navigasi Kiri -->
                <button id="prevBtn" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-black w-10 h-10 rounded-full shadow-md cursor-pointer transition-all flex items-center justify-center font-bold select-none z-10">
                    <
                </button>

                <!-- Tombol Navigasi Kanan -->
                <button id="nextBtn" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-black w-10 h-10 rounded-full shadow-md cursor-pointer transition-all flex items-center justify-center font-bold select-none z-10">
                    >
                </button>

                <!-- Indikator Titik (Dots) -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                    @foreach($kamar->foto_kamar as $index => $foto)
                        <span class="carousel-dot w-3 h-3 rounded-full bg-white/50 cursor-pointer transition-all" data-index="{{ $index }}"></span>
                    @endforeach
                </div>
            @else
                <div class="p-8 text-center text-gray-400">
                    Tidak ada foto untuk kamar ini.
                </div>
            @endif
        </div>

        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-10 lg:col-span-3 space-y-4 p-1 ml-2">
                <div class="flex flex-wrap gap-2">
                    <span class="bg-blue-50 text-[#1E40AF] border border-blue-100 px-6 py-2 rounded text-[10px] font-black uppercase">
                        {{ $kamar->available }} Kamar Tersedia
                    </span>
                    <span class="bg-forest-50 text-forest-700 border border-forest-100 px-6 py-2 rounded text-[10px] font-black uppercase">
                        Kapasitas {{ $kamar->jumlah_tamu }} Orang
                    </span>
                    <span class="bg-amber-50 text-amber-600 border border-amber-100 px-6 py-2 rounded text-[10px] font-black uppercase">
                        Ulasan {{ $kamar->rating }}/5 (252)
                    </span>
                </div>
                <div>
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Tipe</p>
                    <h1 class="text-4xl font-black text-[#0f172a] tracking-tighter leading-none">{{ $kamar->nama_tipe }}</h1>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-6 bg-white p-8 rounded-md border border-gray-100 shadow-sm">
                <h3 class="text-lg font-black uppercase tracking-widest text-black mb-4">Deskripsi Detail</h3>
                <p class="text-gray leading-relaxed text-sm">
                    Nikmati kenyamanan menginap di {{ $kamar->nama_tipe }} kami. Kamar ini dilengkapi dengan berbagai fasilitas unggulan seperti {{ $kamar->fasilitas }}. Didesain khusus untuk memberikan pengalaman beristirahat yang maksimal dengan suasana yang tenang dan pelayanan prima dari tim StayEase.
                </p>
            </div>

            <div class="col-span-12 lg:col-span-3 bg-white p-8 rounded-md border border-gray-100 shadow-sm text-center flex flex-col justify-center">
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Harga Kamar</p>
                <div class="text-2xl font-black text-black mb-6">
                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                </div>
                <a href="{{ route('booking.biodata', request()->route('id')) }}" class="w-full bg-[#254117] text-white mt-6 py-4 rounded-xl font-bold uppercase tracking-widest text-sm text-center block cursor-pointer transition-all shadow-md hover:bg-[#1a2f0f]">
                    Pesan Sekarang
                </a>
            </div>

            <div class="col-span-12 mt-6 bg-white p-10 rounded-md border border-gray-100 shadow-sm">
                <h3 class="text-lg font-black text-[#0f172a] mb-8 border-b pb-4 border-gray-50">Ulasan Kamar</h3>
                <div class="space-y-8">
                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-full bg-gray-100 flex-shrink-0 border border-gray-200"></div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <p class="font-bold text-sm">Budi Santoso</p>
                                <span class="text-yellow-500 text-md">★★★★★</span>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">"Sangat puas dengan layanan StayEase. Fasilitas {{ $kamar->nama_tipe }} sesuai dengan yang dijanjikan, sangat bersih dan nyaman untuk keluarga."</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="{{ asset('js/tamu/carousel.js') }}"></script>
</body>
</html>
