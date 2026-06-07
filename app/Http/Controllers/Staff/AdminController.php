<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Staff;
use App\Models\Kamar;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // ==========================================
    // TAMU MANAGEMENT (CRUD)
    // ==========================================
    public function tamuIndex()
    {
        $tamus = User::latest()->get();
        return view('admin.crudtamu', compact('tamus'));
    }

    public function tamuCreate()
    {
        return redirect()->route('admin.tamu');
    }

    public function tamuStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'whatsapp' => 'required|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'nik' => 'nullable|string|numeric|digits:16|unique:users,nik',
            'password' => 'required|string|min:8',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('foto_profil', 'public');
        }

        User::create($validatedData);

        return redirect()->route('admin.tamu')->with('success', 'Tamu berhasil ditambahkan');
    }

    public function tamuShow($id)
    {
        $tamu = User::findOrFail($id);
        return view('admin.detail_tamu', compact('tamu'));
    }

    public function tamuEdit($id)
    {
        $tamu = User::findOrFail($id);
        return view('admin.edit_tamu', compact('tamu'));
    }

    public function tamuUpdate(Request $request, $id)
    {
        $tamu = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $tamu->id,
            'whatsapp' => 'required|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'nik' => 'nullable|string|numeric|digits:16|unique:users,nik,' . $tamu->id,
            'password' => 'nullable|string|min:8',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        if ($request->hasFile('photo')) {
            if ($tamu->photo && Storage::disk('public')->exists($tamu->photo)) {
                Storage::disk('public')->delete($tamu->photo);
            }
            $validatedData['photo'] = $request->file('photo')->store('foto_profil', 'public');
        }

        $tamu->update($validatedData);

        return redirect()->route('admin.tamu')->with('success', 'Tamu berhasil diperbarui');
    }

    public function tamuDestroy($id)
    {
        $tamu = User::findOrFail($id);

        if ($tamu->photo && Storage::disk('public')->exists($tamu->photo)) {
            Storage::disk('public')->delete($tamu->photo);
        }

        $tamu->delete();

        return redirect()->route('admin.tamu')->with('success', 'Tamu berhasil dihapus');
    }

    // ==========================================
    // RESEPSIONIS MANAGEMENT (CRUD)
    // ==========================================
    public function resepsionisIndex()
    {
        $resepsionis = Staff::where('role', 'receptionist')->latest()->get();
        return view('admin.crudresepsionis', compact('resepsionis'));
    }

    public function resepsionisCreate()
    {
        return view('admin.tambah_resepsionis');
    }

    public function resepsionisStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:staffs,name',
            'email' => 'required|email|max:100|unique:staffs,email',
            'no_hp' => 'nullable|string|max:20',
            'password' => 'required|string|min:8',
        ]);

        $lastStaff = Staff::where('role', 'receptionist')
                          ->where('id_resepsionis', 'LIKE', 'RSP-%')
                          ->orderBy('id_resepsionis', 'desc')
                          ->first();

        if ($lastStaff) {
            $lastNumber = (int) substr($lastStaff->id_resepsionis, 4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $validatedData['id_resepsionis'] = 'RSP-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        $validatedData['role'] = 'receptionist';
        $validatedData['password'] = Hash::make($request->password);

        Staff::create($validatedData);

        return redirect()->route('admin.resepsionis')->with('success', 'Resepsionis berhasil ditambahkan');
    }

    public function resepsionisShow($id)
    {
        $resepsionis = Staff::findOrFail($id);
        return view('admin.detail_resepsionis', compact('resepsionis'));
    }

    public function resepsionisEdit($id)
    {
        $resepsionis = Staff::findOrFail($id);
        return view('admin.edit_resepsionis', compact('resepsionis'));
    }

    public function resepsionisUpdate(Request $request, $id)
    {
        $resepsionis = Staff::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:staffs,name,' . $resepsionis->id,
            'email' => 'required|email|max:100|unique:staffs,email,' . $resepsionis->id,
            'no_hp' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8',
        ]);

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $resepsionis->update($validatedData);

        return redirect()->route('admin.resepsionis')->with('success', 'Resepsionis berhasil diperbarui');
    }

    public function resepsionisDestroy($id)
    {
        $resepsionis = Staff::findOrFail($id);
        $resepsionis->delete();

        return redirect()->route('admin.resepsionis')->with('success', 'Resepsionis berhasil dihapus');
    }

    // ==========================================
    // TIPE KAMAR MANAGEMENT (CRUD BARU)
    // ==========================================
    public function tipeKamarIndex()
    {
        $tipeKamars = DB::table('tipe_kamar')->orderBy('id_tipe_kamar', 'desc')->get();
        return view('admin.tipekamar', compact('tipeKamars'));
    }

    public function tipeKamarStore(Request $request)
    {
        $request->validate([
            'nama_tipe' => 'required|string|max:50|unique:tipe_kamar,nama_tipe',
            'kode_tipe' => 'required|max:3|unique:tipe_kamar,kode_tipe',
            'harga_per_malam' => 'required|numeric|min:0',
            'deskripsi' => 'required|string|max:255',
            'foto_kamar.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $paths = [];
        if ($request->hasFile('foto_kamar')) {
            foreach ($request->file('foto_kamar') as $file) {
                $paths[] = $file->store('foto_kamar', 'public');
            }
        }

        DB::table('tipe_kamar')->insert([
            'nama_tipe' => $request->nama_tipe,
            'kode_tipe' => $request->kode_tipe,
            'harga_per_malam' => $request->harga_per_malam,
            'deskripsi' => $request->deskripsi,
            'foto_kamar' => json_encode($paths),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.tipekamar')->with('success', 'Tipe kamar berhasil ditambahkan.');
    }

    public function tipeKamarUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_tipe' => 'required|string|max:50|unique:tipe_kamar,nama_tipe,' . $id . ',id_tipe_kamar',
            'kode_tipe' => 'required|max:3|unique:tipe_kamar,kode_tipe,' . $id . ',id_tipe_kamar',
            'harga_per_malam' => 'required|numeric|min:0',
            'deskripsi' => 'required|string|max:255',
            'foto_kamar.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $tipe = DB::table('tipe_kamar')->where('id_tipe_kamar', $id)->first();
        if (!$tipe) return redirect()->back()->withErrors('Tipe kamar tidak ditemukan.');

        $paths = json_decode($tipe->foto_kamar, true) ?? [];

        if ($request->hasFile('foto_kamar')) {
            foreach ($paths as $oldFoto) {
                if (Storage::disk('public')->exists($oldFoto)) {
                    Storage::disk('public')->delete($oldFoto);
                }
            }
            $paths = [];
            foreach ($request->file('foto_kamar') as $file) {
                $paths[] = $file->store('foto_kamar', 'public');
            }
        }

        DB::table('tipe_kamar')->where('id_tipe_kamar', $id)->update([
            'nama_tipe' => $request->nama_tipe,
            'harga_per_malam' => $request->harga_per_malam,
            'deskripsi' => $request->deskripsi,
            'foto_kamar' => json_encode($paths),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.tipekamar')->with('success', 'Tipe kamar berhasil diperbarui.');
    }

    public function tipeKamarDestroy($id)
    {
        $tipe = DB::table('tipe_kamar')->where('id_tipe_kamar', $id)->first();
        if ($tipe) {
            $paths = json_decode($tipe->foto_kamar, true) ?? [];
            foreach ($paths as $foto) {
                if (Storage::disk('public')->exists($foto)) {
                    Storage::disk('public')->delete($foto);
                }
            }
            DB::table('tipe_kamar')->where('id_tipe_kamar', $id)->delete();
        }
        return redirect()->route('admin.tipekamar')->with('success', 'Tipe kamar berhasil dihapus.');
    }

    // ==========================================
    // KAMAR MANAGEMENT (RESTUCTURING CRUD)
    // ==========================================
    public function kamarIndex(Request $request)
    {
        $search = $request->query('search');
        $type = $request->query('type');
        $status = $request->query('status');

        // Menggunakan Query Builder dengan JOIN ke master tipe_kamar
    $query = DB::table('kamar')
            ->join('tipe_kamar', 'kamar.id_tipe_kamar', '=', 'tipe_kamar.id_tipe_kamar')
            ->select('kamar.*', 'tipe_kamar.nama_tipe', 'tipe_kamar.harga_per_malam', 'tipe_kamar.deskripsi', 'tipe_kamar.foto_kamar');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kamar.no_kamar', 'like', '%' . $search . '%')
                  ->orWhere('tipe_kamar.nama_tipe', 'like', '%' . $search . '%')
                  ->orWhere('tipe_kamar.deskripsi', 'like', '%' . $search . '%');
            });
        }

        if ($type) {
            $query->where('kamar.id_tipe_kamar', $type);
        }

        if ($status) {
            $query->where('kamar.status_kamar', $status);
        }

        $kamars = $query->orderBy('kamar.id', 'desc')->get();

        // Ambil semua list master tipe_kamar untuk dropdown modal & filter
        $listTipe = DB::table('tipe_kamar')->get();

        return view('admin.kelolakamar', compact('kamars', 'listTipe', 'search', 'type', 'status'));
    }

    public function kamarCreate()
    {
        return redirect()->route('admin.kamar');
    }

    public function kamarStore(Request $request)
    {
        $request->validate([
            'no_kamar' => 'required|string|max:10', // Ini hanya nomor urut (ex: 01)
            'id_tipe_kamar' => 'required|integer|exists:tipe_kamar,id_tipe_kamar',
            'status_kamar' => 'required|string|in:tersedia,terisi',
        ]);

        // 1. Ambil kode dari tabel tipe_kamar
        $tipe = DB::table('tipe_kamar')->where('id_tipe_kamar', $request->id_tipe_kamar)->first();

        // 2. Gabungkan: Kode Tipe (STD) + Nomor (01) = STD01
        $noKamarFinal = strtoupper($tipe->kode_tipe) . $request->no_kamar;

        // 3. Simpan
        DB::table('kamar')->insert([
            'no_kamar'      => $noKamarFinal, // Ini Primary Key-nya sekarang
            'id_tipe_kamar' => $request->id_tipe_kamar,
            'status_kamar'  => $request->status_kamar,
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        return redirect()->route('admin.kamar')->with('success', 'Kamar ' . $noKamarFinal . ' berhasil ditambah.');
    }

    public function kamarShow($id)
    {
        return redirect()->route('admin.kamar');
    }

    public function kamarEdit($id)
    {
        return redirect()->route('admin.kamar');
    }

public function kamarUpdate(Request $request, $id)
{
    // Cari berdasarkan id (auto-increment), bukan no_kamar
    DB::table('kamar')->where('id', $id)->update([
        'no_kamar' => $request->no_kamar,
        'id_tipe_kamar' => $request->id_tipe_kamar,
        'status_kamar' => $request->status_kamar,
        'updated_at' => now()
    ]);
    return redirect()->route('admin.kamar')->with('success', 'Berhasil diperbarui');
}

    public function kamarDestroy($id)
    {
        DB::table('kamar')->where('no_kamar', $id)->delete();
        return redirect()->route('admin.kamar')->with('success', 'Kamar berhasil dihapus');
    }
}
