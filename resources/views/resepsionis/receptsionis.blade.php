<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Resepsionis - StayEase</title>
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

<body class="bg-[#FFF4DE] min-h-screen flex flex-col">

    <div class="flex flex-1 overflow-hidden flex-col md:flex-row">
        {{-- Sidebar --}}
        @include('components.sidebar_resepsionis')

        <main class="flex-1 overflow-y-auto px-4 md:px-8 py-8 w-full bg-[#FFF4DE]">
            {{-- Header --}}
            <div class="mb-6 fade-up">
                <h1 class="font-display text-3xl font-semibold text-forest-900">Dashboard Resepsionis</h1>
                <p class="text-sm text-forest-500 mt-1">Selamat datang kembali. Berikut adalah data reservasi terbaru.</p>
            </div>

            {{-- Table Container --}}
            <div class="bg-white rounded-2xl shadow-sm border border-forest-100 overflow-hidden fade-up">
                <div class="bg-forest-800 px-6 py-4 flex items-center justify-between">
                    <h2 class="font-display text-white font-semibold text-base tracking-wide">Daftar Reservasi</h2>
                    <span class="text-forest-300 text-xs">{{ now()->translatedFormat('d F Y') }}</span>
                </div>

                <div class="overflow-x-auto">
                    <div class="min-w-[800px]">
                        {{-- Kolom Judul --}}
                <div class="grid grid-cols-12 gap-4 px-6 py-3 bg-forest-50 border-b border-forest-100 text-forest-600 text-[10px] font-semibold uppercase tracking-widest">
                    <div class="col-span-1">#</div>
                    <div class="col-span-3">Nama Tamu</div>
                    <div class="col-span-2 text-center">Tipe Kamar</div>
                    <div class="col-span-4 text-center">Check-in / Out</div>
                    <div class="col-span-2 text-center">Status</div>
                </div>

                @foreach($reservations as $index => $reservation)
                <a href="{{ route('verifikasitamu', $reservation->id) }}" class="reservation-row grid grid-cols-12 gap-4 px-6 py-4 border-b border-gray-100 items-center cursor-pointer block">
                    <div class="col-span-1 text-gray-400 text-sm">{{ $reservation->id }}</div>
                    <div class="col-span-3">
                        <p class="font-medium text-forest-900 text-sm">{{ $reservation->nama_lengkap }}</p>
                        <p class="text-gray-400 text-[11px]">{{ $reservation->email }}</p>
                    </div>
                    <div class="col-span-2 text-center text-sm text-gray-600">{{ $reservation->room_type }}</div>
                    <div class="col-span-4 text-center text-xs text-gray-600">
                        @php
                            $dates = explode(' to ', $reservation->check_in_out);
                            $checkin = isset($dates[0]) ? \Carbon\Carbon::parse($dates[0])->format('d M') : '-';
                            $checkout = isset($dates[1]) ? \Carbon\Carbon::parse($dates[1])->format('d M') : '-';
                        @endphp
                        <span class="font-medium text-forest-800">{{ $checkin }}</span>
                        <span class="mx-1 text-gray-300">→</span>
                        <span class="font-medium text-forest-800">{{ $checkout }}</span>
                    </div>
                    <div class="col-span-2 flex justify-center">
                        <span class="text-amber-600 bg-amber-50 px-2 py-1 rounded text-[10px] font-bold uppercase">{{ $reservation->status }}</span>
                    </div>
                </a>
                @endforeach
                    </div>
                </div>

            </div>
            @include('components.pagination', ['paginator' => $reservations])
        </main>
    </div>

</body>
</html>
