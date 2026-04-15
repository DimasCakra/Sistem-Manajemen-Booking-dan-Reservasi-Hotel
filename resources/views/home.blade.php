<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500&display=swap" 
          rel="stylesheet">
    
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        h1, .logo-text, h4, .card-title { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body>

    @include('components.navbar')

    <section class = "flex flex-col md:flex-row min-h-screen">
        
        <div class = "w-full md:w-1/2 bg-[#254117] px-20 py-16 relative
                      flex flex-col justify-center">

            <div class = "inline-flex items-center gap-2 px-4 py-2 mb-8 w-fit
                          bg-black/10 border border-black/20 rounded-full 
                          text-xs font-bold text-white uppercase tracking-widest">
                          Sistem Reservasi Hotel
            </div>

            <h1 class = "text-7xl font-black text-white leading-[1.1] mb-8">
                Temukan<br>
                <span class = "text-white">Kenyamanan</span><br>
                <span class = "italic font-normal">yang Sempurna</span>
            </h1>

            <p class = "text-white text-lg max-w-md mb-12 opacity-90 leading-relaxed">
                Nikmati kemudahan pemesanan kamar hotel dengan sistem manajemen 
                reservasi modern. Cari, bandingkan, dan booking kamar impian 
                Anda dalam hitungan menit.
            </p>

            <div class = "flex gap-12 pt-10">
                <div class = "stat-item">
                    <div class = "text-4xl font-bold text-white">0+</div>
                    <div class = "text-xs font-bold text-white uppercase 
                                  tracking-widest mt-1">Tipe Kamar</div>
                </div>
                
                <div class = "w-px bg-black/10"></div>
                
                <div class = "stat-item">
                    <div class = "text-4xl font-bold text-white">0K+</div>
                    <div class = "text-xs font-bold text-white uppercase 
                                  tracking-widest mt-1">Tamu Puas</div>
                </div>
                
                <div class = "w-px bg-black/10"></div>
                
                <div class = "stat-item">
                    <div class = "text-4xl font-bold text-white">0.0★</div>
                    <div class = "text-xs font-bold text-white uppercase 
                                  tracking-widest mt-1">Rating</div>
                </div> 

            </div>
        </div>

        <div class = "w-full md:w-1/2 bg-gray-200 flex items-center justify-center p-20">
            <div class = "w-full max-w-md bg-white p-10 rounded-3xl border border-gray-100
                          shadow-[0_30px_70px_rgba(0,0,0,0.1)]">
                
                <div class = "mb-10">
                    <h2 class = "card-title text-3xl font-bold text-gray-900 mb-2">
                        Cari Kamar Hotel
                    </h2>
                    <p class = "text-gray-500 text-sm">Cek ketersediaan & pesan sekarang</p>
                </div>

                <div class = "space-y-6">
                    <div class = "form-group">
                        <label class = "block text-xs font-bold text-gray-400 
                                        uppercase mb-3 ml-1 tracking-wider">
                              Tanggal Check-in
                        </label>
                        <input type = "date" 
                               class = "w-full p-4 bg-gray-50 border border-gray-200 
                                        rounded-xl focus:ring-2 focus:ring-blue-600 
                                        outline-none transition-all">
                    </div>

                    <div class = "form-group">
                        <label class = "block text-xs font-bold text-gray-400 
                                        uppercase mb-3 ml-1 tracking-wider">
                            Tanggal Check-out
                        </label>
                        <input type = "date" 
                               class = "w-full p-4 bg-gray-50 border border-gray-200 
                                        rounded-xl focus:ring-2 focus:ring-blue-600 
                                        outline-none transition-all">
                    </div>

                    <div class = "form-group">
                        <label class = "block text-xs font-bold text-gray-400 
                                        uppercase mb-3 ml-1 tracking-wider">
                            Jumlah Tamu
                        </label>
                        <select class = "w-full p-4 bg-gray-50 border border-gray-200 
                                         rounded-xl focus:ring-2 focus:ring-blue-600 
                                         outline-none transition-all appearance-none cursor-pointer">
                            <option value = "">Pilih jumlah tamu</option>
                            <option value = "1">1 Tamu</option>
                            <option value = "2">2 Tamu</option>
                            <option value = "3">3 Tamu</option>
                            <option value = "4">4+ Tamu</option>
                        </select>
                    </div>

                    <button class = "w-full py-5 bg-[#254117] hover:bg-[#1a2f0f] 
                                     text-white font-bold rounded-2xl shadow-xl 
                                     transition-all active:scale-[0.98] mt-6 
                                     flex justify-center items-center gap-2">
                          Cari Kamar Tersedia
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class = "bg-[#173014] py-12 px-12 flex justify-center items-center">
        <div class = "grid grid-cols-1 md:grid-cols-4 w-full max-w-7xl 
                      md:divide-x divide-slate-800">
            
            <div class = "flex items-center gap-5 px-10 py-4 md:py-0">
                <span class = "text-3xl">⚡</span>
                <div>
                    <div class = "text-white font-bold text-sm">Booking Instan</div>
                    <div class = "text-gray-400 text-xs mt-1">Konfirmasi real-time</div>
                </div>
            </div>

            <div class = "flex items-center gap-5 px-10 py-4 md:py-0">
                <span class = "text-3xl">🔒</span>
                <div>
                    <div class = "text-white font-bold text-sm">Pembayaran Aman</div>
                    <div class = "text-gray-400 text-xs mt-1">Transaksi terenkripsi</div>
                </div>
            </div>

            <div class = "flex items-center gap-5 px-10 py-4 md:py-0">
                <span class = "text-3xl">🎯</span>
                <div>
                    <div class = "text-white font-bold text-sm">Best Price Guarantee</div>
                    <div class = "text-gray-400 text-xs mt-1">Harga terbaik dijamin</div>
                </div>
            </div>

            <div class = "flex items-center gap-5 px-10 py-4 md:py-0">
                <span class = "text-3xl">🛎️</span>
                <div>
                    <div class = "text-white font-bold text-sm">Layanan 24/7</div>
                    <div class = "text-gray-400 text-xs mt-1">Siap membantu kapan saja</div>
                </div>
            </div>
        </div>
    </div>

    <footer class = "bg-gray-200 px-12 pt-24 pb-12 border-t border-gray-100">
        <div class = "grid grid-cols-1 md:grid-cols-12 gap-16 mb-20">
            
            <div class = "md:col-span-5">
                <a href = "/home" class = "flex items-center gap-2 no-underline mb-8">
                    <img src = "{{ asset('gambar/logo_stayease.png') }}" 
                         alt = "Logo" class = "h-12 w-auto object-contain">
                </a>
                <p class = "text-gray-500 text-sm leading-relaxed max-w-sm mb-8">
                    Platform manajemen booking dan reservasi hotel terpercaya. 
                    Memberikan pengalaman menginap terbaik sejak 2024.
                </p>
                <div class = "flex gap-4">
                    <a href="#" class = "w-10 h-10 bg-gray-50 rounded-lg flex items-center 
                                      justify-center text-[#173014] transition 
                                      hover:bg-[#173014] hover:text-white">f</a>
                    <a href="#" class = "w-10 h-10 bg-gray-50 rounded-lg flex items-center 
                                      justify-center text-[#173014] transition 
                                      hover:bg-[#173014] hover:text-white">in</a>
                </div>
            </div>

            <div class = "md:col-span-2 md:col-start-7">
                <h4 class = "font-bold text-gray-900 mb-8 uppercase text-xs tracking-widest">
                    Layanan
                </h4>
                <ul class = "space-y-4 text-sm text-gray-500 list-none p-0">
                    <li><a href = "#" class = "hover:text-[#173014] transition">Reservasi Kamar</a></li>
                    <li><a href = "#" class = "hover:text-[#173014] transition">Paket Liburan</a></li>
                    <li><a href = "#" class = "hover:text-[#173014] transition">Meeting Room</a></li>
                </ul>
            </div>

            <div class = "md:col-span-2">
                <h4 class = "font-bold text-[#254117] mb-8 uppercase text-xs tracking-widest">
                    Akun
                </h4>
                <ul class = "space-y-4 text-sm text-gray-500 list-none p-0">
                    <li><a href = "/login" class = "hover:text-[#173014] transition">Login</a></li>
                    <li><a href = "/register" class = "hover:text-[#173014] transition">Daftar</a></li>
                </ul>
            </div>

        </div>
        
        <div class = "border-t border-gray-100 pt-10 flex flex-col md:flex-row 
                    justify-between items-center gap-6">
            <p class = "text-xs text-gray-400">
                © 2025 <span class = "text-[#254117] font-bold">StayEase</span>. 
                Hak cipta dilindungi.
            </p>
            <div class = "px-5 py-2.5 bg-blue-50 text-[#254117] text-[10px] font-bold 
                        rounded-full uppercase tracking-[0.2em] border border-blue-100">
                Sistem Booking Hotel
            </div>
        </div>
    </footer>

</body>
</html>