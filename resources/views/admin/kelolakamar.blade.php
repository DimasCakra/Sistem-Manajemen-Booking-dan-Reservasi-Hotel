<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kamar - StayEase</title>
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

        <div class="bg-white rounded-xl shadow-sm border border-forest-100 overflow-hidden fade-up" style="animation-delay: 0.1s">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-forest-800 text-white text-[11px] uppercase tracking-[0.2em]">
                        <th class="px-4 py-5 font-semibold">Nomor Kamar</th>
                        <th class="px-6 py-5 font-semibold text-center">Tipe Kamar</th>
                        <th class="px-6 py-5 font-semibold text-center">Harga</th>
                        <th class="px-6 py-5 font-semibold text-center">ID Kamar</th>
                        <th class="px-6 py-5 font-semibold text-center">Status</th>
                        <th class="px-6 py-5 font-semibold">Deskripsi</th>
                        <th class="px-8 py-5 font-semibold text-center border-l border-forest-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="roomTableBody">
                    <tr class="hover:bg-forest-50/50 transition-colors group" data-room-id="101" data-room-number="101" data-room-type="Kamar Deluxe" data-price="Rp 1.500.000" data-room-code="RM-101" data-room-status="Tersedia" data-room-description="Kamar mewah dengan akses langsung ke balkon dengan pemandangan taman yang indah" data-room-image="https://via.placeholder.com/640x360">
                        <td class="px-8 py-6 font-bold text-black">101</td>
                        <td class="px-6 py-6 text-center text-sm text-black">Kamar Deluxe</td>
                        <td class="px-6 py-6 text-center text-sm font-semibold text-black">Rp 1.500.000</td>
                        <td class="px-6 py-6 text-center text-sm font-mono text-black uppercase">RM-101</td>
                        <td class="px-6 py-6 text-center">
                            <span class="bg-forest-200 text-forest-700 px-6 py-2 rounded-md text-[10px] font-bold uppercase tracking-wider">Tersedia</span>
                        </td>
                        <td class="px-6 py-6 text-xs text-gray-500 max-w-[200px] truncate">Kamar mewah dengan akses langsung ke balkon dengan pemandangan taman yang indah</td>
                        <td class="px-8 py-6 border-l border-forest-600/40">
                            <div class="flex flex-col sm:flex-row justify-center gap-3">
                                <button type="button" class="btn-view px-5 py-3 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-100 transition-colors text-[10px] font-bold">DETAIL</button>
                                <button type="button" class="btn-edit px-5 py-3 bg-amber-100 text-amber-600 rounded-md hover:bg-amber-100 transition-colors text-[10px] font-bold">EDIT</button>
                                <button type="button" class="btn-delete px-5 py-3 bg-red-100 text-red-600 rounded-md hover:bg-red-100 transition-colors text-[10px] font-bold">HAPUS</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Create Modal -->
    <div id="createModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4 py-8">
        <div class="w-full max-w-2xl rounded-3xl bg-white shadow-2xl ring-1 ring-black/5 overflow-hidden">
            <div class="flex items-center justify-between px-8 py-6 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Tambah Kamar Baru</h2>
                    <p class="text-sm text-slate-500 mt-1">Isi data kamar baru dan tekan Create di bawah.</p>
                </div>
                <button type="button" class="modal-close text-slate-500 hover:text-slate-900" aria-label="Tutup">✕</button>
            </div>
            <form action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 px-8 py-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">No Kamar</label>
                        <input name="room_number" type="text" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 focus:border-forest-500 focus:ring-4 focus:ring-forest-100 outline-none" placeholder="Masukkan nomor kamar" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Tipe Kamar</label>
                        <input name="room_type" type="text" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 focus:border-forest-500 focus:ring-4 focus:ring-forest-100 outline-none" placeholder="Contoh: Deluxe" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Harga</label>
                        <input name="price" type="number" min="0" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 focus:border-forest-500 focus:ring-4 focus:ring-forest-100 outline-none" placeholder="Masukkan harga" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Foto Kamar</label>
                        <input name="photo" type="file" accept="image/*" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900" />
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Deskripsi</label>
                    <textarea name="description" rows="4" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-900 focus:border-forest-500 focus:ring-4 focus:ring-forest-100 outline-none" placeholder="Tuliskan detail kamar..."></textarea>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-600 border border-slate-200">
                    <p>ID kamar akan dibuat otomatis setelah data tersimpan.</p>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" class="modal-close px-6 py-3 rounded-xl bg-slate-100 text-slate-700 font-bold hover:bg-slate-200 transition">Batal</button>
                    <button type="submit" class="px-6 py-3 rounded-xl bg-forest-700 text-white font-bold hover:bg-forest-800 transition">Create</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Detail / Edit Modal -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4 py-8">
        <div class="w-full max-w-2xl rounded-3xl bg-white shadow-2xl ring-1 ring-black/5 overflow-hidden">
            <div class="flex items-center justify-between px-8 py-6 border-b border-gray-200">
                <div>
                    <h2 id="detailModalTitle" class="text-2xl font-bold text-slate-900">Detail Kamar</h2>
                    <p id="detailModalSubtitle" class="text-sm text-slate-500 mt-1">Lihat detail atau edit data kamar.</p>
                </div>
                <button type="button" class="modal-close text-slate-500 hover:text-slate-900" aria-label="Tutup">✕</button>
            </div>
            <div class="px-8 py-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">No Kamar</label>
                        <input id="detailRoomNumber" type="text" class="modal-field mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 outline-none" readonly />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Tipe Kamar</label>
                        <input id="detailRoomType" type="text" class="modal-field mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 outline-none" readonly />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Harga</label>
                        <input id="detailRoomPrice" type="text" class="modal-field mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 outline-none" readonly />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">ID Kamar</label>
                        <input id="detailRoomCode" type="text" class="modal-field mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 outline-none" readonly />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Status</label>
                        <input id="detailRoomStatus" type="text" class="modal-field mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-900 outline-none" readonly />
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-slate-700">Deskripsi</label>
                        <textarea id="detailRoomDescription" rows="4" class="modal-field mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-900 outline-none" readonly></textarea>
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
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin/kelolakamar.js') }}"></script>
</body>
</html>