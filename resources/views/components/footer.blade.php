@extends('layouts.app')

@section('footer-script')
<footer class="bg-white px-12 pt-24 pb-12 border-t border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-16 mb-20">
            <div class="md:col-span-5">
                <a href="#" class="flex items-center gap-2 no-underline mb-8">
                    <div class="w-10 h-10 bg-blue-900 rounded-lg flex items-center justify-center text-sm">🏨</div>
                    <span class="logo-text text-2xl font-bold text-blue-900">LuxeStay</span>
                </a>
                <p class="text-gray-500 text-sm leading-relaxed max-w-sm mb-8">
                    Platform manajemen booking dan reservasi hotel terpercaya. Memberikan pengalaman menginap terbaik sejak 2024.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition">f</a>
                    <a href="#" class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition">in</a>
                    <a href="#" class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition">tw</a>
                </div>
            </div>
            <div class="md:col-span-2 md:col-start-7">
                <h4 class="font-bold text-gray-900 mb-8 uppercase text-xs tracking-widest">Layanan</h4>
                <ul class="space-y-4 text-sm text-gray-500 list-none p-0">
                    <li><a href="#" class="hover:text-blue-600 transition">Reservasi Kamar</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Paket Liburan</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Meeting Room</a></li>
                </ul>
            </div>
            <div class="md:col-span-2">
                <h4 class="font-bold text-gray-900 mb-8 uppercase text-xs tracking-widest">Akun</h4>
                <ul class="space-y-4 text-sm text-gray-500 list-none p-0">
                    <li><a href="/login" class="hover:text-blue-600 transition">Login</a></li>
                    <li><a href="/register" class="hover:text-blue-600 transition">Daftar</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Profil Saya</a></li>
                </ul>
            </div>
            <div class="md:col-span-2">
                <h4 class="font-bold text-gray-900 mb-8 uppercase text-xs tracking-widest">Bantuan</h4>
                <ul class="space-y-4 text-sm text-gray-500 list-none p-0">
                    <li><a href="#" class="hover:text-blue-600 transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">Kontak Kami</a></li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-100 pt-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-xs text-gray-400">
                © 2025 <span class="text-blue-600 font-bold">LuxeStay</span>. Hak cipta dilindungi. Dibuat dengan ❤️ menggunakan Laravel.
            </p>
            <div class="px-5 py-2.5 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-full uppercase tracking-[0.2em] border border-blue-100">
                Laravel × Sistem Booking Hotel
            </div>
        </div>
    </footer>
@endsection