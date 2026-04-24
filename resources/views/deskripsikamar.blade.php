<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $kamar->nama_tipe }} - StayEase</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
</head>
<body class="bg-gray-200 text-[#1e293b] font-sans">

    @include('components.navbar')

    <main class="max-w-8xl mx-auto px-6 py-10">
        
        <!-- <div class="flex overflow-x-auto gap-4 no-scrollbar snap-x snap-mandatory pb-4 mb-10">
            <div class="min-w-[85%] md:min-w-[32%] snap-start">
                <img src="{{ $kamar->gambar }}" class="w-full h-64 object-cover rounded-2xl shadow-sm border border-gray-100" alt="Foto 1">
            </div>
            <div class="min-w-[85%] md:min-w-[32%] snap-start">
                <img src="{{ $kamar->gambar }}" class="w-full h-64 object-cover rounded-2xl shadow-sm border border-gray-100" alt="Foto 2">
            </div>
            <div class="min-w-[85%] md:min-w-[32%] snap-start">
                <img src="{{ $kamar->gambar }}" class="w-full h-64 object-cover rounded-2xl shadow-sm border border-gray-100" alt="Foto 3">
            </div>
            <div class="min-w-[85%] md:min-w-[32%] snap-start">
                <img src="{{ $kamar->gambar }}" class="w-full h-64 object-cover rounded-2xl shadow-sm border border-gray-100" alt="Foto 4">
            </div>
        </div> -->

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
            <div class="h-64 overflow-hidden rounded-2xl shadow-sm border border-gray-100">
                <img src="{{ $kamar->gambar }}" class="w-full h-full object-cover transition-transform duration-500" alt="Foto Kamar 1">
            </div>
            <div class="h-64 overflow-hidden rounded-2xl shadow-sm border border-gray-100">
                <img src="{{ $kamar->gambar }}" class="w-full h-full object-cover transition-transform duration-500" alt="Foto Kamar 2">
            </div>
            <div class="h-64 overflow-hidden rounded-2xl shadow-sm border border-gray-100">
                <img src="{{ $kamar->gambar }}" class="w-full h-full object-cover transition-transform duration-500" alt="Foto Kamar 3">
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            
            <div class="col-span-10 lg:col-span-3 space-y-4 p-1 ml-2">
                <div class="flex flex-wrap gap-2">
                    <span class="bg-blue-50 text-[#1E40AF] border border-blue-100 px-6 py-2 rounded text-[10px] font-black uppercase">
                        {{ $kamar->available }} Kamar Tersedia
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
                <a href="{{ route('booking.biodata', request()->route('id')) }}" class="w-full bg-[#8C6A1A] text-white mt-6 py-4 rounded-xl font-bold uppercase tracking-widest text-sm text-center block cursor-pointer transition-all shadow-md hover:shadow-[#8C6A1A]">
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
</body>
</html>