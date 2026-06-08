<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tipe Kamar - StayEase</title>
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
        body { font-family: 'DM Sans', sans-serif; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        .fade-up { animation: fadeUp .45s ease both; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex">
    @include('components.sidebar_admin')

    <main class="flex-1 overflow-y-auto px-10 py-10">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6 mb-10 fade-up">
            <div>
                <h1 class="font-display text-4xl font-bold text-forest-900">Kelola Tipe Kamar</h1>
                <p class="text-forest-500 mt-2 font-semibold">Manajemen tipe kamar sekarang pakai modal CRUD seperti halaman kelola kamar.</p>
            </div>
            <button id="openCreateModal" class="bg-forest-700 hover:bg-forest-800 text-white px-8 py-4 rounded-md shadow-lg transition-all active:scale-95 font-bold tracking-wider text-sm">
                + TAMBAH TIPE KAMAR
            </button>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 px-6 py-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-forest-100 overflow-hidden fade-up" style="animation-delay: 0.1s">
            <div class="px-8 py-6 border-b border-gray-100 bg-forest-50">
                <h2 class="font-semibold text-slate-900">Daftar Tipe Kamar</h2>
                <p class="text-slate-500 text-sm mt-1">Jenis tipe kamar yang tersedia beserta harga dan deskripsi.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left min-w-[720px]">
                    <thead>
                        <tr class="bg-forest-800 text-white text-[11px] uppercase tracking-[0.2em]">
                            <th class="px-6 py-5">Nama Tipe</th>
                            <th class="px-6 py-5">Kode</th>
                            <th class="px-6 py-5 text-center">Harga</th>
                            <th class="px-6 py-5">Deskripsi</th>
                            <th class="px-8 py-5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="typeTableBody">
                        @forelse($tipeKamars as $tipe)
                            @php
                                $fotoUrls = collect($tipe->foto_kamar ?? [])->map(fn($foto) => asset('storage/' . $foto))->all();
                            @endphp
                            <tr class="hover:bg-forest-50/50 transition-colors group"
                                data-type-id="{{ $tipe->id_tipe_kamar }}"
                                data-type-name="{{ $tipe->nama_tipe }}"
                                data-type-code="{{ $tipe->kode_tipe }}"
                                data-type-price="{{ $tipe->harga_per_malam }}"
                                data-type-description="{{ e($tipe->deskripsi) }}"
                                data-type-action="{{ route('admin.tipe-kamar.update', $tipe->id_tipe_kamar) }}"
                                data-type-images='@json($fotoUrls)'>
                                <td class="px-6 py-6 font-semibold text-slate-900">{{ $tipe->nama_tipe }}</td>
                                <td class="px-6 py-6 text-slate-700">{{ $tipe->kode_tipe }}</td>
                                <td class="px-6 py-6 text-center text-slate-900">Rp {{ number_format($tipe->harga_per_malam, 0, ',', '.') }}</td>
                                <td class="px-6 py-6 text-sm text-slate-600 max-w-[260px] truncate">{{ $tipe->deskripsi }}</td>
                                <td class="px-8 py-6 border-l border-forest-600/40">
                                    <div class="flex justify-center gap-4">
                                        <button type="button" class="btn-view text-blue-600 hover:text-blue-800" title="Detail Tipe">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                        <button type="button" class="btn-edit text-amber-500 hover:text-amber-700" title="Edit Tipe">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        <form action="{{ route('admin.tipe-kamar.destroy', $tipe->id_tipe_kamar) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-delete text-red-500 hover:text-red-700" title="Hapus Tipe">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500">Belum ada tipe kamar.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="createModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4 py-6">
        <div class="w-full max-w-2xl rounded-3xl bg-white shadow-2xl ring-1 ring-black/5 flex flex-col max-h-[90vh] overflow-hidden">
            <div class="flex items-center justify-between px-8 py-5 border-b border-gray-100 flex-shrink-0">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Tambah Tipe Kamar Baru</h2>
                    <p class="text-sm text-slate-500 mt-0.5">Isi detail tipe kamar, harga, dan foto yang akan digunakan oleh kamar.</p>
                </div>
                <button type="button" class="modal-close text-slate-400 hover:text-slate-600 transition">✕</button>
            </div>
            <form action="{{ route('admin.tipe-kamar.store') }}" method="POST" enctype="multipart/form-data" class="flex-1 overflow-y-auto px-8 py-5 space-y-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Nama Tipe Kamar</label>
                        <input name="nama_tipe" type="text" value="{{ old('nama_tipe') }}" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-forest-500" placeholder="Contoh: Deluxe" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Kode Tipe</label>
                        <input name="kode_tipe" type="text" value="{{ old('kode_tipe') }}" maxlength="3" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm uppercase text-slate-900 outline-none focus:border-forest-500" placeholder="STD" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Harga per Malam</label>
                        <input name="harga_per_malam" type="number" value="{{ old('harga_per_malam') }}" min="0" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-forest-500" placeholder="250000" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="mt-1.5 w-full rounded-2xl border border-slate-200 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-forest-500" placeholder="Deskripsi singkat tipe kamar">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Foto Kamar (2-6 foto)</label>
                    <input type="file" name="foto_kamar[]" multiple accept="image/*" required class="mt-2 w-full text-sm text-slate-900 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-forest-50 file:text-forest-700 hover:file:bg-forest-100" />
                </div>
                <div class="text-sm text-slate-500">Foto akan digunakan di semua kamar dengan tipe ini.</div>
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 sticky bottom-0 bg-white z-10 pb-1">
                    <button type="button" class="modal-close px-6 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-bold text-sm">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-forest-700 text-white font-bold text-sm">Tambah Tipe</button>
                </div>
            </form>
        </div>
    </div>

    <div id="detailModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4 py-6">
        <div class="w-full max-w-2xl rounded-3xl bg-white shadow-2xl ring-1 ring-black/5 flex flex-col max-h-[90vh] overflow-hidden">
            <div class="flex items-center justify-between px-8 py-5 border-b border-gray-200 flex-shrink-0">
                <div>
                    <h2 id="detailModalTitle" class="text-2xl font-bold text-slate-900">Detail Tipe Kamar</h2>
                    <p id="detailModalSubtitle" class="text-sm text-slate-500 mt-0.5">Lihat detail tipe kamar atau perbarui informasi saat ini.</p>
                </div>
                <button type="button" class="modal-close text-slate-400 hover:text-slate-600 transition">✕</button>
            </div>
            <form id="detailModalForm" method="POST" action="" enctype="multipart/form-data" class="flex-1 overflow-y-auto px-8 py-5 space-y-5">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Nama Tipe Kamar</label>
                        <input id="detailTypeName" name="nama_tipe" type="text" class="modal-field mt-1.5 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-900 outline-none" readonly />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Kode Tipe</label>
                        <input id="detailTypeCode" name="kode_tipe" type="text" maxlength="3" class="modal-field mt-1.5 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm uppercase text-slate-900 outline-none" readonly />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Harga per Malam</label>
                        <input id="detailTypePrice" name="harga_per_malam" type="number" min="0" class="modal-field mt-1.5 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-900 outline-none" readonly />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Deskripsi</label>
                        <textarea id="detailTypeDescription" name="deskripsi" rows="4" class="modal-field mt-1.5 w-full rounded-2xl border border-slate-200 px-4 py-2.5 text-sm text-slate-900 outline-none resize-none" readonly></textarea>
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Foto Kamar Saat Ini</label>
                    <div id="detailTypeImageContainer" class="mt-2 grid grid-cols-2 sm:grid-cols-3 gap-3 p-2 bg-slate-50 border border-slate-100 rounded-2xl min-h-[120px] items-center justify-center"></div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Unggah Foto Baru (opsional)</label>
                    <input id="detailTypeImageInput" type="file" name="foto_kamar[]" multiple accept="image/*" class="modal-field mt-2 w-full text-sm text-slate-900 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-forest-50 file:text-forest-700 hover:file:bg-forest-100" disabled />
                </div>
                <div class="text-sm text-slate-500">Unggah ulang foto jika ingin mengganti galeri tipe kamar.</div>
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 sticky bottom-0 bg-white z-10 pb-1">
                    <button type="button" class="modal-close px-6 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-bold text-sm">Tutup</button>
                    <button id="editSaveButton" type="button" class="px-6 py-2.5 rounded-xl bg-blue-600 text-white font-bold text-sm">Edit Tipe</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/admin/tipekamar.js') }}"></script>
</body>
</html>
