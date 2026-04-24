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
<body class="bg-[#254117] min-h-screen">
    
<!--logo tengah-->
<div class="flex flex-col justify-center flex-grow py-8 px-6">
    <div class="flex justify-center pt-7 mb-12">
    <img src="{{ asset('gambar/logo_stayease.png') }}" 
         alt="Logo" 
         class="h-12 w-auto object-contain">
</div>
    <div class="bg-white p-8 rounded-[1.25rem] shadow-[0_10px_30px_rgba(15,23,42,0.08)] border border-[#8C6A1A] w-full max-w-[400px] mx-auto">
        <form action="{{ route('resepsionis.login.post') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="text-base font-bold mb-5 uppercase text-[#8C6A1A] tracking-[0.5px]">
                Masuk Ke Akun Anda
            </h2>

            <div class="mb-[1.2rem]">
                <label for="email" class="block text-[0.8rem] font-semibold text-[#8C6A1A] mt-[2px]">
                    Alamat Email
                </label>
                <input id="email" type="email" name="email" required autocomplete="email"
                    class="w-full rounded-[0.6rem] bg-white border border-[#8C6A1A] py-[0.7rem] px-[0.9rem] text-[0.95rem] 
                    text-[#0A0F1C] transition-all duration-200 focus:outline-none focus:border-[#8C6A1A] focus:ring-[3px] focus:ring-[#8C6A1A]/12">
            </div>

            <div class="mb-[1.2rem]">
                <div class="flex justify-between items-center pt-[5px]">
                    <label for="password" class="block text-[0.8rem] font-semibold text-[#8C6A1A]">
                        Kata Sandi
                    </label>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full rounded-[0.6rem] bg-white border border-[#8C6A1A] py-[0.7rem] px-[0.9rem] text-[0.95rem] 
                    text-[#8C6A1A] transition-all duration-200 focus:outline-none focus:border-[#8C6A1A] focus:ring-[3px] focus:ring-[#8C6A1A]/12">
            </div>

            <div class="mb-[1.2rem]">
                <div class="flex items-center gap-2">
                    <input id="remember" type="checkbox" name="remember" 
                           class="w-[14px] h-[14px] cursor-pointer accent-[#8C6A1A]">
                    <label for="remember" class="text-[0.8rem] font-semibold text-[#8C6A1A]">
                        Ingat Saya
                    </label>
                </div>
            </div>

            <div class="mb-[1.2rem]">
                <button type="submit" 
                        class="w-full bg-[#8C6A1A] text-white p-[0.75rem] rounded-[0.6rem] font-semibold 
                               transition-all duration-200 hover:bg-[#254117] active:scale-[0.98]">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>