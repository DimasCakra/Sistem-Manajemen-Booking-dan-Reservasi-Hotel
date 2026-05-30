<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tamu - Resepsionis StayEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: { 50: '#f0f7f0', 100: '#dceddc', 200: '#b9dbb9', 300: '#8cc28c', 400: '#5fa35f', 500: '#3d843d', 600: '#2d6a2d', 700: '#1e4d1e', 800: '#143614', 900: '#0c220c' },
                    },
                    fontFamily: { display: ['Playfair Display', 'serif'], body: ['DM Sans', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-up {
            animation: fadeUp .45s ease both;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex">

    @include('components.sidebar_resepsionis')

    <main class="flex-1 overflow-y-auto px-10 py-10">
        <div class="flex justify-between items-end mb-10 fade-up">
            <div>
                <h1 class="font-display text-4xl font-bold text-forest-900">Data Tamu</h1>
                <p class="text-forest-500 mt-2 text-sm uppercase tracking-widest font-semibold">Manajemen Data Tamu & Informasi</p>
            </div>
            <button id="openCreateModal" class="bg-forest-700 hover:bg-forest-800 text-white px-8 py-4 rounded-md shadow-lg shadow-forest-100 transition-all active:scale-95 flex items-center gap-3 font-bold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                TAMBAH TAMU
            </button>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-semibold fade-up">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm font-semibold fade-up">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm font-semibold fade-up">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-6 flex flex-col md:flex-row gap-4 items-center justify-between fade-up" style="animation-delay: 0.05s">
            <div class="w-full md:w-96 relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input id="searchTamu" type="text" placeholder="Cari nama atau email tamu..." class="w-full rounded-xl border border-forest-100 bg-white pl-11 pr-4 py-3 text-sm text-slate-900 focus:border-forest-500 focus:ring-4 focus:ring-forest-100 outline-none transition-all shadow-sm" />
            </div>
            <div class="w-full md:w-auto flex items-center gap-3">
                <label for="filterField" class="text-sm font-semibold text-forest-800 whitespace-nowrap">Filter Berdasarkan:</label>
                <select id="filterField" class="rounded-xl border border-forest-100 bg-white px-4 py-3 text-sm text-slate-900 focus:border-forest-500 focus:ring-4 focus:ring-forest-100 outline-none transition-all shadow-sm cursor-pointer font-medium">
                    <option value="nama">Nama Akun</option>
                    <option value="email">Email Akun</option>
                </select>
            </div>
        </div>

        <div class="bg-white rounded-md shadow-sm border border-forest-100 overflow-hidden fade-up" style="animation-delay: 0.1s">
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead>
                        <tr class="bg-forest-800 text-white text-[11px] uppercase tracking-[0.2em]">
                            <th class="px-8 py-6 font-semibold">Foto</th>
                            <th class="px-8 py-6 font-semibold">Nama Tamu</th>
                            <th class="px-6 py-6 font-semibold">Alamat Email</th>
                            <th class="px-6 py-6 font-semibold text-center">No WA</th>
                            <th class="px-6 py-6 font-semibold text-center">Username</th>
                            <th class="px-6 py-6 font-semibold text-center">ID Tamu</th>
                            <th class="px-8 py-6 font-semibold text-center border-l border-forest-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($tamus as $item)
                            <tr class="hover:bg-forest-50/50 transition-colors group tamu-row" data-name="{{ strtolower($item->name) }}" data-email="{{ strtolower($item->email) }}">
                                <td class="px-8 py-6">
                                    @if($item->photo)
                                        <img src="{{ asset('storage/' . $item->photo) }}" class="w-14 h-14 rounded-full object-cover border-2 border-forest-200">
                                    @else
                                        <div class="w-14 h-14 rounded-full bg-forest-700 text-white flex items-center justify-center font-bold text-lg">{{ strtoupper(substr($item->name, 0, 1)) }}</div>
                                    @endif
                                </td>
                                <td class="px-8 py-6"><span class="font-bold text-forest-900">{{ $item->name }}</span></td>
                                <td class="px-6 py-6 text-sm text-black">{{ $item->email }}</td>
                                <td class="px-6 py-6 text-center text-sm text-black">{{ $item->whatsapp ?? '-' }}</td>
                                <td class="px-6 py-6 text-center"><span class="bg-blue-100 text-blue-700 px-5 py-2 rounded-lg text-xs font-semibold">{{ $item->username ?? '-' }}</span></td>
                                <td class="px-6 py-6 text-center text-sm text-black">TMU-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-8 py-6 border-l border-forest-600/40">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('resepsionis.tamu.show', $item->id) }}" class="px-5 py-3 bg-blue-100 text-blue-600 rounded-md hover:bg-blue-200 transition-colors text-[10px] font-bold uppercase tracking-wider">Lihat</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="7" class="px-8 py-10 text-center text-sm text-gray-500 font-semibold">Belum ada data tamu.</td>
                            </tr>
                        @endforelse
                        <tr id="noResultRow" class="hidden">
                            <td colspan="7" class="px-8 py-10 text-center text-sm text-gray-500 font-semibold">Data tamu tidak ditemukan.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="createModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4 py-8">
        <div class="w-full max-w-lg rounded-3xl bg-white shadow-2xl ring-1 ring-black/5 overflow-hidden">
            <div class="flex items-center justify-between px-8 py-6 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Tambah Tamu Baru</h2>
                    <p class="text-sm text-slate-500 mt-1">Daftarkan akun tamu baru.</p>
                </div>
                <button type="button" class="modal-close text-slate-500 hover:text-slate-900">✕</button>
            </div>
            <form action="{{ route('resepsionis.tamu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 px-8 py-6">
                @csrf
                <div class="space-y-4 overflow-y-auto max-h-[60vh] pr-1">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Foto Profil</label>
                        <input name="photo" type="file" accept="image/*" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Nama Lengkap</label>
                        <input name="name" type="text" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm" placeholder="Masukkan nama lengkap" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Alamat Email</label>
                        <input name="email" type="email" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm" placeholder="Contoh: guest@gmail.com" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">No WhatsApp</label>
                        <input name="whatsapp" type="text" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm" placeholder="Contoh: 08123456789" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Tanggal Lahir</label>
                        <input name="tanggal_lahir" type="date" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Username</label>
                        <input name="username" type="text" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm" placeholder="Contoh: guest_123" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Password</label>
                        <input name="password" type="password" required minlength="8" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm" placeholder="Minimal 8 karakter" />
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" class="modal-close px-6 py-3 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200 transition">Batal</button>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-forest-700 text-white font-bold hover:bg-forest-800 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/resepsionis/crudtamu.js') }}"></script>
</body>

</html>