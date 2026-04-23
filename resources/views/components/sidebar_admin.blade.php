<aside class="sidebar-bg w-72 flex-shrink-0 flex flex-col shadow-2xl z-20">
    <div class="px-8 pt-10 pb-6 fade-up">
        <a href="{{ route('admin.kamar') }}" class="flex items-center gap-2 no-underline">
            <img src="{{ asset('gambar/logo_stayease.png') }}" alt="Logo" class="h-7 w-auto object-contain mt-2">
        </a>
    </div>

    <nav class="flex-1 flex flex-col px-4">
        <a href="{{ route('admin.kamar') }}"
            class="flex items-center gap-4 px-4 py-3.5 rounded-md transition-all duration-300 group 
            {{ request()->routeIs('admin.kamar') ? 'bg-white/15 border border-white/20 text-white' : 'text-white hover:bg-white/15' }}">
            
            <span class="w-10 h-10 rounded-lg flex items-center justify-center shadow-inner transition-transform group-hover:scale-110
                {{ request()->routeIs('admin.kamar') ? 'bg-forest-600' : 'bg-forest-600/50' }}">
                <svg class="w-5 h-5 text-forest-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </span>
            
            <div class="flex flex-col">
                <span class="font-body font-semibold text-sm tracking-wide">Kelola Kamar</span>
                <span class="text-[10px] {{ request()->routeIs('admin.kamar') ? 'text-white' : 'text-forest-300' }} group-hover:text-white">
                    Manajemen Kamar
                </span>
            </div>
        </a>

        <div class="my-2 mx-0 border-t border-white/40"></div>

        <a href="{{ route('admin.resepsionis') }}"
            class="flex items-center gap-4 px-4 py-3.5 rounded-md transition-all duration-300 group 
            {{ request()->routeIs('admin.resepsionis') ? 'bg-white/15 border border-white/20 text-white' : 'text-white hover:bg-white/15' }}">

            <span class="w-10 h-10 rounded-lg flex items-center justify-center shadow-inner transition-transform group-hover:scale-110
                {{ request()->routeIs('admin.resepsionis') ? 'bg-forest-600' : 'bg-forest-600/50' }}">
                <svg class="w-5 h-5 text-forest-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </span>

            <div class="flex flex-col">
                <span class="font-body font-semibold text-sm tracking-wide">Kelola Resepsionis</span>
                <span class="text-[10px] {{ request()->routeIs('admin.resepsionis') ? 'text-white' : 'text-forest-300' }} group-hover:text-white">
                    Manajemen Data Resepsionis
                </span>
            </div>
        </a>

        <div class="my-2 mx-0 border-t border-white/40"></div>

        <a href="{{ route('admin.tamu') }}"
            class="flex items-center gap-4 px-4 py-3.5 rounded-md transition-all duration-300 group 
            {{ request()->routeIs('admin.tamu') ? 'bg-white/15 border border-white/20 text-white' : 'text-white hover:bg-white/15' }}">

            <span class="w-10 h-10 rounded-lg flex items-center justify-center shadow-inner transition-transform group-hover:scale-110
                {{ request()->routeIs('admin.tamu') ? 'bg-forest-600' : 'bg-forest-600/50' }}">
                <svg class="w-5 h-5 text-forest-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </span>

            <div class="flex flex-col">
                <span class="font-body font-semibold text-sm tracking-wide">Kelola Tamu</span>
                <span class="text-[10px] {{ request()->routeIs('admin.tamu') ? 'text-white' : 'text-forest-300' }} group-hover:text-white">
                    Manajemen Data Tamu
                </span>
            </div>
        </a>
    </nav>

    <div class="p-4 mt-auto border-t border-white/5 bg-black/10 fade-up">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-4 px-4 py-4 rounded-xl text-red-300 hover:bg-red-500/10 hover:text-red-200 transition-all duration-300 group">
                <span class="w-10 h-10 rounded-lg bg-red-900/20 flex items-center justify-center group-hover:bg-red-900/40 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </span>
                <span class="font-body font-bold text-sm tracking-widest uppercase">Log Out</span>
            </button>
        </form>
    </div>
</aside>