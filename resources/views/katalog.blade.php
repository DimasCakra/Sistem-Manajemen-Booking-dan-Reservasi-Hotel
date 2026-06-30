<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kamar | StayEase</title>
    <link rel="stylesheet" href="{{ asset('css/katalog.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FFF4DE; color: #1a1a1a; }
        .font-display, h1, h2, h3 { font-family: 'Playfair Display', serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .btn-primary {
            background: linear-gradient(135deg, #1e3c28 0%, #2a5a3b 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #152b1c 0%, #1e3c28 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(30, 60, 40, 0.6);
        }
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -15px rgba(0,0,0,0.08);
        }
        .img-zoom-container {
            overflow: hidden;
        }
        .img-zoom {
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover .img-zoom {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="antialiased selection:bg-[#2a5a3b] selection:text-white">

    @include('components.navbar')

    <!-- Hero / Header Section -->
    <div class="relative pt-12 pb-20 bg-[#1a2f0f] overflow-hidden">
        <!-- Decorative pattern/gradient -->
        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-[#d4af37] via-transparent to-transparent"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <h1 class="font-display text-4xl md:text-5xl font-bold text-white mb-4">Pilih Kamar Impian Anda</h1>
            <p class="text-white/80 text-lg font-light max-w-2xl mx-auto">Temukan kenyamanan tak tertandingi dengan pilihan kamar yang dirancang khusus untuk pengalaman menginap Anda.</p>
        </div>
    </div>

    <!-- Search Summary Bar -->
    <div class="max-w-5xl mx-auto px-6 -mt-10 relative z-20">
        <div class="glass-panel rounded-2xl shadow-xl p-2 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex flex-1 w-full divide-x divide-gray-200">
                <div class="flex-1 px-6 py-4 flex items-center gap-4 hover:bg-white/50 rounded-l-xl transition-colors">
                    <div class="w-12 h-12 rounded-full bg-[#1e3c28]/10 flex items-center justify-center text-[#1e3c28]">
                        <i class="fa-regular fa-calendar text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-1">Tanggal Menginap</p>
                        <p class="text-sm font-bold text-gray-900">
                            {{ $checkin ? \Carbon\Carbon::parse($checkin)->format('d M') : '-' }} &mdash; {{ $checkout ? \Carbon\Carbon::parse($checkout)->format('d M Y') : '-' }}
                        </p>
                    </div>
                </div>
                
                <div class="flex-1 px-6 py-4 flex items-center gap-4 hover:bg-white/50 transition-colors">
                    <div class="w-12 h-12 rounded-full bg-[#1e3c28]/10 flex items-center justify-center text-[#1e3c28]">
                        <i class="fa-solid fa-user-group text-lg"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-1">Jumlah Tamu</p>
                        <p class="text-sm font-bold text-gray-900">{{ $guests ?? 2 }} Orang</p>
                    </div>
                </div>
            </div>
            
            <div class="px-4 w-full md:w-auto pb-4 md:pb-0">
                <a href="/home?checkin={{ $checkin }}&checkout={{ $checkout }}&guests={{ $guests }}"
                   class="block w-full md:w-auto px-8 py-3.5 bg-white text-[#1e3c28] border border-[#1e3c28] hover:bg-[#1e3c28] hover:text-white font-bold text-xs uppercase tracking-widest rounded-xl transition-all text-center">
                    Ubah Pencarian
                </a>
            </div>
        </div>
    </div>

    <!-- Room List -->
    <main class="max-w-7xl mx-auto px-6 py-16">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
            <div>
                <h2 class="font-display text-3xl font-bold text-gray-900">Rekomendasi Kamar</h2>
                <p class="text-gray-500 mt-2">Disesuaikan dengan pencarian Anda</p>
            </div>
            <div class="text-sm text-gray-500 font-medium bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                Menampilkan <span class="font-bold text-gray-900">{{ count($kamars) }}</span> tipe kamar
            </div>
        </div>

        <div class="space-y-10">
            @foreach($kamars as $index => $kamar)
            <div class="bg-white rounded-[2rem] overflow-hidden card-hover border border-gray-100/80 flex flex-col lg:flex-row shadow-sm">
                
                <!-- Image Section -->
                <div class="w-full lg:w-[45%] h-[320px] lg:h-auto img-zoom-container relative">
                    <img src="{{ $kamar->gambar }}" class="w-full h-full object-cover img-zoom" alt="{{ $kamar->nama_tipe }}">
                    
                    <!-- Badges overlaid on image -->
                    <div class="absolute top-5 left-5 flex flex-col gap-2.5">
                        @if($kamar->available > 0)
                            <span class="bg-white/95 backdrop-blur text-[#1e3c28] px-3.5 py-1.5 rounded-lg text-xs font-bold shadow-md inline-flex items-center gap-2 w-fit">
                                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                {{ $kamar->available }} Tersedia
                            </span>
                        @else
                            <span class="bg-red-500/95 backdrop-blur text-white px-3.5 py-1.5 rounded-lg text-xs font-bold shadow-md inline-flex items-center gap-2 w-fit">
                                <i class="fa-solid fa-circle-xmark"></i> Penuh
                            </span>
                        @endif
                        
                        @if($kamar->rating >= 4.5)
                        <span class="bg-[#d4af37]/95 backdrop-blur text-white px-3.5 py-1.5 rounded-lg text-xs font-bold shadow-md inline-flex items-center gap-2 w-fit">
                            <i class="fa-solid fa-star text-[10px]"></i> {{ $kamar->rating }} Sangat Bagus
                        </span>
                        @elseif($kamar->rating > 0)
                        <span class="bg-gray-900/90 backdrop-blur text-white px-3.5 py-1.5 rounded-lg text-xs font-bold shadow-md inline-flex items-center gap-2 w-fit">
                            <i class="fa-solid fa-star text-[10px] text-yellow-400"></i> {{ $kamar->rating }} Ulasan
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Content Section -->
                <div class="w-full lg:w-[55%] flex flex-col sm:flex-row">
                    
                    <!-- Details -->
                    <div class="flex-1 p-8 lg:p-10 flex flex-col justify-center">
                        <div class="flex items-center gap-4 mb-4 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <span class="flex items-center gap-1.5 bg-gray-50 px-3 py-1 rounded-full text-[#b8860b]">
                                <i class="fa-solid fa-users"></i> Maks {{ $kamar->jumlah_tamu }} Orang
                            </span>
                        </div>
                        
                        <h3 class="font-display text-3xl font-bold text-gray-900 mb-4">{{ $kamar->nama_tipe }}</h3>
                        
                        <p class="text-gray-500 text-sm leading-relaxed mb-8 line-clamp-3">
                            {{ $kamar->fasilitas }}
                        </p>
                        
                        <!-- Mini amenities -->
                        <div class="flex flex-wrap gap-x-6 gap-y-4 mt-auto pt-5 border-t border-gray-100">
                            <div class="flex items-center gap-2.5 text-sm text-gray-600 font-medium">
                                <div class="w-8 h-8 rounded-full bg-[#1e3c28]/5 flex items-center justify-center text-[#1e3c28]"><i class="fa-solid fa-wifi text-[12px]"></i></div>
                                WiFi
                            </div>
                            <div class="flex items-center gap-2.5 text-sm text-gray-600 font-medium">
                                <div class="w-8 h-8 rounded-full bg-[#1e3c28]/5 flex items-center justify-center text-[#1e3c28]"><i class="fa-solid fa-tv text-[12px]"></i></div>
                                Television
                            </div>
                            <div class="flex items-center gap-2.5 text-sm text-gray-600 font-medium">
                                <div class="w-8 h-8 rounded-full bg-[#1e3c28]/5 flex items-center justify-center text-[#1e3c28]"><i class="fa-solid fa-wind text-[12px]"></i></div>
                                AC
                            </div>
                        </div>
                    </div>

                    <!-- Price & Action -->
                    <div class="w-full sm:w-[260px] lg:w-[300px] bg-[#fafafa] p-8 flex flex-col justify-center items-center border-t sm:border-t-0 sm:border-l border-gray-100 shrink-0">
                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1.5">Mulai Dari</span>
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-sm font-bold text-gray-900">Rp</span>
                            <span class="text-3xl font-black text-[#1e3c28] tracking-tighter">{{ number_format($kamar->harga, 0, ',', '.') }}</span>
                        </div>
                        <span class="text-xs text-gray-500 font-medium mt-1.5 mb-8 text-center">/ Malam <br><span class="text-[10px]">(Termasuk Pajak)</span></span>
                        
                        @if($kamar->available > 0)
                            <a href="{{ route('kamar.show', array_merge(['id' => $kamar->id_tipe_kamar], request()->query())) }}"
                               class="btn-primary w-full text-white py-4 px-6 rounded-xl font-bold uppercase tracking-widest text-xs text-center block">
                               Pesan Sekarang
                            </a>
                        @else
                            <button type="button" disabled
                               class="w-full bg-gray-200 text-gray-400 py-4 px-6 rounded-xl font-bold uppercase tracking-widest text-xs text-center block cursor-not-allowed">
                               Kamar Penuh
                            </button>
                        @endif
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </main>

    @include('components.footer')

</body>
</html>
