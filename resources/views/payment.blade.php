<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - StayEase</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-200 text-[#1e293b] font-sans">
    @include('components.navbar')

    <main class="max-w-8xl mx-auto px-6 py-10" x-data="{ method: 'bca', va: '0031 0586 8669' }">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
            <!-- Left Column -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Payment Deadline -->
                <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-1">Batas Waktu Pembayaran</h2>
                        <p class="text-xl font-black text-[#0f172a]">{{ \Carbon\Carbon::now()->addHours(2)->format('d M Y, H:i') }}</p>
                    </div>
                    <div x-data="{ 
                            timeLeft: 7200, 
                            get formattedTime() { 
                                const h = String(Math.floor(this.timeLeft / 3600)).padStart(2, '0');
                                const m = String(Math.floor((this.timeLeft % 3600) / 60)).padStart(2, '0');
                                const s = String(this.timeLeft % 60).padStart(2, '0');
                                return `${h}:${m}:${s}`;
                            } 
                        }" 
                        x-init="setInterval(() => { if (timeLeft > 0) timeLeft-- }, 1000)"
                        class="bg-red-50 text-red-600 px-6 py-3 rounded-md font-bold text-xl text-center border border-red-100 tabular-nums"
                        x-text="formattedTime">
                        02:00:00
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-black text-[#0f172a] mb-6 border-b pb-4 border-gray-50 uppercase tracking-widest">Metode Pembayaran</h2>
                    
                    <div class="space-y-4">
                        <label class="flex items-center justify-between p-5 border rounded-md cursor-pointer transition-all" :class="method === 'bca' ? 'border-[#8C6A1A] bg-yellow-50/20' : 'border-gray-200 hover:bg-gray-50'">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment_method" value="bca" x-model="method" @change="va = '8800 1234 5678 9012'" class="w-5 h-5 text-[#8C6A1A] focus:ring-[#8C6A1A]">
                                <span class="font-bold text-lg">BCA Virtual Account</span>
                            </div>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA" class="h-6">
                        </label>
                        
                        <label class="flex items-center justify-between p-5 border rounded-md cursor-pointer transition-all" :class="method === 'mandiri' ? 'border-[#8C6A1A] bg-yellow-50/20' : 'border-gray-200 hover:bg-gray-50'">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment_method" value="mandiri" x-model="method" @change="va = '1090 0247 0262 3'" class="w-5 h-5 text-[#8C6A1A] focus:ring-[#8C6A1A]">
                                <span class="font-bold text-lg">Mandiri Virtual Account</span>
                            </div>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" alt="Mandiri" class="h-6">
                        </label>

                        <label class="flex items-center justify-between p-5 border rounded-md cursor-pointer transition-all" :class="method === 'qris' ? 'border-[#8C6A1A] bg-yellow-50/20' : 'border-gray-200 hover:bg-gray-50'">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment_method" value="qris" x-model="method" @change="va = 'Scan QR Code Below'" class="w-5 h-5 text-[#8C6A1A] focus:ring-[#8C6A1A]">
                                <span class="font-bold text-lg">QRIS</span>
                            </div>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" alt="QRIS" class="h-6">
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Summary Card -->
                <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-black text-[#0f172a] mb-6 border-b pb-4 border-gray-50 uppercase tracking-widest">Lihat Pesanan</h2>
                    
                    <div class="mb-6">
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Hotel</p>
                        <h3 class="text-lg font-black text-black">StayEase Luxury Hotel</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $kamar->nama_tipe }} - {{ $durasi }} Night(s)</p>
                    </div>

                    <div class="border-t border-gray-100 pt-4 mt-2">
                        <div class="flex justify-between items-center">
                            <span class="text-base font-black">Total Pembayaran</span>
                            <span class="text-xl font-black text-[#8C6A1A]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('home') }}" class="w-full bg-white border border-gray-300 text-[#0f172a] py-4 rounded-xl font-bold uppercase tracking-widest text-sm text-center block cursor-pointer transition-all shadow-sm hover:bg-gray-50">
                    Saya Sudah Bayar (Refresh)
                </a>
            </div>
        </div>

        <!-- Account Number Bottom Card -->
        <div class="bg-white p-10 rounded-md border border-gray-100 shadow-sm text-center flex flex-col items-center">
            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-2" x-text="method === 'qris' ? 'Scan to Pay' : 'NOMOR REKENING'"></h3>
            
            <div x-show="method !== 'qris'" class="text-4xl font-black text-[#8C6A1A] tracking-widest py-4" x-text="va">
                8800 1234 5678 9012
            </div>
            
            <div x-show="method === 'qris'" class="py-4" style="display: none;">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=StayEasePayment-{{ $id }}-{{ $total }}" alt="QR Code" class="border-4 border-gray-100 rounded-xl shadow-sm">
            </div>

            <p class="text-sm text-gray-500 mt-2">Please pay the exact amount of <span class="font-black text-lg text-[#0f172a] block mt-1">Rp {{ number_format($total, 0, ',', '.') }}</span></p>
        </div>
    </main>

    @include('components.footer')

</body>
</html>
