<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResepsionisController extends Controller
{
    public function tamuIndex()
    {
        $tamus = $this->fetchAllTamus();
        return view('resepsionis.crudtamu', compact('tamus'));
    }

    public function tamuCreate()
    {
        return view('resepsionis.create_tamu');
    }

    public function tamuStore(Request $request)
    {
        $validated = $this->validateTamu($request);
        $this->createTamu($validated);

        return redirect()->route('resepsionis.tamu')->with('success', 'Tamu berhasil ditambahkan');
    }

    public function tamuShow($id)
    {
        $tamu = $this->findTamuById($id);

        if (!$tamu) {
            return redirect()->route('resepsionis.tamu')->with('error', 'Tamu tidak ditemukan');
        }

        return view('resepsionis.detail_tamu', compact('tamu'));
    }

    public function riwayat(Request $request)
    {
        $status = $request->query('status');
        $reservations = $this->fetchReservations($status);

        return view('resepsionis.riwayatreservasi', compact('reservations', 'status'));
    }

    public function show($id)
    {
        $detail = $this->findReservationById($id);

        if (!$detail) {
            return redirect()->route('resepsionis.riwayatreservasi')->with('error', 'Reservasi tidak ditemukan');
        }

        return view('resepsionis.detailreservasi', compact('detail'));
    }

    public function verifikasi($id)
    {
        $reservation = $this->findReservationById($id);
        
        if (!$reservation) {
            return redirect()->route('receptionist.index')->with('error', 'Reservasi tidak ditemukan');
        }

        return view('resepsionis.verifikasitamu', compact('reservation'));
    }

    public function updateVerifikasi(Request $request, $id)
    {
        $reservation = $this->findReservationById($id);
        
        if (!$reservation) {
            return redirect()->route('receptionist.index')->with('error', 'Reservasi tidak ditemukan');
        }

        $action = $request->input('action'); // 'tolak' or 'konfirmasi'

        if ($action === 'tolak') {
            $reservation->update(['status' => 'rejected']);
            return redirect()->route('receptionist.index')->with('success', 'Reservasi ditolak');
        } elseif ($action === 'konfirmasi') {
            $reservation->update(['status' => 'ongoing']);
            return redirect()->route('receptionist.index')->with('success', 'Reservasi dikonfirmasi');
        }

        return back();
    }

    public function selesaikanReservasi($id)
    {
        $reservation = $this->findReservationById($id);
        
        if (!$reservation) {
            return redirect()->route('resepsionis.riwayatreservasi')->with('error', 'Reservasi tidak ditemukan');
        }

        if ($reservation->status === 'ongoing') {
            $reservation->update(['status' => 'done']);
            return redirect()->route('resepsionis.riwayatreservasi')->with('success', 'Reservasi telah diselesaikan. Tamu sudah check-out.');
        }

        return redirect()->route('resepsionis.riwayatreservasi')->with('error', 'Reservasi tidak dapat diselesaikan karena status tidak valid.');
    }

    protected function fetchAllTamus()
    {
        return User::latest()->get();
    }

    protected function findTamuById($id)
    {
        return User::find($id);
    }

    protected function validateTamu(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'whatsapp' => 'required|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'nik' => 'required|string|numeric|digits:16|unique:users,nik',
            'password' => 'required|string|min:8',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    }

    protected function createTamu(array $data): User
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        if (!empty($data['photo'])) {
            $data['photo'] = $this->storePhoto($data['photo']);
        }

        return User::create($data);
    }

    protected function storePhoto($photo): string
    {
        return $photo->store('foto_profil', 'public');
    }

    protected function fetchReservations(?string $status = null)
    {
        $query = Reservation::query();

        if ($status) {
            $query->where('status', $status);
        }

        return $query->latest()->get();
    }

    protected function findReservationById($id)
    {
        return Reservation::find($id);
    }
}
