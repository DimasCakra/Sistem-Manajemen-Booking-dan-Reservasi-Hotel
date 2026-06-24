<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Reservasi - StayEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: { 50: '#f0f7f0', 100: '#dceddc', 200: '#b9dbb9', 300: '#8cc28c', 400: '#5fa35f', 500: '#3d843d', 600: '#2d6a2d', 700: '#1e4d1e', 800: '#143614', 900: '#0c220c' },
                    },
                    fontFamily: { display: ['Playfair Display', 'serif'], body: ['DM Sans', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .custom-scroll::-webkit-scrollbar { width: 6px; }
        .custom-scroll::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #3d843d; border-radius: 10px; }
    </style>
</head>

<body class="bg-gray-50 h-screen overflow-hidden">

    <div class="flex h-full">
        @include('components.sidebar_resepsionis')

        <main class="flex-1 overflow-y-auto custom-scroll px-8 py-8 bg-gray-50">
            <div class="max-w-6xl mx-auto space-y-6">

                <div class="flex justify-between items-end">
                    <div>
                        <a href="{{ route('receptionist.index') }}" class="text-forest-600 text-xs hover:underline flex items-center mb-2">
                            <span class="mr-1.5">←</span> Kembali ke Dashboard
                        </a>
                        <h1 class="font-display text-3xl font-semibold text-forest-900">Verifikasi Reservasi</h1>
                    </div>
                    <p class="text-[11px] text-forest-500 uppercase tracking-[0.2em] font-bold pb-1">ID: {{ str_pad($reservation->id, 3, '0', STR_PAD_LEFT) }}</p>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

                    <!-- Left Column: Reservation Information -->
                    <div class="lg:col-span-7 space-y-6">

                        <!-- Informasi Pemesan -->
                        <div class="bg-white rounded-2xl shadow-sm border border-forest-100 p-8">
                            <h2 class="font-display text-xl font-semibold text-forest-900 border-b border-gray-100 pb-4 mb-6">Informasi Pemesan</h2>

                            <div class="grid grid-cols-2 gap-x-8 gap-y-6">
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Nama Pemesan</p>
                                    <p class="font-semibold text-forest-900 text-base">{{ $reservation->nama_lengkap }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Nomor Identitas</p>
                                    <p class="font-semibold text-forest-900 text-base">{{ $reservation->id_type ?? 'NIK' }}: {{ $reservation->id_number ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Nomor WhatsApp</p>
                                    <p class="font-semibold text-forest-900 text-base">{{ $reservation->whatsapp }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Alamat Email</p>
                                    <p class="font-semibold text-forest-900 text-base">{{ $reservation->email }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Kamar -->
                        <div class="bg-white rounded-2xl shadow-sm border border-forest-100 p-8">
                            <h2 class="font-display text-xl font-semibold text-forest-900 border-b border-gray-100 pb-4 mb-6">Detail Kamar & Tanggal</h2>

                            <div class="grid grid-cols-2 gap-x-8 gap-y-6">
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Tipe Kamar</p>
                                    <p class="font-semibold text-forest-900 text-base">{{ $reservation->room_type }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Nomor Kamar</p>
                                    <p class="font-semibold text-forest-600 text-base font-bold">{{ $reservation->kamar?->no_kamar ?? $reservation->room_number ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Jumlah Tamu</p>
                                    <p class="font-semibold text-forest-900 text-base">{{ $reservation->jumlah_tamu ?? '-' }} Orang</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Tanggal Check-In</p>
                                    <p class="font-semibold text-forest-900 text-base">
                                        @if($reservation->check_in)
                                            {{ \Carbon\Carbon::parse($reservation->check_in)->format('d-M-Y') }}
                                        @else
                                            {{ $reservation->check_in_out ? explode(' to ', $reservation->check_in_out)[0] : '-' }}
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Tanggal Check-Out</p>
                                    <p class="font-semibold text-forest-900 text-base">
                                        @if($reservation->check_out)
                                            {{ \Carbon\Carbon::parse($reservation->check_out)->format('d-M-Y') }}
                                        @else
                                            {{ $reservation->check_in_out ? explode(' to ', $reservation->check_in_out)[1] ?? '-' : '-' }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Data Tamu Lain (jika ada) -->
                        @if($reservation->nama_tamu_lain)
                        @php
                            $namaTamuLain = json_decode($reservation->nama_tamu_lain, true);
                            $idNumberTamuLain = json_decode($reservation->id_number_tamu_lain, true);
                            $idTypeTamuLain = json_decode($reservation->id_type_tamu_lain ?? '[]', true);

                            // fallback for old string records
                            if (!is_array($namaTamuLain)) {
                                $namaTamuLain = [$reservation->nama_tamu_lain];
                                $idNumberTamuLain = [$reservation->id_number_tamu_lain];
                                $idTypeTamuLain = ['NIK'];
                            }
                        @endphp
                        <div class="bg-amber-50 rounded-2xl shadow-sm border border-amber-100 p-8">
                            <h2 class="font-display text-xl font-semibold text-amber-900 border-b border-amber-100 pb-4 mb-6">Data Tamu Lain</h2>

                            <div class="space-y-6">
                                @foreach($namaTamuLain as $index => $nama)
                                <div class="grid grid-cols-2 gap-x-8 gap-y-2">
                                    <div class="col-span-2">
                                        <p class="text-amber-700 text-xs font-bold mb-1">Tamu Tambahan {{ $index + 1 }}</p>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <p class="text-amber-700 text-[10px] uppercase font-bold tracking-wider mb-1">Nama Tamu</p>
                                        <p class="font-semibold text-amber-900 text-base">{{ $nama }}</p>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <p class="text-amber-700 text-[10px] uppercase font-bold tracking-wider mb-1">Nomor Identitas Tamu</p>
                                        <p class="font-semibold text-amber-900 text-base">{{ $idTypeTamuLain[$index] ?? 'NIK' }}: {{ $idNumberTamuLain[$index] ?? '-' }}</p>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <hr class="border-amber-200">
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Permintaan Khusus -->
                        @if($reservation->permintaan_khusus)
                        <div class="bg-blue-50 rounded-2xl shadow-sm border border-blue-100 p-8">
                            <h2 class="font-display text-xl font-semibold text-blue-900 border-b border-blue-100 pb-4 mb-6">Permintaan Khusus</h2>
                            <p class="text-blue-900 leading-relaxed text-base italic">
                                "{{ $reservation->permintaan_khusus }}"
                            </p>
                        </div>
                        @endif

                    </div>

                    <!-- Right Column: Payment Proof -->
                    <div class="lg:col-span-5 bg-white rounded-2xl shadow-sm border border-forest-100 p-8 flex flex-col h-fit">
                        <h2 class="font-display text-xl font-semibold text-forest-900 border-b border-gray-100 pb-4 mb-6">Bukti Pembayaran</h2>
                        <div class="flex-1 flex items-center justify-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-100 overflow-hidden relative min-h-80">
                            @if($reservation->bukti_pembayaran)
                                <img src="{{ asset('storage/' . $reservation->bukti_pembayaran) }}"
                                     alt="Bukti Transfer"
                                     class="max-w-full h-auto max-h-96 object-contain shadow-sm">
                            @else
                                <p class="text-gray-400 font-medium">Belum ada bukti pembayaran</p>
                            @endif
                        </div>
                        @if($reservation->bukti_pembayaran)
                            <div class="mt-6 bg-gray-50 rounded-xl p-4 border border-gray-100">
                                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-2">Metode Pembayaran</p>
                                <p class="text-base font-semibold text-gray-700">{{ $reservation->payment_method ?? 'Tidak Tercatat' }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Summary Card -->
                <div class="bg-forest-700 rounded-2xl shadow-xl p-8 text-white">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                        <div class="flex-1 grid grid-cols-2 md:grid-cols-2 gap-10">
                            <div>
                                <p class="text-forest-200 text-[10px] uppercase font-bold tracking-[0.2em] mb-2">Total Biaya Reservasi</p>
                                <p class="text-2xl font-bold text-white">Rp {{ number_format($reservation->total_biaya, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-forest-200 text-[10px] uppercase font-bold tracking-[0.2em] mb-2">Status Pembayaran</p>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                                    <p class="text-base font-semibold text-yellow-300">Pending</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white rounded-2xl shadow-sm border border-forest-100 p-10">
                    <h2 class="text-xl font-semibold text-forest-900 mb-8 uppercase tracking-[0.2em] text-center">Keputusan Verifikasi</h2>

                    @if($reservation->status === 'pending' || !in_array($reservation->status, ['ongoing', 'done', 'checkout', 'refund']))
                    <form action="{{ route('resepsionis.verifikasi.update', $reservation->id) }}" method="POST" class="w-full">
                        @csrf
                        <div class="flex items-center justify-center gap-4">
                            @if($reservation->bukti_pembayaran)
                                <button type="submit" name="action" value="tolak" class="px-6 py-3 rounded-xl bg-red-600 text-white font-bold hover:bg-red-700 transition">
                                    Tolak
                                </button>
                                <button type="submit" name="action" value="konfirmasi" class="px-6 py-3 rounded-xl bg-forest-700 text-white font-bold hover:bg-forest-800 transition">
                                    Konfirmasi
                                </button>
                                <a href="{{ route('resepsionis.pdf', $reservation->id) }}" target="_blank" class="px-6 py-3 rounded-xl border border-forest-700 text-forest-700 font-bold hover:bg-forest-50 transition">
                                    Download PDF
                                </a>
                            @else
                                <div class="text-center py-6">
                                    <div class="inline-block mb-4">
                                        <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0v2m0-6v-2m0 0V7a2 2 0 012-2h.5a2 2 0 012 2v2m0 0V9m0 0h2m-6 0h-2m0 0V7a2 2 0 00-2-2h-.5a2 2 0 00-2 2v2m0 0V9"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600 font-semibold text-lg mb-2">Belum Siap untuk Diverifikasi</p>
                                    <p class="text-gray-500">Tamu belum mengunggah bukti pembayaran. Silakan tunggu hingga bukti pembayaran diunggah sebelum verifikasi dapat dilakukan.</p>
                                </div>
                            @endif
                        </div>
                    </form>
                    @else
                        <div class="text-center py-8 bg-blue-50 rounded-xl border border-blue-100">
                            <p class="text-blue-900 font-semibold text-lg">Reservasi Sudah Diproses</p>
                        </div>
                    @endif
                </div>

            </div>
        </main>
    </div>

</body>
</html>
