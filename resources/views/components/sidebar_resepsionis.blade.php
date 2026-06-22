<!-- Page Loader Overlay -->
<div id="page-loader" class="fixed inset-0 z-[9999] bg-[#173014] flex flex-col items-center justify-center transition-opacity duration-500">
    <div class="relative flex flex-col items-center gap-6">
        <!-- Logo StayEase with elegant pulse animation -->
        <img src="{{ asset('gambar/stayease.png') }}" alt="StayEase Loader" class="h-16 w-auto object-contain brightness-0 invert animate-pulse">
        
        <!-- Loading line progress -->
        <div class="w-32 h-1 bg-white/10 rounded-full overflow-hidden relative">
            <div class="absolute top-0 bottom-0 left-0 w-1/2 bg-[#C4922A] rounded-full animate-loading-bar"></div>
        </div>
    </div>
</div>

<style>
@keyframes loading-bar {
    0% { left: -50%; }
    100% { left: 100%; }
}
.animate-loading-bar {
    animation: loading-bar 1.5s infinite linear;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const loader = document.getElementById('page-loader');
        
        const fadeOutLoader = () => {
            if (loader && !loader.classList.contains('opacity-0')) {
                loader.classList.add('opacity-0');
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500);
            }
        };

        // Fade out on load or after a safety timeout (to prevent loading screen freeze)
        window.addEventListener('load', fadeOutLoader);
        setTimeout(fadeOutLoader, 1200);

        // Handle page show event when loaded from back/forward cache (bfcache)
        window.addEventListener('pageshow', (event) => {
            if (event.persisted) {
                fadeOutLoader();
            }
        });

        // Show loader when navigating to local links
        document.addEventListener('click', (e) => {
            const anchor = e.target.closest('a');
            if (!anchor) return;

            // Skip if navigation is already prevented
            if (e.defaultPrevented) return;

            const href = anchor.getAttribute('href');
            const target = anchor.getAttribute('target');

            // Skip anchor links, target="_blank", external links, javascript/void/mail/tel, button-like behaviors
            if (
                !href || 
                href.startsWith('#') || 
                href.startsWith('javascript:') || 
                href.startsWith('mailto:') || 
                href.startsWith('tel:') || 
                target === '_blank' ||
                e.metaKey || 
                e.ctrlKey || 
                e.shiftKey || 
                e.altKey
            ) {
                return;
            }

            // Check if it's a local link (matches host or starts with /)
            const isLocal = href.startsWith('/') || href.startsWith(window.location.origin);
            if (isLocal) {
                e.preventDefault();
                if (loader) {
                    loader.style.display = 'flex';
                    // Force reflow
                    loader.offsetHeight;
                    loader.classList.remove('opacity-0');
                }
                setTimeout(() => {
                    window.location.href = href;
                }, 300); // 300ms transition time
            }
        });
        
        // Fallback: If page load event has already fired
        if (document.readyState === 'complete') {
            fadeOutLoader();
        }
    });
</script>

<aside class="bg-[#173014] w-72 flex-shrink-0 flex flex-col shadow-2xl z-20">
            <div class="px-8 pt-10 pb-6 fade-up">
                <a href="{{ route('receptionist.index') }}" class="flex items-center gap-2 no-underline">
                    <img src="{{ asset('gambar/stayease.png') }}" alt="Logo" class="h-7 w-auto object-contain mt-2">
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

                <div class="my-2 mx-0 border-t border-white/40"></div>

                <a href="{{ route('resepsionis.tamu') }}"
                    class="flex items-center gap-4 px-4 py-3.5 rounded-md transition-all duration-300 group 
                    {{ request()->routeIs('resepsionis.tamu') ? 'bg-white/15 border border-white/20 text-white' : 'text-white hover:bg-white/15' }}">

                    <span class="w-10 h-10 rounded-lg flex items-center justify-center shadow-inner transition-transform group-hover:scale-110
                        {{ request()->routeIs('resepsionis.tamu') ? 'bg-forest-600' : 'bg-forest-600/50' }}">
                        <svg class="w-5 h-5 text-forest-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
    
                <div class="flex flex-col">
                    <span class="font-body font-semibold text-sm tracking-wide">Kelola Tamu</span>
                    <span class="text-[10px] {{ request()->routeIs('resepsionis.tamu') ? 'text-white' : 'text-forest-300' }} group-hover:text-white">
                        Manajemen Data Tamu
                    </span>
                </div>
                </a>
            </nav>

            <div class="p-4 mt-auto border-t border-white/5 bg-black/10 fade-up">
                <form method="POST" action="{{ route('logoutstaff') }}">
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