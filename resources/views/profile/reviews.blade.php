<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Saya - StayEase</title>

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

    <main class="flex-grow container mx-auto px-6 pt-12 pb-24 max-w-5xl min-h-[calc(100vh-80px)]">
        <!-- Header -->
        <div class="mb-10">
            <a href="{{ url('/home') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#8C6A1A] transition-colors mb-4 uppercase tracking-widest">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
            <h1 class="text-4xl font-playfair font-bold text-gray-900">Review Saya</h1>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <!-- Example Review Card 1 -->
            <div class="bg-white p-8 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 flex flex-col md:flex-row gap-8 items-center transition-transform hover:-translate-y-1 duration-300">
                <div class="w-full md:w-1/3">
                    <div class="aspect-video rounded-2xl overflow-hidden bg-gray-100 relative group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?q=80&w=2070&auto=format&fit=crop" alt="Room Image" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300"></div>
                    </div>
                </div>
                <div class="w-full md:w-2/3">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <span class="text-xs font-bold text-[#8C6A1A] uppercase tracking-widest">Selesai pada 17 Mar 2026</span>
                            <h3 class="text-2xl font-playfair font-bold text-gray-900 mt-1">Standard Room</h3>
                        </div>
                        <button class="px-5 py-2.5 bg-white border border-[#173014] text-[#173014] hover:bg-[#173014] hover:text-white rounded-lg font-bold text-sm transition-colors whitespace-nowrap">
                            BERI REVIEW
                        </button>
                    </div>
                    <p class="text-gray-500 text-sm mt-4 leading-relaxed">
                        Bagaimana pengalaman Anda menginap di kamar ini? Bagikan ulasan Anda untuk membantu tamu lain membuat keputusan yang lebih baik.
                    </p>
                </div>
            </div>

            <!-- Example Review Card 2 (Already Reviewed) -->
            <div class="bg-white p-8 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 flex flex-col md:flex-row gap-8 items-start transition-transform hover:-translate-y-1 duration-300">
                <div class="w-full md:w-1/3">
                    <div class="aspect-video rounded-2xl overflow-hidden bg-gray-100 relative group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?q=80&w=1974&auto=format&fit=crop" alt="Room Image" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300"></div>
                    </div>
                </div>
                <div class="w-full md:w-2/3">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <span class="text-xs font-bold text-green-600 uppercase tracking-widest">Telah Direview</span>
                            <h3 class="text-2xl font-playfair font-bold text-gray-900 mt-1">Presidential Suite</h3>
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl mt-4 border border-gray-100">
                        <p class="text-gray-700 italic">"Pelayanan sangat memuaskan, kamarnya bersih dan fasilitasnya lengkap. Sangat direkomendasikan!"</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('components.footer')

</body>
</html>
