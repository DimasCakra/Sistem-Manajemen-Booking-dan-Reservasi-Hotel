<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
    </style>
</head>
<!--background-->
<body class="bg-[#0f1711] min-h-screen relative flex items-center justify-center font-sans">
    
    <!-- Ambient Background -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute -top-[20%] -right-[10%] w-[50%] h-[50%] bg-[#8C6A1A] rounded-full mix-blend-multiply filter blur-[150px] opacity-20"></div>
        <div class="absolute -bottom-[20%] -left-[10%] w-[50%] h-[50%] bg-[#254117] rounded-full mix-blend-multiply filter blur-[150px] opacity-40"></div>
    </div>

    <div class="relative z-10 w-full max-w-[420px] px-6">
        
        <div class="text-center mb-8">
            <img src="{{ asset('gambar/stayease.png') }}" alt="StayEase Logo" class="h-14 mx-auto object-contain brightness-0 invert opacity-90">
            <h1 class="mt-6 text-2xl font-light text-white tracking-wide">Login <span class="font-bold text-[#D4AF37]">Resepsionis</span></h1>
        </div>

        <div class="bg-white/5 backdrop-blur-2xl p-8 sm:p-10 rounded-[2rem] shadow-2xl border border-white/10 relative overflow-hidden">
            <!-- Inner card subtle glow -->
            <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
            
            <form action="{{ route('resepsionis.login.post') }}" method="POST" class="space-y-6 relative z-10">
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
                    <label for="email" class="block text-[10px] font-bold text-white/60 uppercase tracking-[0.2em] mb-2 ml-1">Alamat Email</label>
                    <input id="email" type="email" name="email" required autocomplete="email" placeholder="resepsionis@stayease.com"
                        class="w-full rounded-xl bg-white/5 border border-white/10 py-4 px-5 text-white placeholder-white/20 
                        transition-all duration-300 focus:outline-none focus:border-[#D4AF37] focus:bg-white/10 focus:ring-4 focus:ring-[#D4AF37]/10">
                </div>

                <div>
                    <label for="password" class="block text-[10px] font-bold text-white/60 uppercase tracking-[0.2em] mb-2 ml-1">Kata Sandi</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
                        class="w-full rounded-xl bg-white/5 border border-white/10 py-4 px-5 text-white placeholder-white/20 
                        transition-all duration-300 focus:outline-none focus:border-[#D4AF37] focus:bg-white/10 focus:ring-4 focus:ring-[#D4AF37]/10">
                </div>

                <div class="flex items-center gap-3 pt-1">
                    <input id="remember" type="checkbox" name="remember" 
                           class="w-4 h-4 rounded border-white/20 bg-white/5 cursor-pointer accent-[#D4AF37]">
                    <label for="remember" class="text-sm font-medium text-white/60 cursor-pointer hover:text-white transition-colors">
                        Ingat sesi saya
                    </label>
                </div>

                <div class="pt-6">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-[#8C6A1A] to-[#D4AF37] hover:from-[#9a761b] hover:to-[#e5bf45] text-[#0f1711] py-4 rounded-xl font-bold uppercase tracking-[0.2em] text-[11px]
                                   transition-all duration-500 shadow-[0_0_20px_rgba(212,175,55,0.2)] hover:shadow-[0_0_30px_rgba(212,175,55,0.4)] hover:-translate-y-0.5">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
        
        <div class="text-center mt-10">
            <a href="/home" class="text-white/40 hover:text-white text-[11px] uppercase tracking-widest transition-colors duration-300">&larr; Kembali ke Website</a>
        </div>
    </div>
</body>
</html>