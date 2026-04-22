<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi - Grand Lumina</title>
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
        .sidebar-bg { background: linear-gradient(180deg, #0c220c 0%, #1e4d1e 60%, #2d6a2d 100%); }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    <div class="flex flex-1 overflow-hidden">
        @include('components.sidebar')

        <main class="flex-1 overflow-y-auto px-10 py-10 bg-gray-50">
            <div class="max-w-5xl mx-auto">

                <div class="grid grid-cols-3 gap-8 fade-up">
                    <div class="col-span-2 space-y-6">
                        
                        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-300">
                            <div class="flex items-center gap-3 mb-8">
                                <h3 class="text-[11px] font-black text-forest-900 uppercase tracking-[0.2em]">Data Diri Tamu</h3>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-y-8 gap-x-12">
                                <div>
                                    <label class="block text-[10px] text-gray-400 uppercase font-bold mb-2 tracking-wider">Nama Lengkap</label>
                                    <p class="text-base font-semibold text-gray-800">{{ $detail->nama_lengkap }}</p>
                                </div>
                                <div>
                                    <label class="block text-[10px] text-gray-400 uppercase font-bold mb-2 tracking-wider">Nomor Telepon / WA</label>
                                    <p class="text-base font-semibold text-gray-800">{{ $detail->whatsapp ?? '-' }}</p>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-[10px] text-gray-400 uppercase font-bold mb-2 tracking-wider">Alamat Email</label>
                                    <p class="text-base font-semibold text-gray-800">{{ $detail->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-300">
                            <div class="flex items-center gap-3 mb-8">
                                <h3 class="text-[11px] font-black text-forest-900 uppercase tracking-[0.2em]">Detail Reservasi</h3>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-y-8 gap-x-12">
                                <div>
                                    <label class="block text-[10px] text-gray-400 uppercase font-bold mb-2 tracking-wider">Tipe Kamar</label>
                                    <p class="text-base font-semibold text-gray-800">{{ $detail->room_type }}</p>
                                </div>
                                <div>
                                    <label class="block text-[10px] text-gray-400 uppercase font-bold mb-2 tracking-wider">Nomor Kamar</label>
                                    <p class="text-base font-semibold text-forest-600 font-bold">{{ $detail->room_number }}</p>
                                </div>
                                <div>
                                    <label class="block text-[10px] text-gray-400 uppercase font-bold mb-2 tracking-wider">Check In</label>
                                    <p class="text-base font-semibold text-gray-800">{{ \Carbon\Carbon::parse($detail->check_in)->translatedFormat('d F Y') }}</p>
                                </div>
                                <div>
                                    <label class="block text-[10px] text-gray-400 uppercase font-bold mb-2 tracking-wider">Check Out</label>
                                    <p class="text-base font-semibold text-gray-800">{{ \Carbon\Carbon::parse($detail->check_out)->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                        </div>
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
                                    <span class="text-[10px] font-black uppercase tracking-widest text-white">Status: {{ $detail->status }}</span>
                                </div>
                                
                                @if($detail->status !== 'done')
                                <button class="w-full py-4 bg-white text-forest-900 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-forest-50 transition-colors">
                                    Selesaikan Reservasi
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>