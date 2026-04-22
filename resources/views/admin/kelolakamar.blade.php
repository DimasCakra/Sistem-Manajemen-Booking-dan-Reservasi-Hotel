<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kamar - Admin Grand Lumina</title>
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
        .sidebar-bg { background: linear-gradient(180deg, #0c220c 0%, #1e4d1e 60%, #2d6a2d 100%); }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex">

    @include('components.sidebar_admin')

    <main class="flex-1 overflow-y-auto px-10 py-10">
        <div class="flex justify-between items-end mb-10 fade-up">
            <div>
                <h1 class="font-display text-4xl font-bold text-forest-900">Kelola Kamar</h1>
                <p class="text-forest-500 mt-2 font-semibold">Manajemen data kamar dan ketersediaan unit.</p>
            </div>
            <button class="bg-forest-700 hover:bg-forest-800 text-white px-8 py-4 rounded-md shadow-lg transition-all active:scale-95 font-bold tracking-wider text-sm">
                + ADD ROOM
            </button>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-forest-100 overflow-hidden fade-up" style="animation-delay: 0.1s">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-forest-800 text-white text-[11px] uppercase tracking-[0.2em]">
                        <th class="px-4 py-5 font-semibold">Room Number</th>
                        <th class="px-6 py-5 font-semibold text-center">Type</th>
                        <th class="px-6 py-5 font-semibold text-center">Price</th>
                        <th class="px-6 py-5 font-semibold text-center">ID Room</th>
                        <th class="px-6 py-5 font-semibold text-center">Status</th>
                        <th class="px-6 py-5 font-semibold">Dekripsi</th>
                        <th class="px-8 py-5 font-semibold text-center border-l border-forest-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-forest-50/50 transition-colors group">
                        <td class="px-8 py-6 font-bold text-black">101</td>
                        <td class="px-6 py-6 text-center text-sm text-black">Deluxe Room</td>
                        <td class="px-6 py-6 text-center text-sm font-semibold text-black">Rp 1.500.000</td>
                        <td class="px-6 py-6 text-center text-sm font-mono text-black uppercase">RM-101</td>
                        <td class="px-6 py-6 text-center">
                            <span class="bg-forest-200 text-forest-700 px-6 py-2 rounded-md text-[10px] font-bold uppercase tracking-wider">Available</span>
                        </td>
                        <td class="px-6 py-6 text-xs text-gray-500 max-w-[200px] truncate">Kamar mewah dengan akses langsung ke balkon dengan pemandangan taman yang indah</td>
                        <td class="px-8 py-6 border-l border-forest-600/40">
                            <div class="flex justify-center gap-3">
                                <button class="px-5 py-3 bg-amber-100 text-amber-600 rounded-md hover:bg-amber-100 transition-colors text-[10px] font-bold">EDIT</button>
                                <button class="px-5 py-3 bg-red-100 text-red-600 rounded-md hover:bg-red-100 transition-colors text-[10px] font-bold">DELETE</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>