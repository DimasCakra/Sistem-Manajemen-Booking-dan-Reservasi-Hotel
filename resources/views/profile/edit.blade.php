<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - StayEase</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FFF4DE; color: #1a1a1a; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        
        .glass-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 15px 40px -10px rgba(0,0,0,0.05);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #2a5a3b 0%, #1e3c28 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, #1e3c28 0%, #14281a 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(30, 60, 40, 0.4);
        }
    </style>
</head>

<body class="antialiased selection:bg-[#2a5a3b] selection:text-white min-h-screen flex flex-col">

    @include('components.navbar')

    <main class="flex-grow max-w-5xl mx-auto px-6 pt-12 pb-24 w-full">

        <!-- Header -->
        <div class="mb-10">
            <a href="{{ url('/home') }}"
                class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#1e3c28] transition-colors mb-4 uppercase tracking-widest">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>

            <h1 class="text-4xl md:text-5xl font-playfair font-bold text-[#1a2f0f]">
                Edit Profil
            </h1>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div
                class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-2xl text-sm font-semibold shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Error Message -->
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-2xl text-sm font-semibold shadow-sm">
                <div class="flex items-center gap-3 mb-2">
                    <i class="fa-solid fa-circle-exclamation text-red-600 text-xl"></i>
                    <span>Ada kesalahan pengisian form:</span>
                </div>
                <ul class="list-disc list-inside pl-8 space-y-1 text-red-700 font-medium">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card -->
        <div class="glass-panel rounded-[2rem] overflow-hidden">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                class="p-10 flex flex-col md:flex-row gap-12">

                @csrf

                <!-- FOTO -->
                <div class="w-full md:w-1/3 flex flex-col items-center">

                    <label for="photo" class="relative group cursor-pointer mb-6 block">

                        @if($user->photo)
                            <img id="profileImagePreview" src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil"
                                class="w-48 h-48 rounded-3xl object-cover shadow-xl border-4 border-white">
                        @else
                            <div id="initialsContainer"
                                class="w-48 h-48 rounded-3xl bg-gradient-to-br from-[#2a5a3b] to-[#1e3c28] flex items-center justify-center text-white text-6xl font-playfair font-bold shadow-xl border-4 border-white">
                                {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                            </div>
                            <img id="profileImagePreview" src="" alt="Foto Profil"
                                class="w-48 h-48 rounded-3xl object-cover shadow-xl border-4 border-white hidden">
                        @endif

                        <!-- Overlay -->
                        <div
                            class="absolute inset-0 bg-black/50 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-sm">
                            <i class="fa-solid fa-camera text-white text-3xl"></i>
                        </div>

                        <!-- Input File -->
                        <input type="file" name="photo" id="photo" class="hidden" accept="image/*">
                    </label>

                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest text-center bg-white px-4 py-2 rounded-full shadow-sm">
                        Klik foto untuk mengubah
                    </p>
                </div>

                <!-- FORM -->
                <div class="w-full md:w-2/3 space-y-6">

                    <!-- Nama & Username -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                                placeholder="Masukkan nama lengkap"
                                class="w-full px-5 py-4 bg-white/60 border border-white rounded-xl focus:bg-white focus:ring-2 focus:ring-[#2a5a3b]/50 focus:border-transparent transition-all outline-none text-gray-800 font-medium shadow-sm">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nomor Identitas</label>
                            <input type="text" name="id_number_display" value="{{ $user->id_type ?? 'NIK' }}: {{ old('id_number', $user->id_number ?? '') }}" readonly
                                placeholder="Nomor Identitas belum diisi"
                                class="w-full px-5 py-4 bg-gray-100/60 border border-gray-200/60 rounded-xl outline-none text-gray-400 font-medium cursor-not-allowed shadow-inner">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                            placeholder="Masukkan email"
                            class="w-full px-5 py-4 bg-white/60 border border-white rounded-xl focus:bg-white focus:ring-2 focus:ring-[#2a5a3b]/50 focus:border-transparent transition-all outline-none text-gray-800 font-medium shadow-sm">
                    </div>

                    <!-- WhatsApp & Tanggal Lahir -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp ?? '') }}"
                                placeholder="Contoh: 08123456789"
                                class="w-full px-5 py-4 bg-white/60 border border-white rounded-xl focus:bg-white focus:ring-2 focus:ring-[#2a5a3b]/50 focus:border-transparent transition-all outline-none text-gray-800 font-medium shadow-sm">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir ?? '') }}"
                                class="w-full px-5 py-4 bg-white/60 border border-white rounded-xl focus:bg-white focus:ring-2 focus:ring-[#2a5a3b]/50 focus:border-transparent transition-all outline-none text-gray-800 font-medium text-gray-600 shadow-sm">
                        </div>
                    </div>

                    <!-- PASSWORD -->
                    <div class="border-t border-gray-100 pt-8 mt-4 space-y-6">
                        <h3 class="text-lg font-playfair font-bold text-[#1a2f0f]">
                            Ganti Password
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Password Baru</label>
                                <input type="password" name="password" placeholder="Minimal 8 karakter"
                                    class="w-full px-5 py-4 bg-white/60 border border-white rounded-xl focus:bg-white focus:ring-2 focus:ring-[#2a5a3b]/50 focus:border-transparent transition-all outline-none text-gray-800 font-medium shadow-sm">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" placeholder="Ulangi password"
                                    class="w-full px-5 py-4 bg-white/60 border border-white rounded-xl focus:bg-white focus:ring-2 focus:ring-[#2a5a3b]/50 focus:border-transparent transition-all outline-none text-gray-800 font-medium shadow-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="pt-8 flex justify-end">
                        <button type="submit"
                            class="btn-gradient px-10 py-4 text-white rounded-xl font-bold uppercase tracking-widest text-xs flex items-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        </button>
                    </div>

                </div>
            </form>
        </div>

    </main>

    @include('components.footer')

    <script>
        document.getElementById('photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImg = document.getElementById('profileImagePreview');
                    const initialsDiv = document.getElementById('initialsContainer');
                    
                    if (previewImg) {
                        previewImg.src = e.target.result;
                        previewImg.classList.remove('hidden');
                    }
                    
                    if (initialsDiv) {
                        initialsDiv.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
```