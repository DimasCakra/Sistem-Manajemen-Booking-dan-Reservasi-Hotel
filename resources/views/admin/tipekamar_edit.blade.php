<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tipe Kamar - StayEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght=600;700&family=DM+Sans:wght=400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        .fade-up { animation: fadeUp .45s ease both; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex">
    @include('components.sidebar_admin')

    <main class="flex-1 overflow-y-auto px-10 py-10">
        <div class="mb-10 fade-up">
            <h1 class="font-display text-4xl font-bold text-forest-900">Edit Tipe Kamar</h1>
            <p class="text-forest-500 mt-2 font-semibold">Perbarui informasi tipe kamar dan foto sesuai kebutuhan.</p>
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

        <div class="bg-white rounded-xl shadow-sm border border-forest-100 p-8 fade-up">
            <form action="{{ route('admin.tipe-kamar.update', $tipe->id_tipe_kamar) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Nama Tipe Kamar</label>
                    <input type="text" name="nama_tipe" value="{{ old('nama_tipe', $tipe->nama_tipe) }}" required class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-forest-500" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Kode Tipe (maks 3 huruf)</label>
                    <input type="text" name="kode_tipe" value="{{ old('kode_tipe', $tipe->kode_tipe) }}" maxlength="3" required class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm uppercase outline-none focus:border-forest-500" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Harga per Malam</label>
                    <input type="number" name="harga_per_malam" value="{{ old('harga_per_malam', $tipe->harga_per_malam) }}" min="0" required class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-forest-500" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-forest-500">{{ old('deskripsi', $tipe->deskripsi) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700">Foto Kamar (2-6 foto)</label>
                    <input type="file" name="foto_kamar[]" multiple accept="image/*" class="mt-2 w-full text-sm text-slate-900 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-forest-50 file:text-forest-700 hover:file:bg-forest-100" />
                    <p class="text-xs text-slate-500 mt-2">Unggah ulang minimal 2 foto jika ingin mengganti foto kamar.</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($tipe->foto_kamar ?? [] as $foto)
                        <div class="rounded-2xl overflow-hidden border border-slate-200">
                            <img src="{{ asset('storage/' . $foto) }}" alt="Foto Tipe Kamar" class="w-full h-32 object-cover" />
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between items-center pt-4 border-t border-slate-200">
                    <a href="{{ route('admin.tipe-kamar.index') }}" class="text-slate-700 hover:text-forest-700">Kembali ke daftar tipe kamar</a>
                    <button type="submit" class="rounded-2xl bg-forest-700 text-white py-3 px-6 text-sm font-semibold hover:bg-forest-800 transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
