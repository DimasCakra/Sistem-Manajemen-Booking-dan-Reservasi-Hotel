<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tamu - Resepsionis StayEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
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
        @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        .fade-up { animation: fadeUp .45s ease both; }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex">
    @include('components.sidebar_resepsionis')
    <main class="flex-1 overflow-y-auto px-10 py-10">
        <div class="mb-10 fade-up">
            <a href="{{ route('resepsionis.tamu') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-forest-700 hover:text-forest-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Data Tamu
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-forest-100 p-8 fade-up">
            <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
                <div class="flex-shrink-0">
                    @if($tamu->photo)
                        <img src="{{ asset('storage/' . $tamu->photo) }}" class="w-32 h-32 rounded-3xl object-cover border-4 border-forest-100" alt="Foto Tamu">
                    @else
                        <div class="w-32 h-32 rounded-3xl bg-forest-700 text-white flex items-center justify-center text-4xl font-bold">{{ strtoupper(substr($tamu->name, 0, 1)) }}</div>
                    @endif
                </div>
                <div class="space-y-4">
                    <h1 class="text-3xl font-bold text-forest-900">{{ $tamu->name }}</h1>
                    <p class="text-sm text-slate-600">ID Tamu: <span class="font-semibold text-slate-900">TMU-{{ str_pad($tamu->id, 3, '0', STR_PAD_LEFT) }}</span></p>
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <div class="rounded-3xl border border-slate-200 p-5 bg-slate-50">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Email</p>
                            <p class="mt-2 font-semibold text-slate-900">{{ $tamu->email }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 p-5 bg-slate-50">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">WhatsApp</p>
                            <p class="mt-2 font-semibold text-slate-900">{{ $tamu->whatsapp ?? '-' }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 p-5 bg-slate-50">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">NIK</p>
                            <p class="mt-2 font-semibold text-slate-900">{{ $tamu->nik ?? '-' }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 p-5 bg-slate-50">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Tanggal Lahir</p>
                            <p class="mt-2 font-semibold text-slate-900">{{ $tamu->tanggal_lahir ? \Carbon\Carbon::parse($tamu->tanggal_lahir)->format('d/m/Y') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
