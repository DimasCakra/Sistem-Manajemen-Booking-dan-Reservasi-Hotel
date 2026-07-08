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

    <section class="flex flex-col md:flex-row min-h-screen">

        <div class="w-full md:w-1/2 bg-[#254117] px-8 md:px-20 py-12 md:py-16 relative
                      flex flex-col justify-center">

            <div class = "inline-flex items-center gap-2 px-4 py-2 mb-8 w-fit
                          bg-black/10 border border-black/20 rounded-full
                          text-xs font-bold text-white uppercase tracking-widest">
                          Sistem Manajemen Booking dan Reservasi Hotel
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-white leading-[1.1] mb-8">
                Temukan<br>
                <span class="text-white">Kenyamanan</span><br>
                <span class="italic font-normal">yang Sempurna</span>
            </h1>

            <p class = "text-white text-lg max-w-md mb-12 opacity-90 leading-relaxed">
                Nikmati kemudahan pemesanan kamar hotel dengan sistem manajemen
                reservasi modern. Cari, bandingkan, dan booking kamar impian
                Anda dalam hitungan menit.
            </p>

            <div class="flex flex-wrap gap-8 md:gap-12 pt-10">
                <div class = "stat-item">
                    <div class = "text-4xl font-bold text-white">{{ \App\Models\TipeKamar::count() }}</div>
                    <div class = "text-xs font-bold text-white uppercase
                                  tracking-widest mt-1">Tipe Kamar</div>
                </div>

                <div class = "w-px bg-black/10"></div>

                <div class = "stat-item">
                    <div class = "text-4xl font-bold text-white">2K+</div>
                    <div class = "text-xs font-bold text-white uppercase
                                  tracking-widest mt-1">Tamu Puas</div>
                </div>

                <div class = "w-px bg-black/10"></div>

                <div class = "stat-item">
                    <div class = "text-4xl font-bold text-white">{{ number_format(\App\Models\Review::avg('rating') ?? 0, 1) }}★</div>
                    <div class = "text-xs font-bold text-white uppercase
                                  tracking-widest mt-1">Rating</div>
                </div>

            </div>
        </div>

        <div class="w-full md:w-1/2 bg-[#FFF4DE] flex items-center justify-center p-8 md:p-20">
            <div class="w-full max-w-md bg-white p-8 md:p-10 rounded-3xl border border-gray-100
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
                        <input type="date" id="checkin" name="checkin" value="{{ request('checkin', now()->toDateString()) }}" min="{{ now()->toDateString() }}" max="{{ now()->addYear()->toDateString() }}" class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#254117]">
                    </div>

                    <div class="form-group">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-3 ml-1 tracking-wider">Tanggal Check-out</label>
                        <input type="date" id="checkout" name="checkout" value="{{ request('checkout', now()->addDay()->toDateString()) }}" min="{{ now()->addDay()->toDateString() }}" max="{{ now()->addYear()->addDay()->toDateString() }}" required class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#254117]">
                    </div>

                    <div class="form-group">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-3 ml-1 tracking-wider">
                            Jumlah Tamu
                        </label>

                        <select name="guests"
                            class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-[#254117] appearance-none cursor-pointer">
                            <option value="1" {{ ($guests ?? 2) == 1 ? 'selected' : '' }}>1 Tamu</option>
                            <option value="2" {{ ($guests ?? 2) == 2 ? 'selected' : '' }}>2 Tamu</option>
                            <option value="3" {{ ($guests ?? 2) == 3 ? 'selected' : '' }}>3 Tamu</option>
                            <option value="4" {{ ($guests ?? 2) == 4 ? 'selected' : '' }}>4+ Tamu</option   >

                        </select>
                    </div>

                    <button type="submit" class="w-full py-5 bg-[#254117] hover:bg-[#1a2f0f] text-white font-bold rounded-2xl shadow-xl transition-all active:scale-[0.98] mt-6 flex justify-center items-center gap-2">
                        Cari Kamar Tersedia
                    </button>
                </form>
            </div>
        </div>
    </section>

    <div class="bg-[#173014] py-12 px-4 md:px-12 flex justify-center items-center">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-0 w-full max-w-7xl
                      lg:divide-x divide-slate-800">

            <div class = "flex items-center gap-5 px-10 py-4 md:py-0">
                <div class="p-3 rounded-2xl bg-[#C4922A]/10 text-[#C4922A] shrink-0 border border-[#C4922A]/20">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                    </svg>
                </div>
                <div>
                    <div class = "text-white font-bold text-sm">Booking Instan</div>
                    <div class = "text-gray-400 text-xs mt-1">Konfirmasi real-time</div>
                </div>
            </div>

            <div class = "flex items-center gap-5 px-10 py-4 md:py-0">
                <div class="p-3 rounded-2xl bg-[#C4922A]/10 text-[#C4922A] shrink-0 border border-[#C4922A]/20">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <div>
                    <div class = "text-white font-bold text-sm">Pembayaran Aman</div>
                    <div class = "text-gray-400 text-xs mt-1">Transaksi terenkripsi</div>
                </div>
            </div>

            <div class = "flex items-center gap-5 px-10 py-4 md:py-0">
                <div class="p-3 rounded-2xl bg-[#C4922A]/10 text-[#C4922A] shrink-0 border border-[#C4922A]/20">
                    <svg class="w-6 h-6" xmlns="http://wwx  w.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                    </svg>
                </div>
                <div>
                    <div class = "text-white font-bold text-sm">Best Price Guarantee</div>
                    <div class = "text-gray-400 text-xs mt-1">Harga terbaik dijamin</div>
                </div>
            </div>

            <div class = "flex items-center gap-5 px-10 py-4 md:py-0">
                <div class="p-3 rounded-2xl bg-[#C4922A]/10 text-[#C4922A] shrink-0 border border-[#C4922A]/20">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2 18h20M12 4v2M12 6a6 6 0 0 1 6 6v2H6v-2a6 6 0 0 1 6-6Zm-2 8h4" />
                    </svg>
                </div>
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

            // Set minimum checkin date to hari ini (today) and max to 1 year ahead
            const today = new Date();
            const todayStr = today.toISOString().split('T')[0];
            
            const nextYear = new Date(today);
            nextYear.setFullYear(today.getFullYear() + 1);
            const nextYearStr = nextYear.toISOString().split('T')[0];

            checkinInput.min = todayStr;
            checkinInput.max = nextYearStr;
            checkoutInput.max = nextYearStr;

            checkinInput.addEventListener('change', function() {
                if (this.value) {
                    // Set minimum checkout date to 1 hari setelah checkin
                    const checkinDate = new Date(this.value);
                    checkinDate.setDate(checkinDate.getDate() + 1);
                    const minCheckoutDate = checkinDate.toISOString().split('T')[0];

                    checkoutInput.min = minCheckoutDate;
                    
                    // Update max checkout date to 1 year after the selected checkin
                    const maxCheckoutDate = new Date(checkinDate);
                    maxCheckoutDate.setFullYear(maxCheckoutDate.getFullYear() + 1);
                    checkoutInput.max = maxCheckoutDate.toISOString().split('T')[0];

                    // Jika checkout yang sudah dipilih lebih kecil dari minimum yang baru, reset atau atur ke minimum
                    if (checkoutInput.value && checkoutInput.value < minCheckoutDate) {
                        checkoutInput.value = minCheckoutDate;
                    }
                    
                    // Jika checkout yang sudah dipilih lebih besar dari maksimum yang baru, atur ke maksimum
                    if (checkoutInput.value && checkoutInput.value > checkoutInput.max) {
                        checkoutInput.value = checkoutInput.max;
                    }
                } else {
                    checkoutInput.min = '';
                    checkoutInput.max = nextYearStr;
                }
            });
        });
    </script>
</body>
</html>
