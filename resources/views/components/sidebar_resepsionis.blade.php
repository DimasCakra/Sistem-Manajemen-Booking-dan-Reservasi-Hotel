<aside class="sidebar-bg w-72 flex-shrink-0 flex flex-col shadow-2xl z-20">
            <div class="px-8 pt-10 pb-6 fade-up">
                <a href="{{ route('receptionist.index') }}" class="flex items-center gap-2 no-underline">
                    <img src="{{ asset('gambar/logo_stayease.png') }}" alt="Logo" class="h-7 w-auto object-contain mt-2">
                </a>
            </div>

            <nav class="flex-1 flex flex-col gap-2 px-4">
                <a href="{{ route('receptionist.index') }}"
                    class="flex items-center gap-4 px-4 py-3.5 rounded-md transition-all duration-300 group 
                    {{ request()->routeIs('receptionist.index') ? 'bg-white/15 border border-white/20 text-white' : 'text-white hover:bg-white/15' }}">
                    
                    <span class="w-10 h-10 rounded-lg flex items-center justify-center shadow-inner transition-transform group-hover:scale-110
                        {{ request()->routeIs('receptionist.index') ? 'bg-forest-600' : 'bg-forest-600/50' }}">
                        <svg class="w-5 h-5 text-forest-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3M16 7V3M4 11h16M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                    
                    <div class="flex flex-col">
                        <span class="font-body font-semibold text-sm tracking-wide">Reservasi</span>
                        <span class="text-[10px] {{ request()->routeIs('receptionist.index') ? 'text-white' : 'text-forest-300' }} group-hover:text-white transition-colors">
                            Kelola tamu hari ini
                        </span>
                    </div>
                </a>

                <div class="my-2 mx-0 border-t border-white/40"></div>

                <a href="{{ route('resepsionis.riwayatreservasi') }}"
                    class="flex items-center gap-4 px-4 py-3.5 rounded-md transition-all duration-300 group 
                    {{ request()->routeIs('resepsionis.riwayatreservasi') ? 'bg-white/15 border border-white/20 text-white' : 'text-white hover:bg-white/15' }}">

                    <span class="w-10 h-10 rounded-lg flex items-center justify-center shadow-inner transition-transform group-hover:scale-110
                        {{ request()->routeIs('resepsionis.riwayatreservasi') ? 'bg-forest-600' : 'bg-forest-600/50' }}">
                        <svg class="w-5 h-5 text-forest-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>

                    <div class="flex flex-col">
                        <span class="font-body font-semibold text-sm tracking-wide">Riwayat Reservasi</span>
                        <span class="text-[10px] {{ request()->routeIs('resepsionis.riwayatreservasi') ? 'text-white' : 'text-forest-300' }} group-hover:text-white transition-colors">
                            Log data transaksi tamu
                        </span>
                    </div>
                </a>
            </nav>

            <div class="p-4 mt-auto border-t border-white/5 bg-black/10 fade-up">
                <form method="POST" action="{{ route('logoutresepsionis') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-4 px-4 py-4 rounded-xl text-red-300 hover:bg-red-500/10 hover:text-red-200 transition-all duration-300 group">
                        <span class="w-10 h-10 rounded-lg bg-red-900/20 flex items-center justify-center group-hover:bg-red-900/40 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </span>
                        <span class="font-body font-bold text-sm tracking-widest uppercase">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>