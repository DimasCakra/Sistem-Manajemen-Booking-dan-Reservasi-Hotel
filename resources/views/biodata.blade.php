<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Biodata - StayEase</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-200 text-[#1e293b] font-sans">
    @include('components.navbar')

    <main class="max-w-8xl mx-auto px-6 py-10">
        <!-- 2 Column Layout: Left (Forms), Right (Summary) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Biodata Form Card -->
                <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-black text-[#0f172a] mb-6 border-b pb-4 border-gray-50 uppercase tracking-widest">Masukkan Biodata Anda</h2>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" class="w-full px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#8C6A1A]" placeholder="Masukkan Nama Lengkap Anda">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nomor WhatsApp</label>
                                <input type="text" class="w-full px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#8C6A1A]" placeholder="Masukkan Nomor WhatsApp">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Alamat Email</label>
                                <input type="email" class="w-full px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#8C6A1A]" placeholder="Masukkan Alamat Email">
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Detail & Other Requests Card -->
                <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-black text-[#0f172a] mb-6 border-b pb-4 border-gray-50 uppercase tracking-widest">Detail Tambahan</h2>
                    <form class="space-y-4">
                        <div>
                            <label class="flex items-center space-x-3 cursor-pointer mb-4">
                                <input type="checkbox" class="w-5 h-5 rounded border-gray-300 text-[#8C6A1A] focus:ring-[#8C6A1A]">
                                <span class="text-sm font-bold text-gray-700">booking untuk orang lain (Nama Tamu)</span>
                            </label>
                            <input type="text" class="w-full px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#8C6A1A] mb-4" placeholder="Masukkan Nama Tamu (Optional)">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Apakah ada permintaan lainnya?</label>
                            <textarea rows="4" class="w-full px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#8C6A1A]" placeholder="Permintaan Khusus (Optional)"></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Summary Card -->
                <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-black text-[#0f172a] mb-6 border-b pb-4 border-gray-50 uppercase tracking-widest">Lihat Detail Pesanan</h2>
                    
                    <div class="mb-6">
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-1">Hotel</p>
                        <h3 class="text-lg font-black text-black">StayEase Hotel</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $kamar->nama_tipe }} - {{ $durasi }} Malam</p>
                    </div>

                    <div class="border-t border-gray-50 py-4 mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Check-in</span>
                            <span class="text-sm font-bold">{{ $checkin }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Check-out</span>
                            <span class="text-sm font-bold">{{ $checkout }}</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-50 py-4 mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Harga Kamar</span>
                            <span class="text-sm font-bold">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Pajak & Biaya Layanan</span>
                            <span class="text-sm font-bold">Rp {{ number_format($pajak, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 mt-2">
                        <div class="flex justify-between items-center">
                            <span class="text-base font-black">Total Pembayaran</span>
                            <span class="text-xl font-black text-[#8C6A1A]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('booking.payment', $id) }}" class="w-full bg-[#8C6A1A] text-white py-4 rounded-xl font-bold uppercase tracking-widest text-sm text-center block cursor-pointer transition-all shadow-md hover:shadow-[#8C6A1A]">
                    Lanjutkan Ke Pembayaran
                </a>
            </div>
        </div>
    </main>

    @include('components.footer')

</body>
</html>
