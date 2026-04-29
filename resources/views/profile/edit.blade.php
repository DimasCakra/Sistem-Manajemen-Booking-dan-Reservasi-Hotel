<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - StayEase</title>

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
            <h1 class="text-4xl font-playfair font-bold text-gray-900">Edit Profil</h1>
        </div>

        <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-10 flex flex-col md:flex-row gap-12">
                @csrf
                
                <!-- Photo Section -->
                <div class="w-full md:w-1/3 flex flex-col items-center">
                    <div class="relative group cursor-pointer mb-6">
                        <div class="w-48 h-48 rounded-2xl bg-gradient-to-br from-[#8C6A1A] to-[#b38b22] flex items-center justify-center text-white text-6xl font-bold shadow-xl overflow-hidden ring-4 ring-white">
                            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="absolute inset-0 bg-black/40 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider text-center">Klik foto untuk mengubah</p>
                </div>

                <!-- Form Fields -->
                <div class="w-full md:w-2/3 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ $user->name ?? '' }}" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#8C6A1A] focus:border-transparent transition-all outline-none text-gray-800 font-medium" placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Username</label>
                            <input type="text" name="username" value="{{ $user->username ?? '' }}" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#8C6A1A] focus:border-transparent transition-all outline-none text-gray-800 font-medium" placeholder="Masukkan username">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Email</label>
                        <input type="email" name="email" value="{{ $user->email ?? '' }}" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#8C6A1A] focus:border-transparent transition-all outline-none text-gray-800 font-medium" placeholder="Masukkan email">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                            <input type="text" name="phone" value="{{ $user->phone ?? '' }}" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#8C6A1A] focus:border-transparent transition-all outline-none text-gray-800 font-medium" placeholder="Contoh: 08123456789">
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Tanggal Lahir</label>
                            <input type="date" name="birthday" value="{{ $user->birthday ?? '' }}" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#8C6A1A] focus:border-transparent transition-all outline-none text-gray-800 font-medium text-gray-500">
                        </div>
                    </div>

                    <div class="pt-6 flex justify-end">
                        <button type="submit" class="px-8 py-4 bg-[#173014] hover:bg-[#254117] text-white rounded-xl font-bold tracking-wide shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                            SIMPAN PERUBAHAN
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    @include('components.footer')

</body>
</html>
