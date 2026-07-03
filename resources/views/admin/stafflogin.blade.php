<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Staff</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
    </style>
</head>
<!--background-->
<body class="bg-[#0f1711] min-h-screen relative flex items-center justify-center font-sans">
    <div class="relative z-10 w-full max-w-[420px] px-6">

        <div class="text-center mb-8">
            <img src="{{ asset('gambar/stayease.png') }}" alt="StayEase Logo" class="h-14 mt-4 mx-auto object-contain brightness-0 invert opacity-90">
            <h1 class="mt-3 text-2xl font-light text-white tracking-wide">Login <span class="font-bold text-[#D4AF37]">Admin & Resepsionis</span></h1>
        </div>

        <div class="bg-white/5 backdrop-blur-2xl p-8 sm:p-5 rounded-[2rem] shadow-2xl border border-white/10 relative overflow-hidden">

            <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

            <form action="{{ route('staff.login.post') }}" method="POST" class="space-y-6 relative z-10">
                @csrf

                @if ($errors->any())
                    <div class="p-4 bg-red-500/10 border border-red-500/30 text-red-300 rounded-xl text-sm backdrop-blur-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label for="name" class="block text-[10px] font-bold text-white/60 uppercase tracking-[0.2em] mb-2 ml-1">Nama Akun</label>
                    <input id="name" type="text" name="name" required autocomplete="username" placeholder="Nama Akun Staff"
                        class="w-full rounded-xl bg-white/5 border border-white/10 py-4 px-5 text-white placeholder-white/20
                        transition-all duration-300 focus:outline-none focus:border-[#D4AF37] focus:bg-white/10 focus:ring-4 focus:ring-[#D4AF37]/10">
                </div>

                <div>
                    <label for="password" class="block text-[10px] font-bold text-white/60 uppercase tracking-[0.2em] mb-2 ml-1">Kata Sandi</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
                        class="w-full rounded-xl bg-white/5 border border-white/10 py-4  px-5 text-white placeholder-white/20
                        transition-all duration-300 focus:outline-none focus:border-[#D4AF37] focus:bg-white/10 focus:ring-4 focus:ring-[#D4AF37]/10">
                    <div class="flex items-center mt-2">
                        <input type="checkbox" id="showPassword" class="mr-2">
                        <label for="showPassword" class="text-sm text-gray-600">
                            Lihat Password
                        </label>
                    </div>
                </div>

                <div>
                    <label for="role" class="block text-[10px] font-bold text-white/60 uppercase tracking-[0.2em] mb-2 ml-1">Masuk Sebagai</label>
                    <div class="relative group">
                        <select id="role" name="role" required
                            class="w-full appearance-none rounded-xl bg-white/5 border border-white/10 py-4 px-5 text-white
                            transition-all duration-300 focus:outline-none focus:border-[#D4AF37] focus:bg-white/10 focus:ring-4 focus:ring-[#D4AF37]/10 cursor-pointer">
                            <option value="" disabled selected class="bg-[#1a241c]">Pilih Role</option>
                            <option value="admin" class="bg-[#1a241c]">Administrator</option>
                            <option value="receptionist" class="bg-[#1a241c]">Resepsionis</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-white/40 group-focus-within:text-[#D4AF37]">
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full bg-[#D4AF37] hover:from-[#D4AF37] text-[#0f1711] py-4 rounded-xl font-bold uppercase tracking-[0.2em] text-[11px]
                                   transition-all duration-500 shadow-[0_0_20px_rgba(212,175,55,0.2)] hover:shadow-[0_0_30px_rgba(212,175,55,0.4)] hover:-translate-y-0.5">
                        Masuk
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-3 mb-4">
            <a href="/home" class="text-white/40 hover:text-white text-[15px] uppercase tracking-widest transition-colors duration-300">&larr; Kembali ke Website</a>
        </div>
    </div>

    <script src="{{ asset('js/tamu/liatpw.js') }}"></script>
</body>
</html>
