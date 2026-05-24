<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;
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
    //MASIH DALAM PENGEMBANGAN, BELUM ADA FUNGSI NYA

    public function kamarIndex()
    {
        return view('admin.kelolakamar');
    }

    public function kamarCreate()
    {
        return view('admin.tambah_kamar');
    }

    public function kamarStore(Request $request)
    {
        $validatedData = $request->validate([
            'room_number' => 'required|string|max:10|unique:rooms',
            'room_type' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        return redirect()->route('admin.kamar')->with('success', 'Kamar berhasil ditambahkan');
    }

    public function kamarShow($id)
    {
        return view('admin.detail_kamar');
    }

    public function kamarEdit($id)
    {
        return view('admin.edit_kamar');
    }

    public function kamarUpdate(Request $request, $id)
    {
        return redirect()->route('admin.kamar')->with('success', 'Kamar berhasil diperbarui');
    }

    public function kamarDestroy($id)
    {
        return redirect()->route('admin.kamar')->with('success', 'Kamar berhasil dihapus');
    }
}
