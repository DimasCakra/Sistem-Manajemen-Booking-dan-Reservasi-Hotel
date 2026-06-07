<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Staff;
use App\Models\Kamar;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Tamu
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

    // resepsionis
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

    // 2. Format kembali menjadi string RSP-00X
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

    // Kamar
    public function kamarIndex(Request $request)
    {
        $search = $request->query('search');
        $type = $request->query('type');
        $status = $request->query('status');

        $kamars = Kamar::query();

        if ($search) {
            $kamars->where(function ($query) use ($search) {
                $query->where('no_kamar', 'like', '%' . $search . '%')
                    ->orWhere('tipe_kamar', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        if ($type) {
            $kamars->where('tipe_kamar', $type);
        }

        if ($status) {
            $kamars->where('status_kamar', $status);
        }

        $kamars = $kamars->orderBy('id_kamar', 'desc')->get();

        return view('admin.kelolakamar', compact('kamars', 'search', 'type', 'status'));
    }

    public function kamarCreate()
    {
        return redirect()->route('admin.kamar');
    }

    public function kamarStore(Request $request)
    {
        $request->validate([
            'no_kamar' => 'required|string|max:10|unique:kamar,no_kamar',
            'tipe_kamar' => 'required|string|max:30',
            'status_kamar' => 'required|string|in:tersedia,terisi',
            'harga_per_malam' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:255',
            'foto_kamar.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'no_kamar.required' => 'Nomor kamar wajib diisi.',
            'no_kamar.unique' => 'Nomor kamar sudah terdaftar.',
            'tipe_kamar.required' => 'Tipe kamar wajib diisi.',
            'status_kamar.required' => 'Status kamar wajib dipilih.',
            'status_kamar.in' => 'Status kamar harus tersedia atau terisi.',
            'harga_per_malam.required' => 'Harga per malam wajib diisi.',
            'harga_per_malam.integer' => 'Harga per malam harus berupa angka.',
            'foto_kamar.*.image' => 'File harus berupa gambar.',
        ]);

        $dataFoto = [];

        if ($request->hasFile('foto_kamar')) {
            $files = array_slice($request->file('foto_kamar'), 0, 5);
            foreach ($files as $file) {
                $dataFoto[] = $file->store('foto_kamar', 'public');
            }
        }

        Kamar::create([
            'no_kamar' => $request->no_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'status_kamar' => $request->status_kamar,
            'harga_per_malam' => $request->harga_per_malam,
            'deskripsi' => $request->deskripsi,
            'foto_kamar' => json_encode($dataFoto)
        ]);

        return redirect()->route('admin.kamar')->with('success', 'Kamar berhasil ditambahkan');
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
        $kamar = Kamar::where('id_kamar', $id)->first();

        if (!$kamar) {
            return redirect()->route('admin.kamar')->with('error', 'Kamar tidak ditemukan');
        }

        $request->validate([
            'no_kamar' => 'required|string|max:10|unique:kamar,no_kamar,' . $kamar->id_kamar . ',id_kamar',
            'tipe_kamar' => 'required|string|max:30',
            'status_kamar' => 'required|string|in:tersedia,terisi',
            'harga_per_malam' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:255',
            'foto_kamar' => 'nullable|array',
            'foto_kamar.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_kamar')) {
            $fotoLama = json_decode($kamar->foto_kamar, true) ?? [];
            foreach ($fotoLama as $foto) {
                if (Storage::disk('public')->exists($foto)) {
                    Storage::disk('public')->delete($foto);
                }
            }

            $dataFoto = [];
            $files = array_slice($request->file('foto_kamar'), 0, 5);
            foreach ($files as $file) {
                $dataFoto[] = $file->store('foto_kamar', 'public');
            }

            $kamar->foto_kamar = json_encode($dataFoto);
        }

        $kamar->no_kamar = $request->no_kamar;
        $kamar->tipe_kamar = $request->tipe_kamar;
        $kamar->status_kamar = $request->status_kamar;
        $kamar->harga_per_malam = $request->harga_per_malam;
        $kamar->deskripsi = $request->deskripsi;
        $kamar->save();

        return redirect()->route('admin.kamar')->with('success', 'Kamar berhasil diperbarui');
    }

    public function kamarDestroy($id)
    {
        $kamar = Kamar::where('id_kamar', $id)->first();

        if (!$kamar) {
            return redirect()->route('admin.kamar')->with('error', 'Kamar tidak ditemukan');
        }

        $fotoLama = json_decode($kamar->foto_kamar, true) ?? [];
        foreach ($fotoLama as $foto) {
            if (Storage::disk('public')->exists($foto)) {
                Storage::disk('public')->delete($foto);
            }
        }

        $kamar->delete();

        return redirect()->route('admin.kamar')->with('success', 'Kamar berhasil dihapus');
    }
}
