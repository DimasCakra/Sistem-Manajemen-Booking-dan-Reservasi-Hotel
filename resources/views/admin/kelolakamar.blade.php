<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kamar - StayEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght=600;700&family=DM+Sans:wght=400;500;600&display=swap" rel="stylesheet">
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

    @include('components.sidebar_admin')

    <main class="flex-1 overflow-y-auto px-10 py-10">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6 mb-10 fade-up">
            <div>
                <h1 class="font-display text-4xl font-bold text-forest-900">Kelola Kamar</h1>
                <p class="text-forest-500 mt-2 font-semibold">Manajemen data kamar dan ketersediaan unit.</p>
            </div>
            <button id="openCreateModal" class="bg-forest-700 hover:bg-forest-800 text-white px-8 py-4 rounded-md shadow-lg transition-all active:scale-95 font-bold tracking-wider text-sm">
                + TAMBAH KAMAR
            </button>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 px-6 py-4">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 px-6 py-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="searchFilterForm" method="GET" action="{{ route('admin.kamar') }}" class="mb-6 flex flex-col md:flex-row gap-4 items-center justify-between fade-up" style="animation-delay: 0.05s">
            <div class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input name="search" type="text" id="searchInput" value="{{ old('search', $search ?? '') }}" class="w-full pl-10 pr-4 py-3 bg-white border border-forest-100 rounded-xl text-sm focus:border-forest-500 focus:ring-4 focus:ring-forest-100 outline-none transition-all text-slate-900" placeholder="Cari nomor atau tipe kamar..." />
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <select name="type" id="filterType" class="w-full md:w-44 px-4 py-3 bg-white border border-forest-100 rounded-xl text-sm focus:border-forest-500 outline-none text-slate-700 font-medium cursor-pointer">
                    <option value="">Semua Tipe</option>
                    <option value="Kamar Deluxe" {{ (isset($type) && $type === 'Kamar Deluxe') ? 'selected' : '' }}>Kamar Deluxe</option>
                    <option value="Kamar Superior" {{ (isset($type) && $type === 'Kamar Superior') ? 'selected' : '' }}>Kamar Superior</option>
                    <option value="Kamar Suite" {{ (isset($type) && $type === 'Kamar Suite') ? 'selected' : '' }}>Kamar Suite</option>
                </select>
                <select name="status" id="filterStatus" class="w-full md:w-44 px-4 py-3 bg-white border border-forest-100 rounded-xl text-sm focus:border-forest-500 outline-none text-slate-700 font-medium cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ (isset($status) && $status === 'tersedia') ? 'selected' : '' }}>Tersedia</option>
                    <option value="terisi" {{ (isset($status) && $status === 'terisi') ? 'selected' : '' }}>Terisi</option>
                </select>
            </div>
        </form>

        <div class="bg-white rounded-xl shadow-sm border border-forest-100 overflow-hidden fade-up" style="animation-delay: 0.1s">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-forest-800 text-white text-[11px] uppercase tracking-[0.2em]">
                        <th class="px-8 py-5 font-semibold">Nomor Kamar</th>
                        <th class="px-6 py-5 font-semibold text-center">Tipe Kamar</th>
                        <th class="px-6 py-5 font-semibold text-center">Harga</th>
                        <th class="px-6 py-5 font-semibold text-center">ID Kamar</th>
                        <th class="px-6 py-5 font-semibold text-center">Status</th>
                        <th class="px-6 py-5 font-semibold">Deskripsi</th>
                        <th class="px-8 py-5 font-semibold text-center border-l border-forest-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="roomTableBody">
                    @forelse($kamars as $kamar)
                        <tr class="hover:bg-forest-50/50 transition-colors group" data-room-id="{{ $kamar->id_kamar }}" data-room-number="{{ $kamar->no_kamar }}" data-room-type="{{ $kamar->tipe_kamar }}" data-price="Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}" data-room-status="{{ $kamar->status_kamar }}" data-room-description="{{ $kamar->deskripsi }}" data-room-image="https://via.placeholder.com/640x360">
                            <td class="px-8 py-6 font-bold text-black">{{ $kamar->no_kamar }}</td>
                            <td class="px-6 py-6 text-center text-sm text-black">{{ $kamar->tipe_kamar }}</td>
                            <td class="px-6 py-6 text-center text-sm font-semibold text-black">Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</td>
                            <td class="px-6 py-6 text-center text-sm font-mono text-black uppercase">RM-{{ $kamar->id_kamar }}</td>
                            <td class="px-6 py-6 text-center">
                                <span class="{{ $kamar->status_kamar === 'tersedia' ? 'bg-forest-200 text-forest-700' : 'bg-red-100 text-red-600' }} px-6 py-2 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                    {{ ucfirst($kamar->status_kamar) }}
                                </span>
                            </td>
                            <td class="px-6 py-6 text-xs text-gray-500 max-w-[200px] truncate">{{ $kamar->deskripsi }}</td>
                            <td class="px-8 py-6 border-l border-forest-600/40">
                                <div class="flex justify-center gap-4">
                                    <button type="button" class="btn-view text-blue-600 hover:text-blue-800 transition-transform" title="Detail Kamar">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn-edit text-amber-500 hover:text-amber-700 transition-transform" title="Edit Kamar">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.kamar.destroy', $kamar->id_kamar) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-delete text-red-500 hover:text-red-700 transition-transform" title="Hapus Kamar">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-8 py-12 text-center text-sm text-slate-500">Tidak ada kamar ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <div id="createModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4 py-8">
        <div class="w-full max-w-2xl rounded-3xl bg-white shadow-2xl ring-1 ring-black/5 overflow-hidden">
            <div class="flex items-center justify-between px-8 py-6 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Tambah Kamar Baru</h2>
                    <p class="text-sm text-slate-500 mt-1">Isi data kamar baru dan tekan Create di bawah.</p>
                </div>
                <button type="button" class="modal-close text-slate-500 hover:text-slate-900" aria-label="Tutup">✕</button>
            </div>
            <form action="{{ route('admin.kamar.store') }}" method="POST" class="space-y-6 px-8 py-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">No Kamar</label>
                        <input name="no_kamar" type="text" value="{{ old('no_kamar') }}" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 focus:border-forest-500 focus:ring-4 focus:ring-forest-100 outline-none" placeholder="Masukkan nomor kamar" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Tipe Kamar</label>
                        <input name="tipe_kamar" type="text" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 focus:border-forest-500 focus:ring-4 focus:ring-forest-100 outline-none" placeholder="Contoh: Kamar Deluxe" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Status</label>
                        <select name="status_kamar" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 focus:border-forest-500 focus:ring-4 focus:ring-forest-100 outline-none">
                            <option value="">Pilih status kamar</option>
                            <option value="tersedia" {{ old('status_kamar') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="terisi" {{ old('status_kamar') === 'terisi' ? 'selected' : '' }}>Terisi</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Harga</label>
                        <input name="harga_per_malam" type="number" min="0" value="{{ old('harga_per_malam') }}" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 focus:border-forest-500 focus:ring-4 focus:ring-forest-100 outline-none" placeholder="Masukkan harga" />
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-900 focus:border-forest-500 focus:ring-4 focus:ring-forest-100 outline-none" placeholder="Tuliskan detail kamar...">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" class="modal-close px-6 py-3 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200 transition">Batal</button>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-forest-700 text-white font-bold hover:bg-forest-800 transition">Create</button>
                </div>
            </form>
        </div>
    </div>

    <div id="detailModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4 py-8">
        <div class="w-full max-w-2xl rounded-3xl bg-white shadow-2xl ring-1 ring-black/5 overflow-hidden">
            <div class="flex items-center justify-between px-8 py-6 border-b border-gray-200">
                <div>
                    <h2 id="detailModalTitle" class="text-2xl font-bold text-slate-900">Detail Kamar</h2>
                    <p id="detailModalSubtitle" class="text-sm text-slate-500 mt-1">Lihat detail atau edit data kamar.</p>
                </div>
                <button type="button" class="modal-close text-slate-500 hover:text-slate-900" aria-label="Tutup">✕</button>
            </div>
            <form id="detailModalForm" method="POST" action="" class="px-8 py-6 space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">No Kamar</label>
                        <input id="detailRoomNumber" name="no_kamar" type="text" class="modal-field mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 outline-none" readonly />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Tipe Kamar</label>
                        <input id="detailRoomType" name="tipe_kamar" type="text" class="modal-field mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 outline-none" readonly />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Harga</label>
                        <input id="detailRoomPrice" name="harga_per_malam" type="text" class="modal-field mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 outline-none" readonly />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">ID Kamar</label>
                        <input id="detailRoomCode" type="text" class="modal-field mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 outline-none" readonly />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Status</label>
                        <select id="detailRoomStatus" name="status_kamar" class="modal-field mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 outline-none" disabled>
                            <option value="tersedia">Tersedia</option>
                            <option value="terisi">Terisi</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-slate-700">Deskripsi</label>
                        <textarea id="detailRoomDescription" name="deskripsi" rows="4" class="modal-field mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-900 outline-none" readonly></textarea>
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Foto</label>
                    <img id="detailRoomImage" class="mt-3 w-full rounded-3xl border border-slate-200 object-cover max-h-72" src="https://via.placeholder.com/640x360" alt="Foto Kamar" />
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" class="modal-close px-6 py-3 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200 transition">Tutup</button>
                    <button id="editSaveButton" type="button" class="px-6 py-3 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition">Edit Kamar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/admin/kelolakamar.js') }}"></script>
</body>
</html>
