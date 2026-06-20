<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            // Delete payment proof file if exists
            if ($reservation->bukti_pembayaran) {
                Storage::disk('public')->delete($reservation->bukti_pembayaran);
            }
            
            // Delete the reservation
            $reservation->delete();
            return redirect()->route('receptionist.index')->with('success', 'Reservasi telah ditolak dan dihapus dari daftar verifikasi');
        } elseif ($action === 'konfirmasi') {
            $reservation->update(['status' => 'ongoing']);
            return redirect()->route('receptionist.index')->with('success', 'Reservasi dikonfirmasi dan dipindahkan ke riwayat reservasi');
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
            $reservation->update(['status' => 'checkout']);
            return redirect()->route('resepsionis.riwayatreservasi')->with('success', 'Reservasi telah diselesaikan. Tamu sudah check-out.');
        }

        return redirect()->route('resepsionis.riwayatreservasi')->with('error', 'Reservasi tidak dapat diselesaikan karena status tidak valid.');
    }

    public function refundReservasi($id)
    {
        $reservation = $this->findReservationById($id);
        
        if (!$reservation) {
            return redirect()->route('resepsionis.riwayatreservasi')->with('error', 'Reservasi tidak ditemukan');
        }

        if ($reservation->status === 'ongoing') {
            $reservation->update(['status' => 'refund']);
            return redirect()->route('resepsionis.riwayatreservasi')->with('success', 'Reservasi telah direfund dan dibatalkan.');
        }

        return redirect()->route('resepsionis.riwayatreservasi')->with('error', 'Reservasi tidak dapat direfund karena status tidak valid.');
    }

    public function generatePDF($id)
    {
        $detail = $this->findReservationById($id);
        
        if (!$detail) {
            return redirect()->route('resepsionis.riwayatreservasi')->with('error', 'Reservasi tidak ditemukan');
        }

        // Generate base64 for image to avoid path issues in DOMPDF
        $imagePath = public_path('storage/' . $detail->bukti_pembayaran);
        $base64Image = '';
        if ($detail->bukti_pembayaran && file_exists($imagePath)) {
            $imageData = base64_encode(file_get_contents($imagePath));
            $mime = mime_content_type($imagePath);
            $base64Image = 'data:' . $mime . ';base64,' . $imageData;
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('resepsionis.pdf_reservasi', compact('detail', 'base64Image'));
        return $pdf->download('Reservasi_' . $detail->id . '_' . $detail->nama_lengkap . '.pdf');
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
        $query = Reservation::query()->whereNotNull('bukti_pembayaran');

        if ($status) {
            if ($status === 'checkout') {
                $query->whereIn('status', ['checkout', 'done']);
            } else {
                $query->where('status', $status);
            }
        }

        return $query->latest()->get();
    }

    protected function findReservationById($id)
    {
        return Reservation::find($id);
    }
}
