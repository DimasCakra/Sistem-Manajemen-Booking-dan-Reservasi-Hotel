<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi - StayEase</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .policy-section h2 { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#FFF4DE] text-[#1e293b]">

    @include('components.navbar')

    {{-- HERO --}}
    <section class="bg-[#173014] pt-36 pb-20">
        <div class="max-w-4xl mx-auto px-8 text-center">
            <div class="inline-flex items-center gap-2 px-5 py-2 mb-8 bg-[#8C6A1A]/20 border border-[#8C6A1A]/40 rounded-full text-[#C4922A] text-xs font-bold uppercase tracking-widest">
                Legal & Kebijakan
            </div>
            <h1 class="font-display text-5xl font-bold text-white leading-tight mb-4">Kebijakan Privasi</h1>
            <p class="text-white/60 text-sm">Terakhir diperbarui: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        </div>
    </section>

    {{-- CONTENT --}}
    <div class="max-w-4xl mx-auto px-8 py-20 policy-section">

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-10 flex gap-4 items-start">
            <div class="w-10 h-10 rounded-xl bg-[#173014]/10 flex items-center justify-center flex-shrink-0 mt-1">
                <svg class="w-5 h-5 text-[#173014]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-gray-600 text-sm leading-relaxed">
                Kebijakan Privasi ini menjelaskan bagaimana <strong class="text-[#173014]">StayEase</strong> mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat menggunakan layanan kami. Dengan menggunakan platform kami, Anda menyetujui ketentuan yang dijelaskan dalam dokumen ini.
            </p>
        </div>

        <div class="space-y-12">

            <div class="border-b border-gray-100 pb-10">
                <h2 class="text-2xl font-bold text-[#173014] mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#173014] text-white text-sm font-bold flex items-center justify-center flex-shrink-0">1</span>
                    Informasi yang Kami Kumpulkan
                </h2>
                <p class="text-gray-600 leading-relaxed mb-4">Dalam rangka menyediakan layanan reservasi hotel, kami mengumpulkan beberapa jenis informasi dari pengguna, antara lain:</p>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span><strong>Informasi Identitas:</strong> Nama lengkap, Nomor Induk Kependudukan (Nomor Identitas), dan tanggal lahir.</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span><strong>Informasi Kontak:</strong> Alamat email dan nomor WhatsApp yang aktif.</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span><strong>Informasi Reservasi:</strong> Tanggal check-in/check-out, tipe kamar, jumlah tamu, dan permintaan khusus.</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span><strong>Informasi Pembayaran:</strong> Bukti transfer atau bukti pembayaran (dalam format gambar).</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span><strong>Data Teknis:</strong> Alamat IP, jenis browser, dan data log akses yang dikumpulkan secara otomatis.</span></li>
                </ul>
            </div>

            <div class="border-b border-gray-100 pb-10">
                <h2 class="text-2xl font-bold text-[#173014] mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#173014] text-white text-sm font-bold flex items-center justify-center flex-shrink-0">2</span>
                    Bagaimana Kami Menggunakan Informasi Anda
                </h2>
                <p class="text-gray-600 leading-relaxed mb-4">Informasi yang kami kumpulkan digunakan semata-mata untuk tujuan operasional layanan, yaitu:</p>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span>Memproses dan mengelola reservasi kamar hotel Anda.</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span>Mengirimkan notifikasi dan konfirmasi pemesanan melalui WhatsApp.</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span>Memverifikasi identitas dan kelayakan tamu untuk keperluan check-in.</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span>Meningkatkan kualitas layanan berdasarkan ulasan dan umpan balik pengguna.</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span>Memenuhi kewajiban hukum dan peraturan yang berlaku di wilayah Indonesia.</span></li>
                </ul>
            </div>

            <div class="border-b border-gray-100 pb-10">
                <h2 class="text-2xl font-bold text-[#173014] mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#173014] text-white text-sm font-bold flex items-center justify-center flex-shrink-0">3</span>
                    Keamanan Data
                </h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Kami berkomitmen untuk melindungi keamanan data pribadi Anda. Kami menerapkan langkah-langkah teknis dan organisasional yang memadai untuk mencegah akses tidak sah, pengungkapan, perubahan, atau penghancuran data Anda. Namun demikian, tidak ada metode transmisi data melalui internet yang 100% aman, sehingga kami tidak dapat menjamin keamanan absolut.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Seluruh data sensitif disimpan dengan enkripsi dan hanya dapat diakses oleh personel yang berwenang dengan kebutuhan yang sah.
                </p>
            </div>

            <div class="border-b border-gray-100 pb-10">
                <h2 class="text-2xl font-bold text-[#173014] mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#173014] text-white text-sm font-bold flex items-center justify-center flex-shrink-0">4</span>
                    Berbagi Informasi dengan Pihak Ketiga
                </h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    StayEase <strong class="text-[#173014]">tidak menjual, memperdagangkan, atau menyewakan</strong> informasi pribadi Anda kepada pihak ketiga untuk tujuan komersial. Informasi Anda hanya dapat dibagikan dalam situasi berikut:
                </p>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span>Kepada penyedia layanan teknis yang membantu operasional platform kami, terikat oleh perjanjian kerahasiaan.</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span>Jika diwajibkan oleh hukum atau perintah pengadilan yang sah.</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span>Untuk melindungi hak, properti, atau keselamatan StayEase dan penggunanya.</span></li>
                </ul>
            </div>

            <div class="border-b border-gray-100 pb-10">
                <h2 class="text-2xl font-bold text-[#173014] mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#173014] text-white text-sm font-bold flex items-center justify-center flex-shrink-0">5</span>
                    Hak-Hak Pengguna
                </h2>
                <p class="text-gray-600 leading-relaxed mb-4">Sebagai pengguna layanan kami, Anda memiliki hak-hak berikut terkait data pribadi Anda:</p>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span><strong>Hak Akses:</strong> Anda berhak meminta salinan data pribadi yang kami simpan.</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span><strong>Hak Koreksi:</strong> Anda dapat memperbarui informasi pribadi Anda melalui pengaturan akun.</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span><strong>Hak Penghapusan:</strong> Anda dapat mengajukan permintaan penghapusan data, sesuai ketentuan yang berlaku.</span></li>
                    <li class="flex items-start gap-3"><span class="w-1.5 h-1.5 rounded-full bg-[#8C6A1A] mt-2 flex-shrink-0"></span><span><strong>Hak Keberatan:</strong> Anda dapat mengajukan keberatan atas pemrosesan data pribadi Anda.</span></li>
                </ul>
            </div>

            <div class="border-b border-gray-100 pb-10">
                <h2 class="text-2xl font-bold text-[#173014] mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#173014] text-white text-sm font-bold flex items-center justify-center flex-shrink-0">6</span>
                    Retensi Data
                </h2>
                <p class="text-gray-600 leading-relaxed">
                    Data pribadi Anda akan kami simpan selama akun Anda aktif dan/atau selama diperlukan untuk menyediakan layanan, mematuhi kewajiban hukum, menyelesaikan sengketa, dan menegakkan perjanjian kami. Setelah periode retensi berakhir, data akan dihapus secara permanen dari sistem kami.
                </p>
            </div>

            <div class="pb-4">
                <h2 class="text-2xl font-bold text-[#173014] mb-4 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-[#173014] text-white text-sm font-bold flex items-center justify-center flex-shrink-0">7</span>
                    Perubahan Kebijakan Privasi
                </h2>
                <p class="text-gray-600 leading-relaxed">
                    Kami berhak memperbarui Kebijakan Privasi ini sewaktu-waktu. Setiap perubahan akan diberitahukan kepada pengguna melalui platform kami dengan mencantumkan tanggal pembaruan di bagian atas halaman ini. Penggunaan layanan kami yang berkelanjutan setelah perubahan tersebut dianggap sebagai penerimaan Anda terhadap kebijakan yang telah diperbarui.
                </p>
            </div>

        </div>

        {{-- Footer Note --}}
        <div class="mt-16 bg-[#173014] rounded-2xl p-8 text-center">
            <p class="text-white/70 text-sm leading-relaxed">
                Jika Anda memiliki pertanyaan mengenai Kebijakan Privasi ini, silakan hubungi kami melalui halaman <a href="{{ route('kontak') }}" class="text-[#C4922A] hover:underline font-semibold">Kontak</a>.
            </p>
        </div>

    </div>

    @include('components.footer')
</body>
</html>
