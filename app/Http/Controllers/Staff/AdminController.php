<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;
use App\Models\Kamar;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /*TAMU*/

    public function tamuIndex()
    {
        $tamus = User::latest()->get();
        return view('admin.crudtamu', compact('tamus'));
    }

    public function tamuCreate()
    {
        return view('admin.tambah_tamu');
    }

    public function tamuStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'whatsapp' => 'required|string|max:20',
            'username' => 'nullable|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('admin.tamu')->with('success', 'Tamu berhasil ditambahkan');
    }

    public function tamuShow($id)
    {
        $tamu = User::find($id);

        if (!$tamu) {
            return redirect()->route('admin.tamu')->with('error', 'Tamu tidak ditemukan');
        }

        return view('admin.detail_tamu', compact('tamu'));
    }

    public function tamuEdit($id)
    {
        $tamu = User::find($id);

        if (!$tamu) {
            return redirect()->route('admin.tamu')->with('error', 'Tamu tidak ditemukan');
        }

        return view('admin.edit_tamu', compact('tamu'));
    }

    public function tamuUpdate(Request $request, $id)
    {
        $tamu = User::find($id);

        if (!$tamu) {
            return redirect()->route('admin.tamu')->with('error', 'Tamu tidak ditemukan');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $tamu->id,
            'whatsapp' => 'required|string|max:20',
            'username' => 'nullable|string|max:255|unique:users,username,' . $tamu->id,
            'password' => 'nullable|string|min:8',
        ]);

        if ($validatedData['password']) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $tamu->update($validatedData);

        return redirect()->route('admin.tamu')->with('success', 'Tamu berhasil diperbarui');
    }

    public function tamuDestroy($id)
    {
        $tamu = User::find($id);

        if (!$tamu) {
            return redirect()->route('admin.tamu')->with('error', 'Tamu tidak ditemukan');
        }

        $tamu->delete();
        return redirect()->route('admin.tamu')->with('success', 'Tamu berhasil dihapus');
    }

    /*RESEPSIONIS*/

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
            'name' => 'required|string|max:255|unique:staffs',
            'password' => 'required|string|min:8',
        ]);

        $validatedData['role'] = 'receptionist';
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['id_resepsionis'] = 'RSP-' . str_pad(Staff::where('role', 'receptionist')->count() + 1, 3, '0', STR_PAD_LEFT);

        Staff::create($validatedData);

        return redirect()->route('admin.resepsionis')->with('success', 'Resepsionis berhasil ditambahkan');
    }

    public function resepsionisShow($id)
    {
        $resepsionis = Staff::find($id);

        if (!$resepsionis) {
            return redirect()->route('admin.resepsionis')->with('error', 'Resepsionis tidak ditemukan');
        }

        return view('admin.detail_resepsionis', compact('resepsionis'));
    }

    public function resepsionisEdit($id)
    {
        $resepsionis = Staff::find($id);

        if (!$resepsionis) {
            return redirect()->route('admin.resepsionis')->with('error', 'Resepsionis tidak ditemukan');
        }

        return view('admin.edit_resepsionis', compact('resepsionis'));
    }

    public function resepsionisUpdate(Request $request, $id)
    {
        $resepsionis = Staff::find($id);

        if (!$resepsionis) {
            return redirect()->route('admin.resepsionis')->with('error', 'Resepsionis tidak ditemukan');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:staffs,name,' . $resepsionis->id,
            'password' => 'nullable|string|min:8',
        ]);

        if ($validatedData['password']) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $resepsionis->update($validatedData);

        return redirect()->route('admin.resepsionis')->with('success', 'Resepsionis berhasil diperbarui');
    }

    public function resepsionisDestroy($id)
    {
        $resepsionis = Staff::find($id);

        if (!$resepsionis) {
            return redirect()->route('admin.resepsionis')->with('error', 'Resepsionis tidak ditemukan');
        }

        $resepsionis->delete();
        return redirect()->route('admin.resepsionis')->with('success', 'Resepsionis berhasil dihapus');
    }

    /*KAMAR*/

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
        $validatedData = $request->validate([
            'no_kamar' => 'required|string|max:10|unique:kamar,no_kamar',
            'tipe_kamar' => 'required|string|max:30',
            'status_kamar' => 'required|string|in:tersedia,terisi',
            'harga_per_malam' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:255',
        ], [
            'no_kamar.required' => 'Nomor kamar wajib diisi.',
            'no_kamar.string' => 'Nomor kamar harus berupa teks.',
            'no_kamar.max' => 'Nomor kamar maksimal 10 karakter.',
            'no_kamar.unique' => 'Nomor kamar sudah terdaftar.',
            'tipe_kamar.required' => 'Tipe kamar wajib diisi.',
            'tipe_kamar.string' => 'Tipe kamar harus berupa teks.',
            'tipe_kamar.max' => 'Tipe kamar maksimal 30 karakter.',
            'status_kamar.required' => 'Status kamar wajib dipilih.',
            'status_kamar.string' => 'Status kamar harus berupa teks.',
            'status_kamar.in' => 'Status kamar harus tersedia atau terisi.',
            'harga_per_malam.required' => 'Harga per malam wajib diisi.',
            'harga_per_malam.integer' => 'Harga per malam harus berupa angka.',
            'harga_per_malam.min' => 'Harga per malam tidak boleh negatif.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'deskripsi.max' => 'Deskripsi maksimal 30 karakter.',
        ]);

        Kamar::create($validatedData);

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
        $kamar = Kamar::find($id);

        if (!$kamar) {
            return redirect()->route('admin.kamar')->with('error', 'Kamar tidak ditemukan');
        }

        $validatedData = $request->validate([
            'no_kamar' => 'required|string|max:10|unique:kamar,no_kamar,' . $kamar->id_kamar . ',id_kamar',
            'tipe_kamar' => 'required|string|max:30',
            'status_kamar' => 'required|string|in:tersedia,terisi',
            'harga_per_malam' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:30',
        ], [
            'no_kamar.required' => 'Nomor kamar wajib diisi.',
            'no_kamar.string' => 'Nomor kamar harus berupa teks.',
            'no_kamar.max' => 'Nomor kamar maksimal 10 karakter.',
            'no_kamar.unique' => 'Nomor kamar sudah terdaftar.',
            'tipe_kamar.required' => 'Tipe kamar wajib diisi.',
            'tipe_kamar.string' => 'Tipe kamar harus berupa teks.',
            'tipe_kamar.max' => 'Tipe kamar maksimal 255 karakter.',
            'status_kamar.required' => 'Status kamar wajib dipilih.',
            'status_kamar.string' => 'Status kamar harus berupa teks.',
            'status_kamar.in' => 'Status kamar harus tersedia atau terisi.',
            'harga_per_malam.required' => 'Harga per malam wajib diisi.',
            'harga_per_malam.integer' => 'Harga per malam harus berupa angka.',
            'harga_per_malam.min' => 'Harga per malam tidak boleh negatif.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'deskripsi.max' => 'Deskripsi maksimal 255 karakter.',
        ]);

        $kamar->update($validatedData);

        return redirect()->route('admin.kamar')->with('success', 'Kamar berhasil diperbarui');
    }

    public function kamarDestroy($id)
    {
        $kamar = Kamar::find($id);

        if (!$kamar) {
            return redirect()->route('admin.kamar')->with('error', 'Kamar tidak ditemukan');
        }

        $kamar->delete();

        return redirect()->route('admin.kamar')->with('success', 'Kamar berhasil dihapus');
    }
}
