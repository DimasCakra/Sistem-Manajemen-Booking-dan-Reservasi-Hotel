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
                <p class="text-forest-500 mt-2 font-semibold">Manajemen master template data untuk tipe, harga, dan fasilitas kamar.</p>
            </div>
            <button id="openCreateModal" class="bg-forest-700 hover:bg-forest-800 text-white px-8 py-4 rounded-md shadow-lg transition-all active:scale-95 font-bold tracking-wider text-sm">
                + TAMBAH TIPE KAMAR
            </button>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 fade-up">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 px-6 py-4 fade-up">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-forest-100 overflow-hidden fade-up" style="animation-delay: 0.1s">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-forest-800 text-white text-[11px] uppercase tracking-[0.2em]">
                        <th class="px-8 py-5 font-semibold">Nama Tipe</th>
                        <th class="px-6 py-5 font-semibold text-center">Harga / Malam</th>
                        <th class="px-8 py-5 font-semibold">Deskripsi Fasilitas</th>
                        <th class="px-8 py-5 font-semibold text-center border-l border-forest-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="typeTableBody">
                    @forelse($tipeKamars as $tipe)
                        @php
                            $fotos = json_decode($tipe->foto_kamar, true) ?? [];
                            $fotoUrls = array_map(fn($f) => asset('storage/' . $f), $fotos);
                        @endphp
                        <tr class="hover:bg-forest-50/50 transition-colors group"
                            data-id="{{ $tipe->id_tipe_kamar }}"
                            data-name="{{ $tipe->nama_tipe }}"
                            data-price="{{ $tipe->harga_per_malam }}"
                            data-description="{{ $tipe->deskripsi }}"
                            data-images="{{ json_encode($fotoUrls) }}">
                            <td class="px-8 py-6 font-bold text-black">{{ $tipe->nama_tipe }}</td>
                            <td class="px-6 py-6 text-center text-sm font-semibold text-black">Rp {{ number_format($tipe->harga_per_malam, 0, ',', '.') }}</td>
                            <td class="px-8 py-6 text-xs text-gray-500 max-w-[300px] truncate">{{ $tipe->deskripsi }}</td>
                            <td class="px-8 py-6 border-l border-forest-600/40">
                                <div class="flex justify-center gap-4">
                                    <button type="button" class="btn-edit text-amber-500 hover:text-amber-700" title="Edit Tipe Kamar">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <form action="{{ route('admin.tipekamar.destroy', $tipe->id_tipe_kamar) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Peringatan! Menghapus master tipe ini juga akan menghapus semua unit kamar yang terhubung!')" class="text-red-500 hover:text-red-700" title="Hapus Tipe Kamar">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-8 py-12 text-center text-sm text-slate-500">Belum ada data tipe kamar master.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <div id="typeModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4 py-6">
        <div class="w-full max-w-xl rounded-3xl bg-white shadow-2xl flex flex-col max-h-[90vh] overflow-hidden">
            <div class="flex items-center justify-between px-8 py-5 border-b border-gray-100 flex-shrink-0">
                <h2 id="modalTitle" class="text-2xl font-bold text-slate-900">Tambah Tipe Kamar</h2>
                <button type="button" class="modal-close text-slate-400 hover:text-slate-600">✕</button>
            </div>

            <form id="modalForm" action="{{ route('admin.tipekamar.store') }}" method="POST" enctype="multipart/form-data" class="flex-1 overflow-y-auto px-8 py-5 space-y-5">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-2">
                        <label class="text-sm font-semibold text-slate-700">Nama Tipe Kamar</label>
                        <input id="typeName" name="nama_tipe" type="text" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-forest-500" placeholder="Contoh: Standard Room" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Kode Tipe</label>
                        <input id="typeCode" name="kode_tipe" type="text" maxlength="3" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-forest-500 uppercase" placeholder="STD" />
                    </div>
                </div>

                <div>
                    <label class="text-sm font-semibold text-slate-700">Harga Per Malam (Rp)</label>
                    <input id="typePrice" name="harga_per_malam" type="number" min="0" required class="mt-1.5 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-900 outline-none focus:border-forest-500" placeholder="Masukkan nominal angka saja" />
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Rincian Deskripsi & Fasilitas</label>
                    <textarea id="typeDescription" name="deskripsi" rows="4" required class="mt-1.5 w-full rounded-2xl border border-slate-200 px-4 py-2.5 text-sm text-slate-900 outline-none resize-none focus:border-forest-500" placeholder="Contoh: 1 King Bed, Free Wi-Fi, Breakfast, City View, Bathtub..."></textarea>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Unggah Galeri Foto Kamar (Maks 5 File)</label>
                    <input name="foto_kamar[]" type="file" accept="image/*" multiple class="mt-1.5 w-full text-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-forest-50 file:text-forest-700 hover:file:bg-forest-100" />
                </div>

                <div id="imagePreviewContainer" class="grid grid-cols-3 gap-2 hidden p-2 bg-gray-50 border border-gray-100 rounded-xl"></div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 sticky bottom-0 bg-white">
                    <button type="button" class="modal-close px-6 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-bold text-sm">Batal</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-forest-700 text-white font-bold text-sm shadow-md shadow-forest-200 hover:bg-forest-800">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/admin/tipekamar.js') }}"></script>
</body>
</html>
