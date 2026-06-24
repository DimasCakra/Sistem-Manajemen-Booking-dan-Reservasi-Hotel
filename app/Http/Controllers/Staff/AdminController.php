<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Staff;
use App\Models\Kamar;
use App\Models\TipeKamar;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Tamu
    public function tamuIndex()
    {
        $tamus = User::latest()->paginate(5);
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
            'id_type' => 'nullable|in:NIK,Paspor',
            'id_number' => [
                'nullable',
                'string',
                $request->id_type === 'Paspor' ? 'alpha_num' : 'numeric',
                $request->id_type === 'Paspor' ? 'max:9' : 'digits:16',
                'unique:users,id_number'
            ],
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
            'id_type' => 'nullable|in:NIK,Paspor',
            'id_number' => [
                'nullable',
                'string',
                $request->id_type === 'Paspor' ? 'alpha_num' : 'numeric',
                $request->id_type === 'Paspor' ? 'max:9' : 'digits:16',
                'unique:users,id_number,' . $tamu->id
            ],
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
        $resepsionis = Staff::where('role', 'receptionist')->latest()->paginate(5);
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

        $kamars = Kamar::with('tipe');

        if ($search) {
            $kamars->where(function ($query) use ($search) {
                $query->where('no_kamar', 'like', '%' . $search . '%')
                    ->orWhereHas('tipe', function ($query) use ($search) {
                        $query->where('nama_tipe', 'like', '%' . $search . '%')
                              ->orWhere('kode_tipe', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($type) {
            $kamars->whereHas('tipe', function ($query) use ($type) {
                $query->where('nama_tipe', $type);
            });
        }

        if ($status) {
            $kamars->where('status_kamar', $status);
        }

        $kamars = $kamars->orderBy('id_kamar', 'desc')->paginate(5);
        $tipeKamars = TipeKamar::orderBy('nama_tipe')->get();

        return view('admin.kelolakamar', compact('kamars', 'search', 'type', 'status', 'tipeKamars'));
    }

    public function kamarCreate()
    {
        return redirect()->route('admin.kamar');
    }

    public function kamarStore(Request $request)
    {
        $validated = $request->validate([
            'no_kamar' => [
                'required',
                'digits:3',
                'unique:kamar,no_kamar'
            ],
            'id_tipe_kamar' => 'required|exists:tipe_kamar,id_tipe_kamar',
        ], [
            'no_kamar.required' => 'Nomor kamar wajib diisi.',
            'no_kamar.digits' => 'Nomor kamar harus terdiri dari 3 angka.',
            'no_kamar.unique' => 'Nomor kamar sudah digunakan.',
            'id_tipe_kamar.required' => 'Tipe kamar wajib dipilih.',
            'id_tipe_kamar.exists' => 'Tipe kamar tidak ditemukan.',
        ]);


        Kamar::create([
            'id_kamar' => $validated['no_kamar'],
            'no_kamar' => $validated['no_kamar'],
            'id_tipe_kamar' => $validated['id_tipe_kamar'],
            'status_kamar' => 'tersedia',
        ]);


        return redirect()
            ->route('admin.kamar')
            ->with('success', 'Kamar berhasil ditambahkan');
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
            return redirect()
                ->route('admin.kamar')
                ->with('error', 'Kamar tidak ditemukan');
        }


        $validated = $request->validate([
            'no_kamar' => [
                'required',
                'digits:3',
                \Illuminate\Validation\Rule::unique('kamar','no_kamar')
                    ->ignore($kamar->id_kamar, 'id_kamar')
            ],
            'id_tipe_kamar' => 'required|exists:tipe_kamar,id_tipe_kamar',
        ], [
            'no_kamar.required' => 'Nomor kamar wajib diisi.',
            'no_kamar.digits' => 'Nomor kamar harus terdiri dari 3 angka.',
            'no_kamar.unique' => 'Nomor kamar sudah digunakan.',
            'id_tipe_kamar.required' => 'Tipe kamar wajib dipilih.',
            'id_tipe_kamar.exists' => 'Tipe kamar tidak ditemukan.',
        ]);


        $kamar->update([
            'id_kamar' => $validated['no_kamar'],
            'no_kamar' => $validated['no_kamar'],
            'id_tipe_kamar' => $validated['id_tipe_kamar'],

            // status tidak disentuh
            'status_kamar' => $kamar->status_kamar,
        ]);


        return redirect()
            ->route('admin.kamar')
            ->with('success', 'Kamar berhasil diperbarui');
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
