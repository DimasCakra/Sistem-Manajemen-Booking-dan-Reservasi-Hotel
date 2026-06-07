<header class="bg-[#173014] shadow-lg sticky top-0 z-50 px-12 h-20 flex items-center justify-between">
    <a href="/home" class="flex items-center gap-2 no-underline">
        <img src="{{ asset('gambar/stayease.png') }}" alt="Logo" class="h-9 w-auto object-contain mt-2">
    </a>
    <div class="flex items-center gap-4">
        @if(Auth::check())
            <div class="relative group cursor-pointer">
                <div
                    class="flex items-center gap-3 py-1.5 px-3 rounded-full border border-transparent transition-all duration-300 hover:bg-white/5 hover:border-white/10 cursor-pointer">
                    <div class="relative">
                        @if(Auth::user()->photo)
                            <!-- TAMPILKAN FOTO JIKA USER SUDAH UPLOAD -->
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}"
                                class="w-10 h-10 rounded-full object-cover shadow-lg ring-2 ring-white/10">
                        @else
                            <!-- FALLBACK KEMBALI KE INISIAL HURUF JIKA BELUM ADA FOTO -->
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-[#8C6A1A] to-[#b38b22] flex items-center justify-center text-white font-bold shadow-lg ring-2 ring-white/10">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <!-- INDIKATOR ONLINE -->
                        <div
                            class="absolute bottom-0 -right-0.5 w-3.5 h-3.5 bg-emerald-400 rounded-full border-2 border-[#173014]">
                        </div>
                    </div>
                    <div class="text-left hidden sm:block">
                        <div class="text-white font-semibold text-sm leading-tight tracking-wide">{{ Auth::user()->name }}
                        </div>
                        <div class="text-[#D4AF37] text-[11px] font-medium tracking-wider lowercase mt-0.5">
                            {{ Auth::user()->email }}</div>
                    </div>
                    <svg class="w-4 h-4 text-white/70 ml-2 transition-transform duration-300 group-hover:rotate-180"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>

                <div
                    class="absolute right-0 pt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right translate-y-2 group-hover:translate-y-0 z-50">
                    <div
                        class="bg-white rounded-xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] border border-gray-100 overflow-hidden">
                        <div class="p-2 space-y-1">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2.5 text-sm font-semibold text-gray-600 hover:bg-[#FFF4DE] hover:text-[#8C6A1A] rounded-lg transition-colors">UBAH
                                PROFIL</a>
                            <a href="{{ route('profile.orders') }}"
                                class="block px-4 py-2.5 text-sm font-semibold text-gray-600 hover:bg-[#FFF4DE] hover:text-[#8C6A1A] rounded-lg transition-colors">PESANAN
                                SAYA</a>
                            <a href="{{ route('profile.reviews') }}"
                                class="block px-4 py-2.5 text-sm font-semibold text-gray-600 hover:bg-[#FFF4DE] hover:text-[#8C6A1A] rounded-lg transition-colors">REVIEW
                                SAYA</a>
                            <div class="h-px bg-gray-100 my-1"></div>
                            <form action="{{ route('logoutguest') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2.5 text-sm font-bold text-red-600 hover:bg-red-50 rounded-lg transition-colors">KELUAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <a href="/login"
                class="px-6 py-2.5 bg-[#FFF4DE] text-black rounded-lg text-sm font-medium hover:bg-[#8C6A1A] hover:text-white transition flex items-center gap-2">
                <svg class="inline-block mr-1" width="11" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Masuk
            </a>
            <a href="/register"
                class="px-6 py-2.5 bg-[#8C6A1A] text-white rounded-lg text-sm font-medium hover:bg-white hover:text-black transition flex items-center gap-2">
                Daftar
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </a>
        @endif
    </div>
</header>