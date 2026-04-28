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

        <div class = "w-full md:w-1/2 bg-[#FFF4DE] flex items-center justify-center p-20">
            <div class = "w-full max-w-md bg-white p-10 rounded-3xl border border-gray-100
                          shadow-[0_30px_70px_rgba(0,0,0,0.1)]">
                
                <div class = "mb-10">
                    <h2 class = "card-title text-3xl font-bold text-gray-900 mb-2">
                        Cari Kamar Hotel
                    </h2>
                    <p class = "text-gray-500 text-sm">Cek ketersediaan & pesan sekarang</p>
                </div>

                <form action="{{ url('/katalog') }}" method="GET" class="space-y-6">
                    <div class="form-group">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-3 ml-1 tracking-wider">Tanggal Check-in</label>
                        <input type="date" id="checkin" name="checkin" required class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#254117]">
                    </div>

                    <div class="form-group">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-3 ml-1 tracking-wider">Tanggal Check-out</label>
                        <input type="date" id="checkout" name="checkout" required class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#254117]">
                    </div>

                    <div class="form-group">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-3 ml-1 tracking-wider">Jumlah Tamu</label>
                        <select name="guests" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#254117] appearance-none cursor-pointer">
                            <option value="1">1 Tamu</option>
                            <option value="2" selected>2 Tamu</option>
                            <option value="3">3 Tamu</option>
                            <option value="4">4+ Tamu</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-5 bg-[#254117] hover:bg-[#1a2f0f] text-white font-bold rounded-2xl shadow-xl transition-all active:scale-[0.98] mt-6 flex justify-center items-center gap-2">
                        Cari Kamar Tersedia
                    </button>
                </form>
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

    @include('components.footer')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkinInput = document.getElementById('checkin');
            const checkoutInput = document.getElementById('checkout');

            // Set minimum checkin date to hari ini (today)
            const today = new Date().toISOString().split('T')[0];
            checkinInput.min = today;

            checkinInput.addEventListener('change', function() {
                if (this.value) {
                    // Set minimum checkout date to 1 hari setelah checkin
                    const checkinDate = new Date(this.value);
                    checkinDate.setDate(checkinDate.getDate() + 1);
                    const minCheckoutDate = checkinDate.toISOString().split('T')[0];
                    
                    checkoutInput.min = minCheckoutDate;
                    
                    // Jika checkout yang sudah dipilih lebih kecil dari minimum yang baru, reset atau atur ke minimum
                    if (checkoutInput.value && checkoutInput.value < minCheckoutDate) {
                        checkoutInput.value = minCheckoutDate;
                    }
                } else {
                    checkoutInput.min = '';
                }
            });
        });
    </script>
</body>
</html>