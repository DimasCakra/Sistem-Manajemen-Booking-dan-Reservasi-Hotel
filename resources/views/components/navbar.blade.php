<header class="bg-[#173014] shadow-lg sticky top-0 z-50 px-12 h-20 flex items-center justify-between">
    <a href="/home" class="flex items-center gap-2 no-underline">
        <img src="{{ asset('gambar/logo_stayease.png') }}" alt="Logo" class="h-9 w-auto object-contain mt-2">
    </a>
    <div class="flex items-center gap-4">
        @if(Auth::check())
            <div class="relative group cursor-pointer">
                <div class="flex items-center gap-3 bg-white/5 border border-white/10 py-1.5 px-3 rounded-xl transition hover:bg-white/10">
                    <div class="text-right">
                        <div class="text-white font-bold text-sm uppercase tracking-wide leading-tight">{{ Auth::user()->name }}</div>
                        <div class="text-[#8C6A1A] text-xs font-medium">{{ Auth::user()->username ?? 'User' }}</div>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#8C6A1A] flex items-center justify-center text-white font-bold shadow-inner">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>

                <div class="absolute right-0 pt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right translate-y-2 group-hover:translate-y-0 z-50">
                    <div class="bg-white rounded-xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] border border-gray-100 overflow-hidden">
                        <div class="p-2 space-y-1">
                            <a href="#" class="block px-4 py-2.5 text-sm font-semibold text-gray-600 hover:bg-[#FFF4DE] hover:text-[#8C6A1A] rounded-lg transition-colors">EDIT PROFILE</a>
                            <a href="#" class="block px-4 py-2.5 text-sm font-semibold text-gray-600 hover:bg-[#FFF4DE] hover:text-[#8C6A1A] rounded-lg transition-colors">MY ORDER</a>
                            <a href="#" class="block px-4 py-2.5 text-sm font-semibold text-gray-600 hover:bg-[#FFF4DE] hover:text-[#8C6A1A] rounded-lg transition-colors">MY REVIEW</a>
                            <div class="h-px bg-gray-100 my-1"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm font-bold text-red-600 hover:bg-red-50 rounded-lg transition-colors">LOG OUT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <a href="/login" class="px-6 py-2.5 bg-[#FFF4DE] text-black rounded-lg text-sm font-medium hover:bg-[#8C6A1A] hover:text-white transition flex items-center gap-2">
                <svg class="inline-block mr-1" width="11" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Login
            </a>
            <a href="/register" class="px-6 py-2.5 bg-[#8C6A1A] text-white rounded-lg text-sm font-medium hover:bg-white hover:text-black transition flex items-center gap-2">
                Register
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </a>
        @endif
    </div>
</header>