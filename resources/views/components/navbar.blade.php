<header class="bg-[#173014] shadow-lg sticky top-0 z-50 px-12 h-20 flex items-center justify-between">
    <a href="/home" class="flex items-center gap-2 no-underline">
        <img src="{{ asset('gambar/logo_stayease.png') }}" alt="Logo" class="h-9 w-auto object-contain mt-2">
    </a>
    <div class="flex items-center gap-3">
        <a href="/login" class="px-6 py-2.5 bg-white border border-blue-900/20 rounded-lg text-sm font-medium text-white-100 hover:bg-[#8C6A1A] hover:text-white transition">
            <svg class="inline-block mr-1" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            Masuk
        </a>
        <a href="/register" class="px-6 py-2.5 bg-[#8C6A1A] text-white rounded-lg text-sm font-medium hover:bg-white hover:text-black transition flex items-center gap-2">
            Daftar Sekarang
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</header>