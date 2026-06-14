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

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
                    
                    <div class="lg:col-span-7 bg-white rounded-2xl shadow-sm border border-forest-100 p-8">
                        <h2 class="font-display text-xl font-semibold text-forest-900 border-b border-gray-100 pb-4 mb-6">Informasi Reservasi</h2>
                        
                        <div class="grid grid-cols-2 gap-x-8 gap-y-6 text-sm">
                            <div class="col-span-2 sm:col-span-1">
                                <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Nama Pemesan</p>
                                <p class="font-semibold text-forest-900 text-base">{{ $reservation->nama_lengkap }}</p>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Nomor WhatsApp</p>
                                <p class="font-semibold text-forest-900 text-base">{{ $reservation->whatsapp }}</p>
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Alamat Email</p>
                                <p class="font-semibold text-forest-900 text-base">{{ $reservation->email }}</p>
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Tipe Kamar</p>
                                <p class="font-semibold text-forest-900 text-base">{{ $reservation->room_type }}</p>
                            </div>

                            @if($reservation->nama_tamu_lain)
                            <div class="col-span-2 border-t border-gray-50 pt-4">
                                <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-2 text-amber-600">Detail Pemesanan</p>
                                <p class="text-black-800 text-[15px]">Dipesankan untuk orang lain: <span class="font-bold">{{ $reservation->nama_tamu_lain }}</span></p>
                            </div>
                            @endif

                            @if($reservation->permintaan_khusus)
                            <div class="col-span-2 bg-gray-50 rounded-xl p-4 border border-gray-100">
                                <p class="text-gray-500 text-[12px] uppercase font-bold tracking-wider mb-1">Catatan Tamu</p>
                                <p class="text-gray-600 leading-relaxed text-[12px]">"{{ $reservation->permintaan_khusus }}"</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="lg:col-span-5 bg-white rounded-2xl shadow-sm border border-forest-100 p-8 flex flex-col">
                        <h2 class="font-display text-xl font-semibold text-forest-900 border-b border-gray-100 pb-4 mb-6">Bukti Pembayaran</h2>
                        <div class="flex-1 flex items-center justify-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-100 overflow-hidden relative">
                            @if($reservation->bukti_pembayaran)
                                <img src="{{ asset('storage/' . $reservation->bukti_pembayaran) }}" 
                                     alt="Bukti Transfer" 
                                     class="max-w-full h-auto max-h-[300px] object-contain shadow-sm">
                            @else
                                <p class="text-gray-400 font-medium">Belum ada bukti pembayaran</p>
                            @endif
                        </div>
                        @if($reservation->bukti_pembayaran)
                        <p class="text-center text-[10px] text-gray-400 mt-4 italic tracking-wide uppercase">Pembayaran via {{ $reservation->payment_method ?? 'Unknown' }}</p>
                        @endif
                    </div>
                </div>

                <div class="bg-[#173014] rounded-2xl shadow-xl p-8 text-white relative overflow-hidden">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 relative z-10">
                        <div class="flex-1 grid grid-cols-2 md:grid-cols-3 gap-10">
                            <div>
                                <p class="text-forest-400 text-[10px] uppercase font-bold tracking-[0.2em] mb-2">Harga Sewa Kamar</p>
                                <p class="text-xl font-medium">Rp 1.500.000</p>
                            </div>
                            <div>
                                <p class="text-forest-400 text-[10px] uppercase font-bold tracking-[0.2em] mb-2">Check-in / Out</p>
                                <p class="text-base font-medium text-forest-100">{{ $reservation->check_in_out }}</p>
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <p class="text-amber-400 text-[10px] uppercase font-bold tracking-[0.2em] mb-2 font-display">Total Dana Diterima</p>
                                <p class="text-2xl font-bold text-white-400">Rp {{ number_format($reservation->total_biaya, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-forest-100 p-10 flex flex-col items-center justify-center text-center">
                    <h2 class="text-xl font-semibold text-forest-900 mb-8 uppercase tracking-[0.2em]">Verifikasi</h2>
                    
                    <form action="{{ route('resepsionis.verifikasi.update', $reservation->id) }}" method="POST" class="w-full">
                        @csrf
                        <div class="flex items-center justify-center gap-6">
                            @if($reservation->bukti_pembayaran)
                                <button type="submit" name="action" value="tolak" class="w-48 py-4 bg-red-500 border-2 border-red-100 text-white font-bold rounded-md hover:bg-red-700 shadow-md shadow-red-200 transition-all text-[13px] uppercase tracking-widest">
                                    Tolak
                                </button>
                                <button type="submit" name="action" value="konfirmasi" class="w-64 py-4 bg-forest-600 text-white font-bold rounded-md hover:bg-forest-700 shadow-sm shadow-forest-200 transition-all text-[14px] uppercase tracking-widest">
                                    Konfirmasi Reservasi
                                </button>
                            @else
                                <p class="text-gray-500 font-semibold italic">Tamu belum mengunggah bukti pembayaran.</p>
                                <!-- Optional: disabled buttons to show UI -->
                                <button type="button" disabled class="w-48 py-4 bg-gray-300 border-2 border-gray-100 text-gray-500 font-bold rounded-md cursor-not-allowed text-[13px] uppercase tracking-widest hidden">
                                    Tolak
                                </button>
                            @endif
                        </div>
                    </form>
                </div>

            </div>
        </main>
    </div>

</body>
</html>