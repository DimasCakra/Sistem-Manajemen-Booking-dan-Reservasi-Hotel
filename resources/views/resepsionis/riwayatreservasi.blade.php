<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Reservasi - StayEase</title>
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
        body {
            font-family: 'DM Sans', sans-serif;
        }
        .reservation-row {
            transition: all .2s ease;
        }
        .reservation-row:hover {
            background-color: #f0f7f0;
            box-shadow: inset 3px 0 0 #2d6a2d;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-up {
            animation: fadeUp .45s ease both;
        }

    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    <div class="flex flex-1 overflow-hidden">
        @include('components.sidebar_resepsionis')

        <main class="flex-1 overflow-y-auto px-8 py-8 bg-gray-50">
            <div class="mb-6 fade-up">
                <h1 class="font-display text-3xl font-semibold text-forest-900">Riwayat Reservasi</h1>
                <p class="text-sm text-forest-500 mt-1">Daftar keseluruhan data tamu dan riwayat menginap.</p>
            </div>

            <div class="mb-8 fade-up">
                <div class="inline-flex p-1 bg-white border border-gray-200 rounded-xl shadow-sm">
                    @foreach(['' => 'All', 'ongoing' => 'On Going', 'refund' => 'Refund', 'done' => 'Done'] as $key => $label)
                        <a href="?status={{ $key }}" 
                        class="px-6 py-2 text-xs font-bold uppercase tracking-wider rounded-lg transition-all 
                        {{ request('status') == $key ? 'bg-forest-800 text-white shadow-sm' : 'text-gray-400 hover:text-forest-700' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-forest-100 overflow-hidden fade-up" style="animation-delay: 0.2s">
                <div class="bg-forest-800 px-6 py-4 flex items-center justify-between">
                    <h2 class="font-display text-white font-semibold text-base tracking-wide">Data Log Reservasi</h2>
                    <span class="text-forest-300 text-xs tracking-widest">{{ now()->translatedFormat('d F Y') }}</span>
                </div>

                <div class="grid grid-cols-12 gap-4 px-6 py-3 bg-forest-50 border-b border-forest-100 text-forest-600 text-[10px] font-semibold uppercase tracking-widest">
                    <div class="col-span-1">#</div>
                    <div class="col-span-3">Nama Tamu</div>
                    <div class="col-span-2 text-center">Tipe Kamar</div>
                    <div class="col-span-4 text-center">Check-in / Out</div>
                    <div class="col-span-2 text-center">Status</div>
                </div>

                 @forelse($reservations as $res)
                    <div onclick="window.location='{{ route('reservasi.show', $res->id) }}'" 
                         class="reservation-row grid grid-cols-12 gap-4 px-6 py-4 border-b border-gray-100 items-center cursor-pointer group">
                        <div class="col-span-1 text-gray-400 text-sm font-medium">#{{ $res->id }}</div>
                        <div class="col-span-3">
                            <p class="font-semibold text-forest-900 text-sm">{{ $res->nama_lengkap }}</p>
                            <p class="text-gray-400 text-[11px]">{{ $res->email }}</p>
                        </div>
                        <div class="col-span-2 text-center text-sm text-gray-600">
                            {{ $res->room_type }}
                        </div>
                        <div class="col-span-4 text-center text-xs text-gray-600">
                            <span class="font-medium text-forest-800">{{ $res->check_in }}</span>
                            <span class="mx-1 text-forest-300">→</span>
                            <span class="font-medium text-forest-800">{{ $res->check_out }}</span>
                        </div>
                        <div class="col-span-2 flex justify-center">
                            <span class="px-3 py-1 text-[9px] font-black uppercase rounded-lg border 
                                {{ $res->status == 'ongoing' ? 'text-blue-600 bg-blue-50 border-blue-100' : 'text-forest-600 bg-forest-50 border-forest-100' }}">
                                {{ $res->status }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="p-20 text-center text-gray-400 font-medium italic">Belum ada riwayat reservasi.</div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>