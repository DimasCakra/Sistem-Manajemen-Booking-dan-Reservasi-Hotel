<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - StayEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#FFF4DE] min-h-screen text-[#1e293b]">

    @include('components.navbar')

    <main class="max-w-5xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-display font-bold text-[#8C6A1A] mb-8">Riwayat Pesanan Saya</h1>

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="space-y-6">
            @forelse($reservations as $res)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-bold uppercase rounded-full tracking-wider">Selesai</span>
                            <span class="text-sm text-gray-500">ID: #{{ $res->id }}</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $res->room_type }}</h2>
                        <p class="text-gray-600 text-sm mb-4">{{ $res->check_in_out }}</p>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Total Biaya</p>
                                <p class="font-semibold text-gray-900">Rp {{ number_format($res->total_biaya, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Atas Nama</p>
                                <p class="font-semibold text-gray-900">{{ $res->nama_lengkap }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-auto text-center" x-data="{ openReview: false }">
                        @if(array_key_exists($res->id, $reviews))
                            <button disabled class="w-full md:w-auto px-6 py-3 bg-gray-200 text-gray-600 font-bold rounded-xl cursor-not-allowed">
                                Sudah Diulas
                            </button>
                        @else
                            <button @click="openReview = true" class="w-full md:w-auto px-6 py-3 bg-[#8C6A1A] hover:bg-[#6b5014] text-white font-bold rounded-xl transition-colors shadow-lg">
                                Berikan Ulasan
                            </button>

                            <!-- Modal Review -->
                            <div x-show="openReview" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div x-show="openReview" @click="openReview = false" class="fixed inset-0 bg-black/50 transition-opacity" aria-hidden="true"></div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                    
                                    <div x-show="openReview" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                                        <form action="{{ route('profile.review.store', $res->id) }}" method="POST">
                                            @csrf
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <h3 class="text-lg leading-6 font-bold text-gray-900 mb-4" id="modal-title">
                                                    Ulasan Kamar {{ $res->room_type }}
                                                </h3>
                                                
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating (1-5 Bintang)</label>
                                                    <select name="rating" required class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-[#8C6A1A] focus:border-[#8C6A1A]">
                                                        <option value="5">5 Bintang (Sangat Memuaskan)</option>
                                                        <option value="4">4 Bintang (Memuaskan)</option>
                                                        <option value="3">3 Bintang (Cukup)</option>
                                                        <option value="2">2 Bintang (Kurang)</option>
                                                        <option value="1">1 Bintang (Sangat Kurang)</option>
                                                    </select>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Ulasan Anda</label>
                                                    <textarea name="comment" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-[#8C6A1A] focus:border-[#8C6A1A]" placeholder="Ceritakan pengalaman menginap Anda..."></textarea>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-[#8C6A1A] text-base font-medium text-white hover:bg-[#6b5014] sm:ml-3 sm:w-auto sm:text-sm">
                                                    Kirim Ulasan
                                                </button>
                                                <button type="button" @click="openReview = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl shadow-sm p-12 text-center border border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada pesanan</h3>
                    <p class="text-gray-500">Anda belum memiliki riwayat reservasi yang sudah selesai.</p>
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>
