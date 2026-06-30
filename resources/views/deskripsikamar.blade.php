<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $kamar->nama_tipe }} | StayEase</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FFF4DE; color: #1a1a1a; }
        .font-display, h1, h2, h3 { font-family: 'Playfair Display', serif; }
        .btn-primary {
            background: linear-gradient(135deg, #1e3c28 0%, #2a5a3b 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #152b1c 0%, #1e3c28 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(30, 60, 40, 0.6);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="antialiased selection:bg-[#2a5a3b] selection:text-white">

    @include('components.navbar')

    <!-- Navigation Breadcrumb -->
    <div class="max-w-7xl mx-auto px-6 pt-16 pb-2">
        <a href="/katalog?{{ http_build_query(request()->query()) }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#1e3c28] transition-colors">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Katalog
        </a>
    </div>

    <main class="max-w-7xl mx-auto px-6 pb-20">
        
        <!-- Header & Title -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-5">
            <div>
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    @if($kamar->available > 0)
                        <span class="bg-green-100/80 text-green-700 px-3.5 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            {{ $kamar->available }} Kamar Tersedia
                        </span>
                    @else
                        <span class="bg-red-100/80 text-red-700 px-3.5 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-circle-xmark"></i> Penuh
                        </span>
                    @endif
                    <span class="bg-[#1e3c28]/10 text-[#1e3c28] px-3.5 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-users"></i> Kapasitas {{ $kamar->jumlah_tamu }}
                    </span>
                    <span class="bg-yellow-100/80 text-yellow-700 px-3.5 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-star text-[10px]"></i> {{ $kamar->rating }}/5 ({{ $reviews->count() }})
                    </span>
                </div>
                <h1 class="font-display text-4xl md:text-6xl font-bold text-gray-900 tracking-tight">{{ $kamar->nama_tipe }}</h1>
            </div>
            
            <!-- Mobile Price (hidden on desktop) -->
            <div class="md:hidden w-full bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex justify-between items-center mt-4">
                 <div>
                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest block mb-1">Harga / malam</span>
                    <span class="text-2xl font-black text-[#1e3c28]">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                 </div>
                 @if($kamar->available > 0)
                    <a href="{{ route('booking.biodata', array_merge(['id' => request()->route('id')], request()->query())) }}" class="btn-primary text-white px-5 py-3 rounded-xl font-bold uppercase tracking-widest text-[10px] text-center shadow-md">
                        Pesan
                    </a>
                 @endif
            </div>
        </div>

        <!-- Image Gallery Slider -->
        <div class="relative w-full h-[40vh] md:h-[50vh] mb-10 rounded-[2rem] overflow-hidden shadow-xl border border-white/40 bg-gray-100 group">
            @if(is_array($kamar->foto_kamar) && count($kamar->foto_kamar) > 0)
                <!-- Wrapper Slider -->
                <div id="autoCarouselSlider" class="flex transition-transform duration-700 ease-in-out h-full w-full" data-total="{{ count($kamar->foto_kamar) }}">
                    @foreach($kamar->foto_kamar as $index => $foto)
                        <div class="w-full h-full flex-shrink-0 relative">
                            <img src="{{ asset('storage/' . $foto) }}"
                                class="w-full h-full object-cover"
                                alt="Foto Kamar {{ $index + 1 }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigasi -->
                <button id="prevBtn" class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 w-12 h-12 rounded-full shadow-lg cursor-pointer transition-all flex items-center justify-center text-lg z-10 opacity-0 group-hover:opacity-100 hover:scale-110">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button id="nextBtn" class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 w-12 h-12 rounded-full shadow-lg cursor-pointer transition-all flex items-center justify-center text-lg z-10 opacity-0 group-hover:opacity-100 hover:scale-110">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

                <!-- Dots -->
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3 z-10 bg-black/20 backdrop-blur-md px-5 py-2.5 rounded-full">
                    @foreach($kamar->foto_kamar as $index => $foto)
                        <span class="carousel-dot w-2 h-2 rounded-full bg-white/60 cursor-pointer transition-all hover:bg-white" data-index="{{ $index }}"></span>
                    @endforeach
                </div>
            @else
                <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-400">
                    <div class="text-center">
                        <i class="fa-regular fa-images text-5xl mb-4 opacity-50"></i>
                        <p class="font-medium">Tidak ada foto untuk kamar ini.</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left content: Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description Box -->
                <div class="bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#FFF4DE] rounded-bl-full -z-0 opacity-50"></div>
                    
                    <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-6 flex items-center gap-3 relative z-10">
                        <i class="fa-solid fa-circle-info text-[#d4af37] text-sm"></i> Tentang Kamar
                    </h3>
                    <p class="text-gray-600 leading-relaxed text-[15px] font-light relative z-10">
                        Nikmati kenyamanan menginap di <strong class="font-bold text-gray-900">{{ $kamar->nama_tipe }}</strong> kami. Kamar ini dilengkapi dengan berbagai fasilitas unggulan seperti 
                        <span class="text-gray-900 font-medium">{{ $kamar->fasilitas }}</span>. 
                        Didesain khusus untuk memberikan pengalaman beristirahat yang maksimal dengan suasana yang tenang dan pelayanan prima dari tim StayEase.
                    </p>
                </div>

                <!-- Reviews Box -->
                <div class="bg-white p-8 md:p-10 rounded-[2rem] border border-gray-100 shadow-sm">
                    <div class="flex justify-between items-end mb-8 border-b border-gray-50 pb-6">
                        <div>
                            <h3 class="text-xl font-display font-bold text-gray-900 mb-2">Ulasan Tamu</h3>
                            <p class="text-xs text-gray-400 font-medium">Apa kata mereka tentang kamar ini?</p>
                        </div>
                        <div class="flex flex-col items-end">
                            <div class="flex items-center gap-1.5 mb-1 text-yellow-400 text-xl">
                                <i class="fa-solid fa-star"></i>
                                <span class="font-black text-2xl text-gray-900">{{ $kamar->rating }}<span class="text-sm text-gray-400 font-normal">/5</span></span>
                            </div>
                            <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">{{ $reviews->count() }} ulasan</span>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        @forelse($reviews as $review)
                        <div class="flex gap-5 items-start p-6 rounded-2xl bg-gray-50/50 hover:bg-gray-50 transition-colors border border-gray-100">
                            <div class="w-12 h-12 rounded-full bg-[#1e3c28] text-white flex items-center justify-center font-bold text-lg flex-shrink-0 shadow-sm">
                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-bold text-sm text-gray-900">{{ $review->user->name }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-0.5">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="flex text-yellow-400 text-[11px] gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fa-solid fa-star"></i>
                                            @else
                                                <i class="fa-regular fa-star text-gray-300"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed mt-3 italic">"{{ $review->comment }}"</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300 border border-gray-100">
                                <i class="fa-regular fa-comment-dots text-2xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium text-sm mb-1">Belum ada ulasan</p>
                            <p class="text-gray-400 text-xs">Jadilah yang pertama memberikan ulasan untuk tipe kamar ini.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right col: Price & Booking Sticky Panel -->
            <div class="lg:col-span-1 hidden md:block">
                <div class="glass-panel p-8 rounded-[2rem] shadow-xl sticky top-28 border border-white">
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-widest block mb-2">Harga Mulai Dari</span>
                        <div class="flex items-baseline gap-1 mb-1">
                            <span class="text-sm font-bold text-gray-900">Rp</span>
                            <span class="text-4xl font-black text-[#1e3c28] tracking-tighter">{{ number_format($kamar->harga, 0, ',', '.') }}</span>
                        </div>
                        <span class="text-[11px] text-gray-500 font-medium mt-1">/ Malam <span class="block opacity-70 mt-1">(Belum termasuk pajak)</span></span>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-3">
                            <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-check text-[10px] text-green-600"></i>
                            </div>
                            <span class="text-sm text-gray-600 font-medium">Jaminan Harga Terbaik</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-check text-[10px] text-green-600"></i>
                            </div>
                            <span class="text-sm text-gray-600 font-medium">Tanpa Biaya Tersembunyi</span>
                        </div>
                    </div>

                    @if($kamar->available > 0)
                        <a href="{{ route('booking.biodata', array_merge(['id' => request()->route('id')], request()->query())) }}" 
                           class="btn-primary w-full text-white py-4 rounded-xl font-bold uppercase tracking-widest text-xs text-center block shadow-lg shadow-green-900/20">
                            Pesan Sekarang
                        </a>
                        <p class="text-[10px] text-center text-gray-400 mt-4 font-bold uppercase tracking-wider">Hanya tersisa <span class="text-[#d4af37]">{{ $kamar->available }}</span> kamar!</p>
                    @else
                        <button type="button" disabled
                           class="w-full bg-gray-200 text-gray-400 py-4 rounded-xl font-bold uppercase tracking-widest text-xs text-center block cursor-not-allowed">
                           Kamar Penuh
                        </button>
                    @endif
                </div>
            </div>

        </div>
    </main>

    @include('components.footer')

    <script src="{{ asset('js/tamu/carousel.js') }}"></script>
</body>
</html>
