<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - StayEase</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        h1, h2, h3, .font-playfair { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#FDFBF7] min-h-screen flex flex-col">

    @include('components.navbar')

    <main class="flex-grow container mx-auto px-6 pt-12 pb-24 max-w-6xl min-h-[calc(100vh-80px)]">
        <!-- Header -->
        <div class="mb-10">
            <a href="{{ url('/home') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#8C6A1A] transition-colors mb-4 uppercase tracking-widest">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
            <h1 class="text-4xl font-playfair font-bold text-gray-900">Pesanan Saya</h1>
        </div>

        <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="py-5 px-8 text-xs font-bold text-gray-500 uppercase tracking-widest whitespace-nowrap">ID Reference</th>
                            <th class="py-5 px-8 text-xs font-bold text-gray-500 uppercase tracking-widest whitespace-nowrap">Room Type</th>
                            <th class="py-5 px-8 text-xs font-bold text-gray-500 uppercase tracking-widest whitespace-nowrap">Check In-Out Date</th>
                            <th class="py-5 px-8 text-xs font-bold text-gray-500 uppercase tracking-widest whitespace-nowrap">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <!-- Example Row 1 -->
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-6 px-8 whitespace-nowrap">
                                <div class="font-bold text-gray-900">#RES-20260429-01</div>
                                <div class="text-xs text-gray-500 mt-1">Dipesan pada 28 Apr 2026</div>
                            </td>
                            <td class="py-6 px-8 whitespace-nowrap">
                                <div class="font-bold text-gray-800">Deluxe Suite Room</div>
                                <div class="text-sm text-gray-500 mt-1">2 Tamu</div>
                            </td>
                            <td class="py-6 px-8 whitespace-nowrap">
                                <div class="font-medium text-gray-800">30 Apr 2026</div>
                                <div class="text-sm text-gray-500 mt-1">s/d 02 Mei 2026</div>
                            </td>
                            <td class="py-6 px-8 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                    Confirmed
                                </span>
                            </td>
                        </tr>
                        
                        <!-- Example Row 2 -->
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="py-6 px-8 whitespace-nowrap">
                                <div class="font-bold text-gray-900">#RES-20260315-42</div>
                                <div class="text-xs text-gray-500 mt-1">Dipesan pada 10 Mar 2026</div>
                            </td>
                            <td class="py-6 px-8 whitespace-nowrap">
                                <div class="font-bold text-gray-800">Standard Room</div>
                                <div class="text-sm text-gray-500 mt-1">1 Tamu</div>
                            </td>
                            <td class="py-6 px-8 whitespace-nowrap">
                                <div class="font-medium text-gray-800">15 Mar 2026</div>
                                <div class="text-sm text-gray-500 mt-1">s/d 17 Mar 2026</div>
                            </td>
                            <td class="py-6 px-8 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600">
                                    <span class="w-2 h-2 rounded-full bg-gray-400 mr-2"></span>
                                    Completed
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    @include('components.footer')

</body>
</html>
