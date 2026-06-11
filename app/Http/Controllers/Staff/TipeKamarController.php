<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TipeKamarController extends Controller
{
    public function index()
    {
        $tipeKamars = TipeKamar::orderBy('id_tipe_kamar', 'desc')->get();
        return view('admin.tipekamar', compact('tipeKamars'));
    }

    public function store(Request $request)
    {
        $messages = [
            'nama_tipe.required' => 'Nama tipe kamar wajib diisi.',
            'kode_tipe.required' => 'Kode tipe kamar wajib diisi.',
            'kode_tipe.max' => 'Kode tipe kamar maksimal :max karakter.',
            'kode_tipe.unique' => 'Kode tipe kamar sudah digunakan.',
            'kode_tipe.regex' => 'Kode tipe kamar harus terdiri dari 1-3 huruf besar (A-Z).',
            'harga_per_malam.required' => 'Harga per malam wajib diisi.',
            'harga_per_malam.integer' => 'Harga per malam harus berupa angka.',
            'harga_per_malam.min' => 'Harga per malam minimal 0.',
            'jumlah_tamu.required' => 'Jumlah tamu wajib diisi.',
            'jumlah_tamu.integer' => 'Jumlah tamu harus berupa angka.',
            'jumlah_tamu.min' => 'Jumlah tamu minimal :min.',
            'jumlah_tamu.max' => 'Jumlah tamu maksimal :max.',
            'foto_kamar.required' => 'Anda harus mengunggah minimal 2 foto kamar.',
            'foto_kamar.array' => 'Foto kamar harus berupa array file.',
            'foto_kamar.min' => 'Anda harus mengunggah minimal :min foto.',
            'foto_kamar.max' => 'Anda hanya boleh mengunggah maksimal :max foto.',
            'foto_kamar.*.image' => 'Setiap file harus berupa gambar.',
            'foto_kamar.*.mimes' => 'Setiap file harus bertipe jpeg, png, atau jpg.',
            'foto_kamar.*.max' => 'Setiap file maksimal 5 MB.',
        ];

        $validated = $request->validate([
            'nama_tipe' => 'required|string|max:255',
            'kode_tipe' => 'required|string|max:3|unique:tipe_kamar,kode_tipe|regex:/^[A-Z]{1,3}$/',
            'harga_per_malam' => 'required|integer|min:0',
            'jumlah_tamu' => 'required|integer|min:1|max:20',
            'deskripsi' => 'nullable|string',
            'foto_kamar' => 'required|array|min:2|max:6',
            'foto_kamar.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        $paths = [];
        foreach ($request->file('foto_kamar') as $file) {
            $paths[] = Storage::disk('public')->put('tipe_kamar', $file);
        }

        $validated['foto_kamar'] = $paths;
        $validated['jumlah_tamu'] = (int) $validated['jumlah_tamu'];

        TipeKamar::create($validated);

        return redirect()->route('admin.tipe-kamar.index')->with('success', 'Tipe kamar berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $tipe = TipeKamar::findOrFail($id);

        $messages = [
            'nama_tipe.required' => 'Nama tipe kamar wajib diisi.',
            'kode_tipe.required' => 'Kode tipe kamar wajib diisi.',
            'kode_tipe.max' => 'Kode tipe kamar maksimal :max karakter.',
            'kode_tipe.unique' => 'Kode tipe kamar sudah digunakan.',
            'kode_tipe.regex' => 'Kode tipe kamar harus terdiri dari 1-3 huruf besar (A-Z).',
            'harga_per_malam.required' => 'Harga per malam wajib diisi.',
            'harga_per_malam.integer' => 'Harga per malam harus berupa angka.',
            'harga_per_malam.min' => 'Harga per malam minimal 0.',
            'jumlah_tamu.required' => 'Jumlah tamu wajib diisi.',
            'jumlah_tamu.integer' => 'Jumlah tamu harus berupa angka.',
            'jumlah_tamu.min' => 'Jumlah tamu minimal :min.',
            'jumlah_tamu.max' => 'Jumlah tamu maksimal :max.',
            'foto_kamar.array' => 'Foto kamar harus berupa array file.',
            'foto_kamar.min' => 'Anda harus mengunggah minimal :min foto.',
            'foto_kamar.max' => 'Anda hanya boleh mengunggah maksimal :max foto.',
            'foto_kamar.*.image' => 'Setiap file harus berupa gambar.',
            'foto_kamar.*.mimes' => 'Setiap file harus bertipe jpeg, png, atau jpg.',
            'foto_kamar.*.max' => 'Setiap file maksimal 5 MB.',
        ];

        $validated = $request->validate([
            'nama_tipe' => 'required|string|max:255',
            'kode_tipe' => 'required|string|max:3|regex:/^[A-Z]{1,3}$/|unique:tipe_kamar,kode_tipe,' . $tipe->id_tipe_kamar . ',id_tipe_kamar',
            'harga_per_malam' => 'required|integer|min:0',
            'jumlah_tamu' => 'required|integer|min:1|max:20',
            'deskripsi' => 'nullable|string',
            'foto_kamar' => 'nullable|array|min:2|max:6',
            'foto_kamar.*' => 'image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        $paths = $tipe->foto_kamar ?? [];
        if ($request->hasFile('foto_kamar')) {
            foreach ($paths as $path) {
                if ($path && Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            $paths = [];
            foreach ($request->file('foto_kamar') as $file) {
                $paths[] = Storage::disk('public')->put('tipe_kamar', $file);
            }
        }

        $validated['jumlah_tamu'] = (int) $validated['jumlah_tamu'];
        $oldKode = $tipe->kode_tipe;
        $newKode = $validated['kode_tipe'];

        DB::transaction(function () use ($tipe, $validated, $paths, $oldKode, $newKode) {
            $tipe->update(array_merge($validated, ['foto_kamar' => $paths]));

            if ($oldKode !== $newKode) {
                $kamars = Kamar::where('id_tipe_kamar', $tipe->id_tipe_kamar)->get();
                foreach ($kamars as $kamar) {
                    $newId = $newKode . $kamar->no_kamar;
                    DB::table('kamar')->where('id_kamar', $kamar->id_kamar)->update(['id_kamar' => $newId]);
                }
            }
        });

        return redirect()->route('admin.tipe-kamar.index')->with('success', 'Tipe kamar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tipe = TipeKamar::findOrFail($id);
        $tipe->delete();

        return redirect()->route('admin.tipe-kamar.index')->with('success', 'Tipe kamar berhasil dihapus.');
    }
}
