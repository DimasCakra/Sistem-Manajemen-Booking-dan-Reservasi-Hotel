<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Biodata | StayEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FFF4DE; color: #1a1a1a; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        
        .glass-panel {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 15px 40px -10px rgba(0,0,0,0.05);
        }

        .input-premium {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .input-premium:focus {
            background-color: #ffffff;
            border-color: #2a5a3b;
            box-shadow: 0 0 0 4px rgba(42, 90, 59, 0.1);
            outline: none;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #2a5a3b 0%, #1e3c28 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, #1e3c28 0%, #14281a 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(30, 60, 40, 0.4);
        }
    </style>
</head>
<body class="antialiased selection:bg-[#2a5a3b] selection:text-white">

    @include('components.navbar')

    <!-- Navigation Breadcrumb -->
    <div class="max-w-7xl mx-auto px-6 pt-12 pb-2">
        <a href="{{ route('booking.biodata', ['id' => $id, 'checkin' => $checkin, 'checkout' => $checkout]) }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#1e3c28] transition-colors">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Detail Kamar
        </a>
    </div>

    <main class="max-w-7xl mx-auto px-6 pb-20">
        
        <!-- Header -->
        <div class="mb-10 text-center md:text-left">
            <h1 class="font-playfair text-4xl md:text-5xl font-bold text-[#1a2f0f] mb-3">Lengkapi Data Anda</h1>
            <p class="text-gray-600">Pastikan data yang Anda masukkan sesuai dengan identitas resmi.</p>
        </div>

        <!-- 2 Column Layout: Left (Forms), Right (Summary) -->
        <form action="{{ route('booking.biodata.store', ['id' => $id, 'checkin' => $checkin, 'checkout' => $checkout]) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            @csrf
            
            <!-- Left Column: Form -->
            <div class="lg:col-span-8 space-y-8" x-data="{ bookingLain: false, tamuTambahan: [], maxTamu: {{ max(0, $kamar->jumlah_tamu - 1) }} }">
                
                <!-- Biodata Form Card -->
                <div class="glass-panel p-8 md:p-10 rounded-[2rem]">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-full bg-[#2a5a3b]/10 flex items-center justify-center text-[#2a5a3b]">
                            <i class="fa-solid fa-user text-xl"></i>
                        </div>
                        <h2 class="font-playfair text-2xl font-bold text-[#1a2f0f]">Informasi Pemesan</h2>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ Auth::check() ? Auth::user()->name : '' }}" {{ Auth::check() ? 'readonly' : '' }} class="input-premium w-full px-5 py-4 rounded-xl text-gray-800 placeholder-gray-400 {{ Auth::check() ? 'opacity-70 cursor-not-allowed' : '' }}" placeholder="Sesuai KTP/Paspor" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Identitas Diri</label>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <select name="id_type" id="id_type" class="input-premium w-full sm:w-1/3 px-5 py-4 rounded-xl text-gray-800 cursor-pointer appearance-none" {{ Auth::check() && Auth::user()->id_type ? 'style=pointer-events:none;opacity:0.7;' : '' }}>
                                    <option value="NIK" {{ Auth::check() && Auth::user()->id_type === 'NIK' ? 'selected' : '' }}>KTP (NIK)</option>
                                    <option value="Paspor" {{ Auth::check() && Auth::user()->id_type === 'Paspor' ? 'selected' : '' }}>Paspor</option>
                                </select>
                                <input type="text" name="id_number" id="id_number" value="{{ Auth::check() ? Auth::user()->id_number : '' }}" {{ Auth::check() ? 'readonly' : '' }} class="input-premium w-full sm:w-2/3 px-5 py-4 rounded-xl text-gray-800 placeholder-gray-400 {{ Auth::check() ? 'opacity-70 cursor-not-allowed' : '' }}" placeholder="Masukkan Nomor Identitas" required>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                                <input type="text" name="whatsapp" value="{{ Auth::check() ? Auth::user()->whatsapp : '' }}" {{ Auth::check() ? 'readonly' : '' }} class="input-premium w-full px-5 py-4 rounded-xl text-gray-800 placeholder-gray-400 {{ Auth::check() ? 'opacity-70 cursor-not-allowed' : '' }}" placeholder="Contoh: 08123456789" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                                <input type="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" {{ Auth::check() ? 'readonly' : '' }} class="input-premium w-full px-5 py-4 rounded-xl text-gray-800 placeholder-gray-400 {{ Auth::check() ? 'opacity-70 cursor-not-allowed' : '' }}" placeholder="email@contoh.com" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail & Other Requests Card -->
                <div class="glass-panel p-8 md:p-10 rounded-[2rem]">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-full bg-[#2a5a3b]/10 flex items-center justify-center text-[#2a5a3b]">
                            <i class="fa-solid fa-list-check text-xl"></i>
                        </div>
                        <h2 class="font-playfair text-2xl font-bold text-[#1a2f0f]">Detail Tambahan</h2>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <div class="relative flex items-center justify-center">
                                    <input type="checkbox" name="booking_untuk_orang_lain" value="1" class="peer appearance-none w-6 h-6 border-2 border-gray-300 rounded text-[#2a5a3b] checked:bg-[#2a5a3b] checked:border-[#2a5a3b] focus:ring-2 focus:ring-[#2a5a3b] focus:ring-offset-1 transition-all" x-model="bookingLain" @change="if(bookingLain && tamuTambahan.length === 0 && maxTamu > 0) tamuTambahan.push({id: Date.now(), idType: 'NIK', idNumber: ''})">
                                    <i class="fa-solid fa-check text-white absolute text-xs opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity"></i>
                                </div>
                                <span class="text-sm md:text-base font-semibold text-gray-700 group-hover:text-[#1a2f0f] transition-colors">Saya memesan untuk orang lain / Tambah Tamu <span x-show="maxTamu > 0" class="text-gray-400 font-normal ml-1">(Maks. <span x-text="maxTamu"></span> Tambahan)</span></span>
                            </label>
                            
                            <div x-show="bookingLain" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="mt-6 space-y-4">
                                <template x-if="maxTamu === 0">
                                    <div class="p-4 bg-orange-50 text-orange-800 text-sm rounded-xl border border-orange-200 flex items-start gap-3">
                                        <i class="fa-solid fa-circle-info mt-0.5"></i>
                                        <p>Kapasitas kamar ini hanya untuk 1 orang, sehingga tidak dapat menambah tamu lain.</p>
                                    </div>
                                </template>

                                <template x-for="(tamu, index) in tamuTambahan" :key="tamu.id">
                                    <div class="p-6 border border-gray-200 rounded-xl bg-white relative shadow-sm">
                                        <div class="flex justify-between items-center mb-4">
                                            <h4 class="text-sm font-bold text-[#1a2f0f] uppercase tracking-wider">Tamu Tambahan <span x-text="index + 1"></span></h4>
                                            <button type="button" @click="tamuTambahan.splice(index, 1); if(tamuTambahan.length === 0) bookingLain = false;" class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        
                                        <input type="text" name="nama_tamu_lain[]" :required="bookingLain" class="input-premium w-full px-5 py-4 rounded-xl text-gray-800 placeholder-gray-400 mb-4" placeholder="Nama Lengkap Tamu">
                                        
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <select name="id_type_tamu_lain[]" class="input-premium w-full sm:w-1/3 px-5 py-4 rounded-xl text-gray-800 cursor-pointer appearance-none" :required="bookingLain" x-model="tamu.idType" @change="tamu.idType = $event.target.value; tamu.idNumber = ''">
                                                <option value="NIK">KTP (NIK)</option>
                                                <option value="Paspor">Paspor</option>
                                            </select>
                                            <input type="text" name="id_number_tamu_lain[]" :required="bookingLain" class="input-premium w-full sm:w-2/3 px-5 py-4 rounded-xl text-gray-800 placeholder-gray-400" :placeholder="tamu.idType === 'Paspor' ? 'Nomor Paspor' : 'Nomor KTP (NIK)'" :maxlength="tamu.idType === 'Paspor' ? '9' : '16'" x-model="tamu.idNumber" @input="tamu.idNumber = tamu.idType === 'Paspor' ? tamu.idNumber.replace(/[^a-zA-Z0-9]/g, '').slice(0, 9) : tamu.idNumber.replace(/[^0-9]/g, '').slice(0, 16)">
                                        </div>
                                    </div>
                                </template>

                                <button type="button" x-show="tamuTambahan.length < maxTamu" @click="tamuTambahan.push({id: Date.now()})" class="w-full py-4 border-2 border-dashed border-[#2a5a3b]/40 text-[#2a5a3b] rounded-xl font-bold text-sm hover:bg-[#2a5a3b]/5 hover:border-[#2a5a3b] transition-all flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-plus"></i> Tambah Tamu Lainnya
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Permintaan Khusus <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <textarea name="permintaan_khusus" rows="4" class="input-premium w-full px-5 py-4 rounded-xl text-gray-800 placeholder-gray-400 resize-none" placeholder="Contoh: Non-smoking room, high floor, dsb."></textarea>
                            <p class="text-xs text-gray-500 mt-2">*Ketersediaan permintaan khusus tidak dijamin dan tergantung pada saat check-in.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Summary -->
            <div class="lg:col-span-4 relative">
                <div class="glass-panel p-8 rounded-[2rem] sticky top-28">
                    <h2 class="text-xs font-bold text-gray-400 mb-6 uppercase tracking-widest border-b border-gray-100 pb-4">Rincian Pesanan</h2>

                    <!-- Hotel & Room Info -->
                    <div class="mb-6 flex gap-4">
                        <div class="w-20 h-20 rounded-xl bg-gray-200 overflow-hidden shrink-0">
                            <img src="{{ $kamar->gambar }}" alt="{{ $kamar->nama_tipe }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="font-playfair text-xl font-bold text-[#1a2f0f]">{{ $kamar->nama_tipe }}</h3>
                            <p class="text-sm text-gray-500 mt-1"><i class="fa-solid fa-bed text-xs mr-1 text-gray-400"></i> Kamar {{ $candidateNumber ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Dates -->
                    <div class="bg-gray-50/80 rounded-xl p-4 mb-6 grid grid-cols-2 gap-4 border border-gray-100">
                        <div>
                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Check-in</span>
                            <span class="block text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($checkin)->format('d M Y') }}</span>
                            <span class="block text-xs text-gray-500">14:00 WIB</span>
                        </div>
                        <div class="border-l border-gray-200 pl-4">
                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Check-out</span>
                            <span class="block text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($checkout)->format('d M Y') }}</span>
                            <span class="block text-xs text-gray-500">12:00 WIB</span>
                        </div>
                    </div>

                    @php
                        $nightCount = \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout));
                        $subtotal = $kamar->harga * $nightCount;
                    @endphp

                    <!-- Price Breakdown -->
                    <div class="space-y-3 border-b border-gray-100 pb-6 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Harga Kamar</span>
                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Durasi</span>
                            <span class="text-sm font-bold text-gray-900">{{ $nightCount }} Malam</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Subtotal</span>
                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pajak (10%)</span>
                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format($pajak, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-center mb-8">
                        <span class="text-base font-bold text-gray-900">Total Harga</span>
                        <span class="text-2xl font-bold text-[#2a5a3b]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-gradient w-full text-white py-4 px-6 rounded-xl font-bold flex items-center justify-center gap-2 group">
                        Lanjut Pembayaran
                        <i class="fa-solid fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                    </button>
                    
                    <p class="text-center text-[11px] text-gray-400 mt-4">
                        Dengan menekan tombol ini, Anda menyetujui syarat & ketentuan StayEase.
                    </p>
                </div>
            </div>
            
        </form>
    </main>

    @include('components.footer')

</body>
</html>
