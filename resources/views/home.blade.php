<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    
    <style>
        /* Tetap Menggunakan Font DM Sans dan Playfair */
        body { font-family: 'DM Sans', sans-serif; }
        h1, .logo-text, h4, .card-title { font-family: 'Playfair Display', serif; }
    </style>
</head>

<body>
    @include('components.navbar')

    <section class="flex flex-col md:flex-row min-h-screen">
        
        <div class="w-full md:w-1/2 bg-gradient-to-r from-[#172554] to-[#1E40AF] to-[#1E40AF] flex flex-col justify-center px-20 py-16 relative">
            <div class="inline-flex items-center gap-2 bg-black/10 border border-black/20 px-4 py-2 rounded-full text-xs font-bold text-white uppercase tracking-widest mb-8 w-fit">
                Sistem Reservasi Hotel Terpercaya
            </div>

            <h1 class="text-7xl font-black text-white leading-[1.1] mb-8">
                Temukan<br>
                <span class="text-white">Kenyamanan</span><br>
                <span class="italic font-normal">yang Sempurna</span>
            </h1>

            <p class="text-white text-lg max-w-md mb-12 opacity-90 leading-relaxed">
                Nikmati kemudahan pemesanan kamar hotel dengan sistem manajemen reservasi modern. Cari, bandingkan, dan booking kamar impian Anda dalam hitungan menit.
            </p>

            <div class="flex gap-12 border-t border-black/10 pt-10">
                <div class="stat-item">
                    <div class="text-4xl font-bold text-white">200<span class="text-white">+</span></div>
                    <div class="text-xs font-bold text-white uppercase tracking-widest mt-1">Tipe Kamar</div>
                </div>
                <div class="w-px bg-black/10"></div>
                <div class="stat-item">
                    <div class="text-4xl font-bold text-white">50<span class="text-white">K+</span></div>
                    <div class="text-xs font-bold text-white uppercase tracking-widest mt-1">Tamu Puas</div>
                </div>
                <div class="w-px bg-black/10"></div>
                <div class="stat-item">
                    <div class="text-4xl font-bold text-white">4.9<span class="text-white">★</span></div>
                    <div class="text-xs font-bold text-white uppercase tracking-widest mt-1">Rating</div>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 bg-gray-200 flex items-center justify-center p-20">
            <div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-[0_30px_70px_rgba(0,0,0,0.1)] border border-gray-100">
                <div class="mb-10">
                    <h2 class="card-title text-3xl font-bold text-gray-900 mb-2">Cari Kamar Hotel</h2>
                    <p class="text-gray-500 text-sm">Cek ketersediaan & pesan sekarang</p>
                </div>

                <div class="space-y-6">
                    <div class="form-group">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-3 ml-1 tracking-wider">Tanggal Check-in</label>
                        <input type="date" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none transition-all">
                    </div>

                    <div class="form-group">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-3 ml-1 tracking-wider">Tanggal Check-out</label>
                        <input type="date" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none transition-all">
                    </div>

                    <div class="form-group">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-3 ml-1 tracking-wider">Jumlah Tamu</label>
                        <select class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none transition-all appearance-none cursor-pointer">
                            <option value="">Pilih jumlah tamu</option>
                            <option value="1">1 Tamu</option>
                            <option value="2">2 Tamu</option>
                            <option value="3">3 Tamu</option>
                            <option value="4">4+ Tamu</option>
                        </select>
                    </div>

                    <button class="w-full py-5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-xl shadow-blue-200 transition-all active:scale-[0.98] mt-6 flex justify-center items-center gap-2">
                        Cari Kamar Tersedia
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="bg-[#0f172a] py-12 px-12 flex flex-col md:flex-row justify-center items-center">
        <div class="grid grid-cols-1 md:grid-cols-4 w-full max-w-7xl md:divide-x divide-slate-800">
            <div class="flex items-center gap-5 px-10 py-4 md:py-0">
                <span class="text-3xl">⚡</span>
                <div class="feature-text">
                    <div class="text-white font-bold text-sm">Booking Instan</div>
                    <div class="text-slate-500 text-xs mt-1">Konfirmasi real-time</div>
                </div>
            </div>
            <div class="flex items-center gap-5 px-10 py-4 md:py-0">
                <span class="text-3xl">🔒</span>
                <div class="feature-text">
                    <div class="text-white font-bold text-sm">Pembayaran Aman</div>
                    <div class="text-slate-500 text-xs mt-1">Transaksi terenkripsi</div>
                </div>
            </div>
            <div class="flex items-center gap-5 px-10 py-4 md:py-0">
                <span class="text-3xl">🎯</span>
                <div class="feature-text">
                    <div class="text-white font-bold text-sm">Best Price Guarantee</div>
                    <div class="text-slate-500 text-xs mt-1">Harga terbaik dijamin</div>
                </div>
            </div>
            <div class="flex items-center gap-5 px-10 py-4 md:py-0">
                <span class="text-3xl">🛎️</span>
                <div class="feature-text">
                    <div class="text-white font-bold text-sm">Layanan 24/7</div>
                    <div class="text-slate-500 text-xs mt-1">Siap membantu kapan saja</div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white px-12 pt-24 pb-12 border-t border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-16 mb-20">
            <div class="md:col-span-5">
                <a href="#" class="flex items-center gap-2 no-underline mb-8">
                    <div class="w-10 h-10 bg-blue-900 rounded-lg flex items-center justify-center text-sm">🏨</div>
                    <span class="logo-text text-2xl font-bold text-blue-900">StayEase</span>
                </a>
                <p class="text-gray-500 text-sm leading-relaxed max-w-sm mb-8">
                    Platform manajemen booking dan reservasi hotel terpercaya. Memberikan pengalaman menginap terbaik sejak 2024.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition">f</a>
                    <a href="#" class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition">in</a>
                    <a href="#" class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition">tw</a>
                </div>
            </div>
            <div class="md:col-span-2 md:col-start-7">
                <h4 class="font-bold text-gray-900 mb-8 uppercase text-xs tracking-widest">Layanan</h4>
                <ul class="space-y-4 text-sm text-gray-500 list-none p-0">
                    <li><a href="#" class="hover:text-blue-600 transition">Reservasi Kamar</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Paket Liburan</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Meeting Room</a></li>
                </ul>
            </div>
            <div class="md:col-span-2">
                <h4 class="font-bold text-gray-900 mb-8 uppercase text-xs tracking-widest">Akun</h4>
                <ul class="space-y-4 text-sm text-gray-500 list-none p-0">
                    <li><a href="/login" class="hover:text-blue-600 transition">Login</a></li>
                    <li><a href="/register" class="hover:text-blue-600 transition">Daftar</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Profil Saya</a></li>
                </ul>
            </div>
            <div class="md:col-span-2">
                <h4 class="font-bold text-gray-900 mb-8 uppercase text-xs tracking-widest">Bantuan</h4>
                <ul class="space-y-4 text-sm text-gray-500 list-none p-0">
                    <li><a href="#" class="hover:text-blue-600 transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Kontak Kami</a></li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-100 pt-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-xs text-gray-400">
                © 2025 <span class="text-blue-600 font-bold">LuxeStay</span>. Hak cipta dilindungi.
            </p>
            <div class="px-5 py-2.5 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-full uppercase tracking-[0.2em] border border-blue-100">
                Sistem Booking Hotel
            </div>
        </div>
    </footer>

</body>
</html>