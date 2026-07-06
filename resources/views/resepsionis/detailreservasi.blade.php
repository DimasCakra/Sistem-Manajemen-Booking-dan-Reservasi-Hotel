<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi - StayEase</title>
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
    </style>
</head>
<body class="bg-[#FFF4DE] min-h-screen flex flex-col">

    <div class="flex flex-1 overflow-hidden">
        @include('components.sidebar_resepsionis')

        <main class="flex-1 overflow-y-auto px-10 py-10 bg-[#FFF4DE]">
            <div class="max-w-5xl mx-auto">

                <div class="grid grid-cols-3 gap-8 fade-up">
                    <div class="col-span-2 space-y-6">

                        <!-- Informasi Pemesan -->
                        <div class="bg-white rounded-2xl shadow-sm border border-forest-100 p-8">
                            <h2 class="font-display text-xl font-semibold text-forest-900 border-b border-gray-100 pb-4 mb-6">Informasi Pemesan</h2>

                            <div class="grid grid-cols-2 gap-x-8 gap-y-6">
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Nama Pemesan</p>
                                    <p class="font-semibold text-forest-900 text-base">{{ $detail->nama_lengkap }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Nomor Identitas</p>
                                    <p class="font-semibold text-forest-900 text-base">{{ $detail->id_type ?? 'NIK' }}: {{ $detail->id_number ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Nomor WhatsApp</p>
                                    <p class="font-semibold text-forest-900 text-base">{{ $detail->whatsapp }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Alamat Email</p>
                                    <p class="font-semibold text-forest-900 text-base">{{ $detail->email }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Kamar -->
                        <div class="bg-white rounded-2xl shadow-sm border border-forest-100 p-8">
                            <h2 class="font-display text-xl font-semibold text-forest-900 border-b border-gray-100 pb-4 mb-6">Detail Kamar & Tanggal</h2>

                            <div class="grid grid-cols-2 gap-x-8 gap-y-6">
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Tipe Kamar</p>
                                    <p class="font-semibold text-forest-900 text-base">{{ $detail->room_type }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Nomor Kamar</p>
                                    <p class="font-semibold text-forest-600 text-base font-bold">{{ $detail->room_number }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Jumlah Tamu</p>
                                    <p class="font-semibold text-forest-900 text-base">{{ $detail->jumlah_tamu ?? '-' }} Orang</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Tanggal Check-In</p>
                                    <p class="font-semibold text-forest-900 text-base">
                                        @if($detail->check_in)
                                            {{ \Carbon\Carbon::parse($detail->check_in)->format('d-M-Y') }}
                                        @else
                                            {{ $detail->check_in_out ? explode(' to ', $detail->check_in_out)[0] : '-' }}
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Tanggal Check-Out</p>
                                    <p class="font-semibold text-forest-900 text-base">
                                        @if($detail->check_out)
                                            {{ \Carbon\Carbon::parse($detail->check_out)->format('d-M-Y') }}
                                        @else
                                            {{ $detail->check_in_out ? explode(' to ', $detail->check_in_out)[1] ?? '-' : '-' }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Data Tamu Lain (jika ada) -->
                        @if($detail->nama_tamu_lain)
                        @php
                            $namaTamuLain = json_decode($detail->nama_tamu_lain, true);
                            $idNumberTamuLain = json_decode($detail->id_number_tamu_lain, true);
                            $idTypeTamuLain = json_decode($detail->id_type_tamu_lain ?? '[]', true);

                            // fallback for old string records
                            if (!is_array($namaTamuLain)) {
                                $namaTamuLain = [$detail->nama_tamu_lain];
                                $idNumberTamuLain = [$detail->id_number_tamu_lain];
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
                        @if($detail->permintaan_khusus)
                        <div class="bg-blue-50 rounded-2xl shadow-sm border border-blue-100 p-8">
                            <h2 class="font-display text-xl font-semibold text-blue-900 border-b border-blue-100 pb-4 mb-6">Permintaan Khusus</h2>
                            <p class="text-blue-900 leading-relaxed text-base italic">
                                "{{ $detail->permintaan_khusus }}"
                            </p>
                        </div>
                        @endif

                    </div>

                    <div class="col-span-1 space-y-6 h-fit sticky top-10">
                        <div class="bg-forest-900 p-8 rounded-[2rem] shadow-xl text-white relative overflow-hidden">

                            <h3 class="text-[11px] font-black text-white uppercase tracking-[0.2em] mb-12">Ringkasan Biaya</h3>

                            <div class="space-y-5">
                                <div class="flex justify-between items-center text-sm opacity-70">
                                    <span>Harga per Malam</span>
                                    <span>Rp {{ number_format($detail->total_biaya / max(1, \Carbon\Carbon::parse($detail->check_in)->diffInDays($detail->check_out)), 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm opacity-70">
                                    <span>Pajak (Termasuk)</span>
                                    <span>Rp 0</span>
                                </div>
                                <div class="pt-6 mt-6 border-t border-white/10">
                                    <label class="block text-[10px] text-forest-400 uppercase font-bold mb-1">Total Dibayar</label>
                                    <div class="text-2xl font-bold tracking-tight">Rp {{ number_format($detail->total_biaya, 0, ',', '.') }}</div>
                                </div>
                            </div>

                            <div class="mt-12 flex flex-col gap-3">
                                <div class="text-center py-3 rounded-xl border border-white/20 bg-white/10">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-white">
                                        Status: {{ $detail->status == 'checkout' || $detail->status == 'done' ? 'Check Out' : ($detail->status == 'ongoing' ? 'On Going' : ucfirst($detail->status)) }}
                                    </span>
                                </div>

                                @if($detail->status === 'ongoing')
                                <form action="{{ route('resepsionis.selesai', $detail->id) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Yakin ingin menyelesaikan reservasi ini? Tamu sudah check-out?')" class="w-full py-4 bg-white text-forest-900 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-forest-50 transition-colors">
                                        Selesaikan Reservasi
                                    </button>
                                </form>
                                @endif

                                <a href="{{ route('resepsionis.pdf', $detail->id) }}" target="_blank" class="w-full py-4 text-center border-2 border-white text-white rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-white hover:text-forest-900 transition-colors block">
                                    Download Bukti PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
