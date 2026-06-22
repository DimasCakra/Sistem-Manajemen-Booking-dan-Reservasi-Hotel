<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - StayEase</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.7s ease forwards; }
        .fade-up-delay-1 { animation: fadeUp 0.7s ease 0.15s forwards; opacity: 0; }
        .fade-up-delay-2 { animation: fadeUp 0.7s ease 0.3s forwards; opacity: 0; }
        .fade-up-delay-3 { animation: fadeUp 0.7s ease 0.45s forwards; opacity: 0; }
        .stat-card:hover { transform: translateY(-6px); }
    </style>
</head>
<body class="bg-[#FFF4DE] text-[#1e293b]">

    @include('components.navbar')

    {{-- HERO SECTION --}}
    <section class="bg-[#173014] relative overflow-hidden pt-36 pb-28">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-10 left-10 w-64 h-64 rounded-full bg-[#8C6A1A] blur-3xl"></div>
            <div class="absolute bottom-10 right-20 w-96 h-96 rounded-full bg-[#254117] blur-3xl"></div>
        </div>
        <div class="max-w-5xl mx-auto px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-5 py-2 mb-8 bg-[#8C6A1A]/20 border border-[#8C6A1A]/40 rounded-full text-[#C4922A] text-xs font-bold uppercase tracking-widest fade-up">
                Tentang Kami
            </div>
            <h1 class="font-display text-6xl md:text-7xl font-black text-white leading-tight mb-6 fade-up-delay-1">
                Kami Ada untuk<br><span class="italic font-normal text-[#C4922A]">Kenyamanan Anda</span>
            </h1>
            <p class="text-white/70 text-lg max-w-2xl mx-auto leading-relaxed fade-up-delay-2">
                StayEase lahir dari keyakinan sederhana: setiap tamu berhak mendapatkan pengalaman menginap yang tidak hanya nyaman, tetapi juga berkesan dan tak terlupakan.
            </p>
        </div>
    </section>

    {{-- STORY SECTION --}}
    <section class="max-w-6xl mx-auto px-8 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div>
                <p class="text-[#8C6A1A] text-xs font-bold uppercase tracking-widest mb-4">Kisah Kami</p>
                <h2 class="font-display text-4xl font-bold text-[#173014] mb-6 leading-tight">Dimulai dari Sebuah<br>Visi yang Sederhana</h2>
                <p class="text-gray-600 leading-relaxed mb-5">
                    Didirikan pada tahun 2026, StayEase hadir sebagai solusi digital terdepan untuk sistem manajemen booking dan reservasi hotel. Kami percaya bahwa teknologi seharusnya mempermudah, bukan mempersulit — baik bagi tamu maupun pengelola hotel.
                </p>
                <p class="text-gray-600 leading-relaxed mb-5">
                    Dengan antarmuka yang intuitif dan sistem yang andal, kami menghubungkan ribuan tamu dengan kamar impian mereka setiap harinya. Setiap fitur yang kami rancang selalu berpusat pada satu hal: <span class="font-semibold text-[#173014]">kepuasan Anda</span>.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Dari proses pencarian kamar yang cepat, pembayaran yang aman, hingga konfirmasi reservasi yang transparan — semuanya kami kelola dengan standar layanan tertinggi.
                </p>
            </div>
            <div class="space-y-5">
                <div class="bg-white rounded-2xl p-8 border border-[#254117]/10 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-[#173014] flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-[#173014] text-lg mb-2">Keandalan Sistem</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Infrastruktur kami dirancang untuk beroperasi 24/7 tanpa gangguan, memastikan setiap transaksi reservasi berjalan lancar kapan saja.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-[#254117]/10 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-[#8C6A1A] flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="font-bold text-[#173014] text-lg mb-2">Keamanan Data</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Data pribadi dan transaksi keuangan Anda dilindungi dengan enkripsi tingkat tinggi. Privasi Anda adalah prioritas utama kami.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-[#254117]/10 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-[#254117] flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-[#173014] text-lg mb-2">Pelayanan Pelanggan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Tim kami selalu siap membantu Anda. Kepuasan tamu bukan sekadar slogan, melainkan komitmen nyata yang kami pegang teguh.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS SECTION --}}
    <section class="bg-[#173014] py-20">
        <div class="max-w-5xl mx-auto px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="stat-card transition-all duration-300">
                    <div class="font-display text-5xl font-black text-white mb-2">{{ \App\Models\TipeKamar::count() }}</div>
                    <div class="text-[#8C6A1A] text-xs font-bold uppercase tracking-widest">Tipe Kamar</div>
                </div>
                <div class="stat-card transition-all duration-300">
                    <div class="font-display text-5xl font-black text-white mb-2">2K+</div>
                    <div class="text-[#8C6A1A] text-xs font-bold uppercase tracking-widest">Tamu Puas</div>
                </div>
                <div class="stat-card transition-all duration-300">
                    <div class="font-display text-5xl font-black text-white mb-2">{{ number_format(\App\Models\Review::avg('rating') ?? 0, 1) }}★</div>
                    <div class="text-[#8C6A1A] text-xs font-bold uppercase tracking-widest">Rating</div>
                </div>
                <div class="stat-card transition-all duration-300">
                    <div class="font-display text-5xl font-black text-white mb-2">24/7</div>
                    <div class="text-[#8C6A1A] text-xs font-bold uppercase tracking-widest">Layanan</div>
                </div>
            </div>
        </div>
    </section>

    {{-- VALUES SECTION --}}
    <section class="max-w-6xl mx-auto px-8 py-24">
        <div class="text-center mb-16">
            <p class="text-[#8C6A1A] text-xs font-bold uppercase tracking-widest mb-3">Nilai-Nilai Kami</p>
            <h2 class="font-display text-4xl font-bold text-[#173014]">Prinsip yang Kami Pegang</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-10 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
                <div class="w-20 h-20 rounded-full bg-[#FFF4DE] flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-[#173014]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="font-display text-xl font-bold text-[#173014] mb-3">Inovasi</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Kami terus berinovasi menghadirkan fitur-fitur terkini yang mempermudah proses reservasi bagi semua pihak.</p>
            </div>
            <div class="text-center p-10 bg-[#173014] rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                <div class="w-20 h-20 rounded-full bg-white/10 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="font-display text-xl font-bold text-white mb-3">Kepercayaan</h3>
                <p class="text-white/70 text-sm leading-relaxed">Kepercayaan tamu dan mitra hotel adalah fondasi bisnis kami. Setiap keputusan kami selalu berangkat dari nilai kejujuran.</p>
            </div>
            <div class="text-center p-10 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-2">
                <div class="w-20 h-20 rounded-full bg-[#FFF4DE] flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-[#173014]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                </div>
                <h3 class="font-display text-xl font-bold text-[#173014] mb-3">Kualitas</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Standar kualitas layanan kami tidak pernah berkompromi. Kami selalu memastikan setiap detail berjalan sempurna.</p>
            </div>
        </div>
    </section>

    @include('components.footer')
</body>
</html>
