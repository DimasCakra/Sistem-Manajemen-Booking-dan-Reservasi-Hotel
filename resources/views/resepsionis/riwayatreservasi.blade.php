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
                <form method="GET" action="{{ route('resepsionis.riwayatreservasi') }}" class="flex gap-3 items-center">
                    <div class="relative w-1/3">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama, WA, email, nomor kamar, tipe..." class="pl-10 pr-4 py-2 rounded-xl border border-forest-100 w-full" />
                    </div>
                    <select name="status" class="px-4 py-2 rounded-xl border border-forest-100">
                        <option value="ongoing" {{ ($status === 'ongoing') ? 'selected' : '' }}>On Going</option>
                        <option value="checkout" {{ ($status === 'checkout') ? 'selected' : '' }}>Check Out</option>
                        <option value="all" {{ ($status === 'all') ? 'selected' : '' }}>All</option>
                    </select>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-forest-700 hover:bg-forest-800 text-white text-sm font-semibold transition-all whitespace-nowrap">Cari</button>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-forest-100 overflow-hidden fade-up" style="animation-delay: 0.2s">
                <div class="bg-forest-800 px-6 py-4 flex items-center justify-between">
                    <h2 class="font-display text-white font-semibold text-base tracking-wide">Data Log Reservasi</h2>
                    <span class="text-forest-300 text-xs tracking-widest">{{ now()->translatedFormat('d F Y') }}</span>
                </div>

                <div class="grid grid-cols-12 gap-4 px-6 py-3 bg-forest-50 border-b border-forest-100 text-forest-600 text-[10px] font-semibold uppercase tracking-widest">
                    <div class="col-span-1">#</div>
                    <div class="col-span-2">Nama Tamu</div>
                    <div class="col-span-2 text-center">Tipe Kamar</div>
                    <div class="col-span-3 text-center">Check-in / Out</div>
                    <div class="col-span-2 text-center">Status</div>
                    <div class="col-span-2 text-center">Aksi</div>
                </div>

                 @forelse($reservations as $res)
                    <div onclick="window.location='{{ route('reservasi.show', $res->id) }}'"
                          class="reservation-row grid grid-cols-12 gap-4 px-6 py-4 border-b border-gray-100 items-center cursor-pointer group">
                        <div class="col-span-1 text-gray-400 text-sm font-medium">#{{ $res->id }}</div>
                        <div class="col-span-2">
                            <p class="font-semibold text-forest-900 text-sm">{{ $res->nama_lengkap }}</p>
                            <p class="text-gray-400 text-[11px]">{{ $res->email }}</p>
                        </div>
                        <div class="col-span-2 text-center text-sm text-gray-600">
                            {{ $res->room_type }}
                        </div>
                        <div class="col-span-3 text-center text-xs text-gray-600">
                            @php
                                try {
                                    if ($res->check_in && $res->check_out) {
                                        $start = \Carbon\Carbon::parse($res->check_in);
                                        $end = \Carbon\Carbon::parse($res->check_out);
                                    } else {
                                        $parts = explode(' to ', $res->check_in_out ?? '');
                                        $start = isset($parts[0]) && $parts[0] ? \Carbon\Carbon::parse(trim($parts[0])) : null;
                                        $end = isset($parts[1]) && $parts[1] ? \Carbon\Carbon::parse(trim($parts[1])) : null;
                                    }
                                } catch (\Exception $e) {
                                    $start = $res->created_at ? \Carbon\Carbon::parse($res->created_at) : null;
                                    $end = $res->created_at ? \Carbon\Carbon::parse($res->created_at) : null;
                                }
                            @endphp

                            <span class="font-medium text-forest-800">{{ $start ? $start->format('d M Y') : '-' }}</span>
                            <span class="mx-1 text-forest-300">→</span>
                            <span class="font-medium text-forest-800">{{ $end ? $end->format('d M Y') : '-' }}</span>
                        </div>
                        <div class="col-span-2 flex justify-center">
                            <span class="px-3 py-1 text-[9px] font-black uppercase rounded-lg border
                                {{ $res->status == 'ongoing' ? 'text-blue-600 bg-blue-50 border-blue-100' : 'text-forest-600 bg-forest-50 border-forest-100' }}">
                                {{ $res->status == 'checkout' || $res->status == 'done' ? 'Check Out' : ($res->status == 'ongoing' ? 'On Going' : ucfirst($res->status)) }}
                            </span>
                        </div>
                        <div class="col-span-2 flex justify-center" onclick="event.stopPropagation()">
                            <a href="{{ route('reservasi.show', $res->id) }}" title="Detail" class="px-2 py-1 bg-white border border-gray-200 rounded text-[10px] font-bold transition flex items-center justify-center hover:bg-gray-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </div>
                        </div>
                @empty
                    <div class="p-20 text-center text-gray-400 font-medium italic">Belum ada riwayat reservasi.</div>
                @endforelse
            </div>
            @include('components.pagination', ['paginator' => $reservations])
        </main>
    </div>
</body>
</html>
