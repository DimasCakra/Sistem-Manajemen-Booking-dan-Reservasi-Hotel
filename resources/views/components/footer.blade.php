<footer class="bg-[#173014] pt-24 pb-12 border-t border-[#254117] mt-auto">
    <div class="max-w-7xl mx-auto px-12">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-16 mb-20">

            <div class="md:col-span-5">
                <a href="/home" class="flex items-center gap-2 no-underline mb-8">
                    <!-- Added brightness-0 invert to make the logo white for the dark background -->
                    <img src="{{ asset('gambar/logo_stayease.png') }}" alt="StayEase Logo" class="h-12 w-auto object-contain brightness-0 invert opacity-90 hover:opacity-100 transition-opacity">
                </a>
                <p class="text-[#FFF4DE]/70 text-sm leading-relaxed max-w-sm mb-8 font-light">
                    Experience the pinnacle of comfort and impeccable service. 
                    StayEase is your trusted partner for luxury hotel reservations since 2024.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full border border-[#8C6A1A]/30 flex items-center justify-center text-[#8C6A1A] transition-all hover:bg-[#8C6A1A] hover:text-white hover:scale-110">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border border-[#8C6A1A]/30 flex items-center justify-center text-[#8C6A1A] transition-all hover:bg-[#8C6A1A] hover:text-white hover:scale-110">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border border-[#8C6A1A]/30 flex items-center justify-center text-[#8C6A1A] transition-all hover:bg-[#8C6A1A] hover:text-white hover:scale-110">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                    </a>
                </div>
            </div>

            <div class="md:col-span-2 md:col-start-7">
                <h4 class="font-bold text-white mb-8 uppercase text-xs tracking-widest font-serif">
                    Services
                </h4>
                <ul class="space-y-4 text-sm text-[#FFF4DE]/60 list-none p-0">
                    <li><a href="#" class="hover:text-[#8C6A1A] transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#8C6A1A]"></span> Room Reservation</a></li>
                    <li><a href="#" class="hover:text-[#8C6A1A] transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#8C6A1A]"></span> Holiday Packages</a></li>
                    <li><a href="#" class="hover:text-[#8C6A1A] transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#8C6A1A]"></span> Meeting Rooms</a></li>
                    <li><a href="#" class="hover:text-[#8C6A1A] transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#8C6A1A]"></span> Special Offers</a></li>
                </ul>
            </div>

            <div class="md:col-span-2">
                <h4 class="font-bold text-white mb-8 uppercase text-xs tracking-widest font-serif">
                    Account
                </h4>
                <ul class="space-y-4 text-sm text-[#FFF4DE]/60 list-none p-0">
                    <li><a href="/login" class="hover:text-[#8C6A1A] transition-colors">Sign In</a></li>
                    <li><a href="/register" class="hover:text-[#8C6A1A] transition-colors">Create Account</a></li>
                    <li><a href="#" class="hover:text-[#8C6A1A] transition-colors">My Bookings</a></li>
                </ul>
            </div>

            <div class="md:col-span-2">
                <h4 class="font-bold text-white mb-8 uppercase text-xs tracking-widest font-serif">
                    Company
                </h4>
                <ul class="space-y-4 text-sm text-[#FFF4DE]/60 list-none p-0">
                    <li><a href="#" class="hover:text-[#8C6A1A] transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-[#8C6A1A] transition-colors">Contact</a></li>
                    <li><a href="#" class="hover:text-[#8C6A1A] transition-colors">Privacy Policy</a></li>
                </ul>
            </div>

        </div>

        <div class="border-t border-[#254117] pt-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-xs text-[#FFF4DE]/40">
                © {{ date('Y') }} <span class="text-[#8C6A1A] font-bold">StayEase Luxury</span>.
                All rights reserved.
            </p>
            <div class="px-5 py-2.5 bg-[#8C6A1A]/10 text-[#8C6A1A] text-[10px] font-bold rounded-full uppercase tracking-[0.2em] border border-[#8C6A1A]/20">
                Premium Hotel System
            </div>
        </div>
    </div>
</footer>