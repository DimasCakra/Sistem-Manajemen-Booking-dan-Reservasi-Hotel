<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Saya - StayEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#FFF4DE] min-h-screen text-[#1e293b]">

    @include('components.navbar')

    <main class="max-w-5xl mx-auto px-6 py-10">
        <a href="{{ url('/home') }}"class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#8C6A1A] transition-colors mb-4 uppercase tracking-widest">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
        <h1 class="text-3xl font-display font-bold text-[#8C6A1A] mb-8">Ulasan Saya</h1>

        <div class="grid grid-cols-1 gap-6">
            @forelse($reviews as $review)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ $review->room_type }}</h2>
                            <p class="text-sm text-gray-500">Dibuat pada {{ $review->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                        <div class="flex items-center gap-1 bg-[#FFF4DE] px-3 py-1 rounded-full">
                            <span class="font-bold text-[#8C6A1A]">{{ $review->rating }}.0</span>
                            <svg class="w-4 h-4 text-[#8C6A1A]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"{{ $review->comment }}"</p>
                </div>
            @empty
                <div class="bg-white rounded-2xl shadow-sm p-12 text-center border border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada ulasan</h3>
                    <p class="text-gray-500">Anda belum memberikan ulasan apapun.</p>
                    <a href="{{ route('profile.orders') }}" class="inline-block mt-4 text-[#8C6A1A] font-bold hover:underline">Lihat Pesanan Saya</a>
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>
