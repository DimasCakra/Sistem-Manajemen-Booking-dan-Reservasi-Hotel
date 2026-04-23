<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tamu - StayEase</title>
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
                <h1 class="font-display text-4xl font-bold text-forest-900">Data Tamu</h1>
                <p class="text-forest-500 mt-2 text-sm uppercase tracking-widest font-semibold">Manajemen Data Tamu & Informasi</p>
            </div>
            
            <button class="bg-forest-700 hover:bg-forest-800 text-white px-8 py-4 rounded-md shadow-lg shadow-forest-100 transition-all active:scale-95 flex items-center gap-3 font-bold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                ADD TAMU
            </button>
        </div>

        <div class="bg-white rounded-md shadow-sm border border-forest-100 overflow-hidden fade-up" style="animation-delay: 0.1s">
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead>
                        <tr class="bg-forest-800 text-white text-[11px] uppercase tracking-[0.2em]">
                            <th class="px-8 py-6 font-semibold">Nama Tamu</th>
                            <th class="px-6 py-6 font-semibold">Email</th>
                            <th class="px-6 py-6 font-semibold text-center">WA Number</th>
                            <th class="px-6 py-6 font-semibold text-center">Username</th>
                            <th class="px-6 py-6 font-semibold text-center">Guest ID</th>
                            <th class="px-8 py-6 font-semibold text-center border-l border-forest-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-forest-50/50 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-forest-900">Dimas Cakra</span>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm text-black">dimas.cakra@gmail.com</td>
                            <td class="px-6 py-6 text-center text-sm text-black">0812-3456-7890</td>
                            <td class="px-6 py-6 text-center">
                                <span class="bg-blue-100 text-blue-700 px-5 py-2 rounded-lg text-xs font-semibold">@dimas</span>
                            </td>
                            <td class="px-6 py-6 text-center text-sm text-black">TMU-001</td>
                            <td class="px-8 py-6 border-l border-forest-600/40">
                                <div class="flex justify-center gap-3">
                                    <button class="px-5 py-3 bg-amber-100 text-amber-600 rounded-md hover:bg-amber-100 transition-colors text-[10px] font-bold uppercase tracking-wider">Edit</button>
                                    <button class="px-5 py-3 bg-red-100 text-red-600 rounded-md hover:bg-red-100 transition-colors text-[10px] font-bold uppercase tracking-wider">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-forest-50/50 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-forest-900">Damar Widi</span>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm text-black">damar.w@grandlumina.com</td>
                            <td class="px-6 py-6 text-center text-sm text-black">0899-8877-6655</td>
                            <td class="px-6 py-6 text-center">
                                <span class="bg-blue-100 text-blue-700 px-5 py-2 rounded-lg text-xs font-semibold">@damar_nugroho</span>
                            </td>
                            <td class="px-6 py-6 text-center text-sm text-black">TMU-002</td>
                            <td class="px-8 py-6 border-l border-forest-600/40">
                                <div class="flex justify-center gap-3">
                                    <button class="px-5 py-3 bg-amber-100 text-amber-600 rounded-md hover:bg-amber-100 transition-colors text-[10px] font-bold uppercase tracking-wider">Edit</button>
                                    <button class="px-5 py-3 bg-red-100 text-red-600 rounded-md hover:bg-red-100 transition-colors text-[10px] font-bold uppercase tracking-wider">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-forest-50/50 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-forest-900">Bryan Abisai</span>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-sm text-black">bryan@gmail.com</td>
                            <td class="px-6 py-6 text-center text-sm text-black">0873-4242-0412</td>
                            <td class="px-6 py-6 text-center">
                                <span class="bg-blue-100 text-blue-700 px-5 py-2 rounded-lg text-xs font-semibold">@bryan_abisai</span>
                            </td>
                            <td class="px-6 py-6 text-center text-sm text-black">TMU-003</td>
                            <td class="px-8 py-6 border-l border-forest-600/40">
                                <div class="flex justify-center gap-3">
                                    <button class="px-5 py-3 bg-amber-100 text-amber-600 rounded-md hover:bg-amber-100 transition-colors text-[10px] font-bold uppercase tracking-wider">Edit</button>
                                    <button class="px-5 py-2 bg-red-100 text-red-600 rounded-md hover:bg-red-100 transition-colors text-[10px] font-bold uppercase tracking-wider">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>