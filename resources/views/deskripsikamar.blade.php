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
                <div id="autoCarouselSlider" class="flex transition-transform duration-500 ease-out h-64 md:h-96 w-full" data-total="{{ count($kamar->foto_kamar) }}">
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

            <div class="col-span-12 lg:col-span-3 space-y-4 p-1">
                <div class="flex flex-wrap gap-2">
                    <span class="bg-blue-50 text-[#1E40AF] border border-blue-100 px-6 py-2 rounded text-[10px] font-black uppercase">
                        {{ $kamar->available }} Kamar Tersedia
                    </span>
                    <span class="bg-forest-50 text-forest-700 border border-forest-100 px-6 py-2 rounded text-[10px] font-black uppercase">
                        Kapasitas {{ $kamar->jumlah_tamu }} Orang
                    </span>
                    <span class="bg-amber-50 text-amber-600 border border-amber-100 px-6 py-2 rounded text-[10px] font-black uppercase">
                        Ulasan {{ $kamar->rating }}/5 ({{ $reviews->count() }})
                    </span>
                </div>
                <div>
                    <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Tipe</p>
                    <h1 class="text-4xl font-black text-[#0f172a] tracking-tighter leading-none">{{ $kamar->nama_tipe }}</h1>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-6 bg-white p-6 md:p-8 rounded-md border border-gray-100 shadow-sm">
                <h3 class="text-lg font-black uppercase tracking-widest text-black mb-4">Deskripsi Detail</h3>
                <p class="text-gray leading-relaxed text-sm">
                    Nikmati kenyamanan menginap di {{ $kamar->nama_tipe }} kami. Kamar ini dilengkapi dengan berbagai fasilitas unggulan seperti {{ $kamar->fasilitas }}. Didesain khusus untuk memberikan pengalaman beristirahat yang maksimal dengan suasana yang tenang dan pelayanan prima dari tim StayEase.
                </p>
            </div>

            <div class="col-span-12 lg:col-span-3 bg-white p-6 md:p-8 rounded-md border border-gray-100 shadow-sm text-center flex flex-col justify-center">
                <span class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">Harga Kamar</span>
                <div class="text-[23px] font-black text-[black]">
                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                </div>
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">/ Malam</span>
                <a href="{{ route('booking.biodata', array_merge(['id' => request()->route('id')], request()->query())) }}" class="w-full bg-[#254117] text-white mt-6 py-4 rounded-xl font-bold uppercase tracking-widest text-sm text-center block cursor-pointer transition-all shadow-md hover:bg-[#1a2f0f]">
                    Pesan Sekarang
                </a>
            </div>

            <div class="col-span-12 mt-6 bg-white p-10 rounded-md border border-gray-100 shadow-sm">
                <h3 class="text-lg font-black text-[#0f172a] mb-8 border-b pb-4 border-gray-50">Ulasan Kamar</h3>
                <div class="space-y-8">
                    @forelse($reviews as $review)
                    <div class="flex gap-4 items-start border-b border-gray-50 pb-6">
                        <div class="w-12 h-12 rounded-full bg-[#8C6A1A] text-white flex items-center justify-center font-bold flex-shrink-0 shadow-sm">
                            {{ strtoupper(substr($review->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <p class="font-bold text-sm">{{ $review->user->name }}</p>
                                <span class="text-yellow-500 text-xs flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @else
                                            <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @endif
                                    @endfor
                                </span>
                            </div>
                            <p class="text-xs text-gray-400 mb-2">{{ $review->created_at->diffForHumans() }}</p>
                            <p class="text-gray-600 text-sm leading-relaxed">"{{ $review->comment }}"</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-400">
                        <p>Belum ada ulasan untuk tipe kamar ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>

    <script src="{{ asset('js/tamu/carousel.js') }}"></script>
</body>
</html>
