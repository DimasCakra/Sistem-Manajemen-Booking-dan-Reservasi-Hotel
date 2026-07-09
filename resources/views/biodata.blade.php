<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Biodata - StayEase</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display, h1, h2, h3 { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#FFF4DE] text-[#1e293b] font-sans">
    @include('components.navbar')

    <main class="max-w-8xl mx-auto px-6 py-10">
        <!-- 2 Column Layout: Left (Forms), Right (Summary) -->
        <form id="biodataForm" action="{{ route('booking.biodata.store', ['id' => $id, 'checkin' => $checkin, 'checkout' => $checkout]) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            @csrf

            <!-- Left Column -->
            <div class="lg:col-span-8 space-y-6" x-data="{ bookingLain: false, tamuTambahan: [], maxTamu: {{ max(0, $kamar->jumlah_tamu - 1) }} }">

                <!-- Error Box -->
                <div id="biodataErrorBox" class="hidden p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm font-semibold">
                    <ul id="biodataErrorList" class="list-disc pl-5 space-y-1"></ul>
                </div>

                @if ($errors->any())
                    <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm font-semibold">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Biodata Form Card -->
                <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-black text-[#0f172a] mb-6 border-b pb-4 border-gray-50 uppercase tracking-widest">Masukkan Biodata Anda</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="input_nama" value="{{ old('nama_lengkap', Auth::check() ? Auth::user()->name : '') }}" {{ Auth::check() ? 'readonly' : '' }} class="w-full px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#254117] {{ Auth::check() ? 'bg-gray-100 cursor-not-allowed text-gray-500' : '' }}" placeholder="Masukkan Nama Lengkap Anda" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Nomor Identitas</label>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <select name="id_type" id="id_type" class="w-full sm:w-1/3 px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#254117] bg-white cursor-pointer" {{ Auth::check() && Auth::user()->id_type ? 'style=pointer-events:none;background-color:#f3f4f6;' : '' }}>
                                    <option value="NIK" {{ old('id_type', Auth::check() ? Auth::user()->id_type : '') === 'NIK' ? 'selected' : '' }}>🇮🇩 NIK</option>
                                    <option value="Paspor" {{ old('id_type', Auth::check() ? Auth::user()->id_type : '') === 'Paspor' ? 'selected' : '' }}>🌐 Paspor</option>
                                </select>
                                <input type="text" name="id_number" id="id_number" value="{{ old('id_number', Auth::check() ? Auth::user()->id_number : '') }}" {{ Auth::check() ? 'readonly' : '' }} class="w-full sm:w-2/3 px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#254117] {{ Auth::check() ? 'bg-gray-100 cursor-not-allowed text-gray-500' : '' }}" placeholder="Masukkan Nomor Identitas Anda" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nomor WhatsApp</label>
                                <input type="text" name="whatsapp" id="input_whatsapp" value="{{ old('whatsapp', Auth::check() ? Auth::user()->whatsapp : '') }}" {{ Auth::check() ? 'readonly' : '' }} class="w-full px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#254117] {{ Auth::check() ? 'bg-gray-100 cursor-not-allowed text-gray-500' : '' }}" placeholder="Masukkan Nomor WhatsApp" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Alamat Email</label>
                                <input type="email" name="email" id="input_email" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" {{ Auth::check() ? 'readonly' : '' }} class="w-full px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#254117] {{ Auth::check() ? 'bg-gray-100 cursor-not-allowed text-gray-500' : '' }}" placeholder="Masukkan Alamat Email" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail & Other Requests Card -->
                <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-black text-[#0f172a] mb-6 border-b pb-4 border-gray-50 uppercase tracking-widest">Detail Tambahan</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="flex items-center space-x-3 cursor-pointer mb-4">
                                <input type="checkbox" name="booking_untuk_orang_lain" value="1" class="w-5 h-5 rounded border-gray-300 text-[#254117] focus:ring-[#254117]" x-model="bookingLain" @change="if(bookingLain && tamuTambahan.length === 0 && maxTamu > 0) tamuTambahan.push({id: Date.now(), idType: 'NIK', idNumber: ''})">
                                <span class="text-sm font-bold text-gray-700">Booking untuk orang lain / Tambah Tamu <span x-show="maxTamu > 0">(Maks. <span x-text="maxTamu"></span> Tambahan)</span></span>
                            </label>
                            <div x-show="bookingLain" style="display: none;" class="space-y-4">
                                <template x-if="maxTamu === 0">
                                    <div class="p-4 bg-yellow-50 text-yellow-800 text-sm rounded-md border border-yellow-200">
                                        Kapasitas kamar ini hanya untuk 1 orang, tidak dapat menambah tamu lain.
                                    </div>
                                </template>

                                <template x-for="(tamu, index) in tamuTambahan" :key="tamu.id">
                                    <div class="p-4 border border-gray-200 rounded-md bg-gray-50 relative">
                                        <h4 class="text-sm font-bold text-[#254117] mb-3">Data Tamu Tambahan <span x-text="index + 1"></span></h4>
                                        <input type="text" name="nama_tamu_lain[]" :required="bookingLain" class="w-full px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#254117] mb-3" placeholder="Masukkan Nama Tamu (Wajib)">
                                        
                                        <div class="flex flex-col sm:flex-row gap-2">
                                            <select name="id_type_tamu_lain[]" class="w-full sm:w-1/3 px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#254117] bg-white cursor-pointer" :required="bookingLain" x-model="tamu.idType" @change="tamu.idType = $event.target.value; tamu.idNumber = ''">
                                                <option value="NIK">🇮🇩 NIK</option>
                                                <option value="Paspor">🌐 Paspor</option>
                                            </select>
                                            <input type="text" name="id_number_tamu_lain[]" :required="bookingLain" class="w-full sm:w-2/3 px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#254117]" :placeholder="tamu.idType === 'Paspor' ? 'Masukkan No. Paspor (Wajib)' : 'Masukkan NIK (Wajib)'" :maxlength="tamu.idType === 'Paspor' ? '9' : '16'" x-model="tamu.idNumber" @input="tamu.idNumber = tamu.idType === 'Paspor' ? tamu.idNumber.replace(/[^a-zA-Z0-9]/g, '').slice(0, 9) : tamu.idNumber.replace(/[^0-9]/g, '').slice(0, 16)">
                                        </div>

                                        <button type="button" @click="tamuTambahan.splice(index, 1); if(tamuTambahan.length === 0) bookingLain = false;" class="absolute top-4 right-4 text-red-500 hover:text-red-700 text-sm font-bold">
                                            Hapus
                                        </button>
                                    </div>
                                </template>

                                <button type="button" x-show="tamuTambahan.length < maxTamu" @click="tamuTambahan.push({id: Date.now()})" class="w-full py-3 border-2 border-dashed border-[#254117] text-[#254117] rounded-md font-bold text-sm hover:bg-[#254117] hover:text-white transition-colors">
                                    + Tambah Tamu Lainnya
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Apakah ada permintaan lainnya?</label>
                            <textarea name="permintaan_khusus" rows="4" class="w-full px-4 py-3 rounded-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#254117]" placeholder="Permintaan Khusus (Optional)">{{ old('permintaan_khusus') }}</textarea>
                        </div>
                    </div>
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
                        <p class="text-sm text-gray-500 mt-1">Nomor Kamar: <span class="font-bold text-[#254117]">{{ $candidateNumber ?? '-' }}</span></p>
                    </div>

                    <div class="border-t border-gray-50 py-4 mb-4">
    <div class="flex justify-between items-center mb-2">
        <span class="text-sm text-gray-600">Check-in</span>
        <span class="text-sm font-bold">{{ \Carbon\Carbon::parse($checkin)->format('d-M-Y') }} 12.00 WIB</span>
    </div>
    <div class="flex justify-between items-center mb-2">
        <span class="text-sm text-gray-600">Check-out</span>
        <span class="text-sm font-bold">{{ \Carbon\Carbon::parse($checkout)->format('d-M-Y') }} 15.00 WIB</span>
    </div>
</div>

                    <div class="border-t border-gray-50 py-4 mb-4">
    <div class="flex justify-between items-center mb-2">
        <span class="text-sm text-gray-600">Harga Kamar per Malam</span>
        <span class="text-sm font-bold">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
    </div>
    @php
        $nightCount = \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout));
        $subtotal = $kamar->harga * $nightCount;
    @endphp
    <div class="flex justify-between items-center mb-2">
        <span class="text-sm text-gray-600">Lama Menginap</span>
        <span class="text-sm font-bold">{{ $nightCount }} malam</span>
    </div>
    <div class="flex justify-between items-center mb-2">
        <span class="text-sm text-gray-600">Subtotal</span>
        <span class="text-sm font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
    </div>
    <div class="flex justify-between items-center mb-2">
        <span class="text-sm text-gray-600">Pajak (Termasuk)</span>
        <span class="text-sm font-bold">Rp {{ number_format($pajak, 0, ',', '.') }}</span>
    </div>
</div>
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
                            <span class="text-xl font-black text-[#254117]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-[#254117] hover:bg-[#1a2f0f] text-white py-4 rounded-xl font-bold uppercase tracking-widest text-sm text-center block cursor-pointer transition-all shadow-md">Lanjutkan Ke Pembayaran</button>
                </div>


            </div>
        </form>
    </main>

    @include('components.footer')

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const namaInput     = document.getElementById('input_nama');
        const idNumberInput = document.getElementById('id_number');
        const idTypeSelect  = document.getElementById('id_type');
        const whatsappInput = document.getElementById('input_whatsapp');
        const emailInput    = document.getElementById('input_email');
        const form          = document.getElementById('biodataForm');
        const errorBox      = document.getElementById('biodataErrorBox');
        const errorList     = document.getElementById('biodataErrorList');

        /* ── Nama: hanya huruf & spasi (blokir angka & simbol saat ketik) ── */
        function showNamaError(msg) {
            if (!errorBox || !errorList) return;
            // Hapus pesan nama sebelumnya jika ada
            const existing = errorList.querySelector('[data-nama-error]');
            if (existing) existing.remove();
            const li = document.createElement('li');
            li.setAttribute('data-nama-error', '1');
            li.textContent = msg;
            errorList.appendChild(li);
            errorBox.classList.remove('hidden');
            if (namaInput) namaInput.classList.add('border-red-400');
        }
        function clearNamaError() {
            if (!errorList) return;
            const existing = errorList.querySelector('[data-nama-error]');
            if (existing) existing.remove();
            if (namaInput) namaInput.classList.remove('border-red-400');
            // Sembunyikan kotak jika tidak ada error lain
            if (errorList.children.length === 0) errorBox.classList.add('hidden');
        }



        /* ── Validasi submit form ── */
        if (form) {
            form.addEventListener('submit', function (e) {
                const errors = [];
                const nama     = namaInput     ? namaInput.value.trim()     : '';
                const idNum    = idNumberInput ? idNumberInput.value.trim()  : '';
                const idType   = idTypeSelect  ? idTypeSelect.value          : 'NIK';
                const whatsapp = whatsappInput ? whatsappInput.value.trim()  : '';
                const email    = emailInput    ? emailInput.value.trim()     : '';

                const isReadonlyNama     = namaInput     && namaInput.readOnly;
                const isReadonlyIdNum    = idNumberInput && idNumberInput.readOnly;
                const isReadonlyWa       = whatsappInput && whatsappInput.readOnly;
                const isReadonlyEmail    = emailInput    && emailInput.readOnly;

                /* TC-02: Nama Kosong */
                if (!isReadonlyNama && nama === '') {
                    errors.push('Nama Lengkap tidak boleh kosong.');
                }

                /* TC-09: Nama Berupa Simbol | TC-14: Nama Berupa Angka */
                if (!isReadonlyNama && nama !== '') {
                    if (/[0-9]/.test(nama)) {
                        errors.push('Nama Lengkap tidak boleh mengandung angka.');
                    }
                    if (/[^a-zA-Z\s\u00C0-\u024F]/.test(nama)) {
                        errors.push('Nama Lengkap tidak boleh mengandung simbol.');
                    }
                }

                /* TC-03/TC-04: NIK atau Paspor Kosong */
                if (!isReadonlyIdNum && idNum === '') {
                    if (idType === 'NIK') {
                        errors.push('Nomor NIK tidak boleh kosong.');
                    } else {
                        errors.push('Nomor Paspor tidak boleh kosong.');
                    }
                }

                /* TC-07: NIK Berupa Huruf | TC-10: NIK Berupa Simbol */
                if (!isReadonlyIdNum && idNum !== '' && idType === 'NIK') {
                    if (/[a-zA-Z]/.test(idNum)) {
                        errors.push('NIK tidak boleh mengandung huruf, hanya angka yang diperbolehkan.');
                    } else if (/[^0-9]/.test(idNum)) {
                        errors.push('NIK tidak boleh mengandung simbol, hanya angka yang diperbolehkan.');
                    }
                }

                /* TC-11: Nomor Paspor Berupa Simbol */
                if (!isReadonlyIdNum && idNum !== '' && idType === 'Paspor') {
                    if (/[^a-zA-Z0-9]/.test(idNum)) {
                        errors.push('Nomor Paspor tidak boleh mengandung simbol.');
                    }
                }

                /* TC-05: Nomor HP/WhatsApp Kosong */
                if (!isReadonlyWa && whatsapp === '') {
                    errors.push('Nomor HP/WhatsApp tidak boleh kosong.');
                }

                /* TC-08: Nomor HP/WhatsApp Berupa Huruf | TC-12: Berupa Simbol */
                if (!isReadonlyWa && whatsapp !== '') {
                    if (/[a-zA-Z]/.test(whatsapp)) {
                        errors.push('Nomor HP/WhatsApp tidak boleh mengandung huruf, hanya angka yang diperbolehkan.');
                    } else if (/[^0-9]/.test(whatsapp)) {
                        errors.push('Nomor HP/WhatsApp tidak boleh mengandung simbol.');
                    }
                }

                /* TC-06: Alamat Email Kosong */
                if (!isReadonlyEmail && email === '') {
                    errors.push('Alamat Email tidak boleh kosong.');
                }

                /* TC-13: Alamat Email Berupa Simbol / Format Tidak Valid */
                if (!isReadonlyEmail && email !== '') {
                    const emailRegex = /^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/;
                    if (!emailRegex.test(email)) {
                        errors.push('Alamat Email tidak valid. Gunakan format yang benar, contoh: nama@email.com');
                    }
                }

                /* Tampilkan error atau lanjutkan submit */
                if (errors.length > 0) {
                    e.preventDefault();
                    errorList.innerHTML = '';
                    errors.forEach(function (msg) {
                        const li = document.createElement('li');
                        li.textContent = msg;
                        errorList.appendChild(li);
                    });
                    errorBox.classList.remove('hidden');
                    errorBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    errorBox.classList.add('hidden');
                }
            });
        }
    });
    </script>

</body>
</html>
