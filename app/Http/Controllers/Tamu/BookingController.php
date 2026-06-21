<?php

namespace App\Http\Controllers\Tamu;

use App\Models\TipeKamar;
use App\Http\Controllers\TamuController;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends TamuController
{
    protected function loadKamar($id)
    {
        $type = TipeKamar::findOrFail($id);
        return (object) [
            'id_tipe_kamar' => $type->id_tipe_kamar,
            'nama_tipe' => $type->nama_tipe,
            'harga' => $type->harga_per_malam,
            'jumlah_tamu' => $type->jumlah_tamu,
            'gambar' => $type->foto_kamar && count($type->foto_kamar) ? asset('storage/' . $type->foto_kamar[0]) : 'https://via.placeholder.com/380x260?text=No+Image',
        ];
    }

    /**
     * Find the first available kamar id for the given tipe name and date range.
     * Returns kamar id string or null if none available.
     */
    protected function findAvailableKamar(string $tipeNama, string $checkin, string $checkout)
    {
        $start = Carbon::parse($checkin)->startOfDay();
        $end = Carbon::parse($checkout)->startOfDay();

        // Get all kamars for the tipe, ordered by nomor (assuming id_kamar holds ordering)
        $kamars = \App\Models\Kamar::whereHas('tipe', function ($q) use ($tipeNama) {
            $q->where('nama_tipe', $tipeNama);
        })->orderBy('id_kamar', 'asc')->get();

        foreach ($kamars as $kamar) {
            // Check if this kamar has any overlapping confirmed or ongoing reservations
            $conflict = \App\Models\Reservation::where(function ($q) use ($kamar) {
                $q->where('kamar_id', $kamar->id_kamar)
                  ->orWhere('room_number', $kamar->id_kamar);
            })
            ->whereNotIn('status', ['temporary', 'cancelled', 'refund', 'done'])
            ->get()
            ->filter(function ($reservation) use ($start, $end) {
                // If pending without bukti, treat as not occupying
                if ($reservation->status === 'pending' && is_null($reservation->bukti_pembayaran)) {
                    return false;
                }

                // compute reservation dates
                if ($reservation->check_in && $reservation->check_out) {
                    $resStart = Carbon::parse($reservation->check_in)->startOfDay();
                    $resEnd = Carbon::parse($reservation->check_out)->startOfDay();
                } else {
                    if (!str_contains($reservation->check_in_out, ' to ')) return false;
                    [$s, $e] = explode(' to ', $reservation->check_in_out);
                    try {
                        $resStart = Carbon::parse(trim($s))->startOfDay();
                        $resEnd = Carbon::parse(trim($e))->startOfDay();
                    } catch (\Exception $ex) {
                        return false;
                    }
                }

                return $resStart <= $end && $resEnd >= $start;
            })->count() > 0;

            if (!$conflict) {
                return $kamar->id_kamar;
            }
        }

        return null;
    }

    protected function resolveDates(Request $request)
    {
        $checkin = $request->query('checkin', now()->format('Y-m-d'));
        $checkout = $request->query('checkout', now()->addDay()->format('Y-m-d'));

        try {
            $start = Carbon::parse($checkin)->startOfDay();
            $end = Carbon::parse($checkout)->startOfDay();
            $durasi = max(1, $start->diffInDays($end));
        } catch (\Exception $e) {
            $checkin = now()->format('Y-m-d');
            $checkout = now()->addDay()->format('Y-m-d');
            $durasi = 1;
        }

        return [
            'checkin' => $checkin,
            'checkout' => $checkout,
            'durasi' => $durasi,
        ];
    }

    public function biodata(Request $request, $id)
    {
        $kamar = $this->loadKamar($id);
        $dates = $this->resolveDates($request);

        $pajak = $kamar->harga * 0.10;
        $total = ($kamar->harga * $dates['durasi']) + $pajak;

        // Determine a suggested room number (not reserved yet) to show to user
        $candidateKamarId = $this->findAvailableKamar($kamar->nama_tipe, $dates['checkin'], $dates['checkout']);
        $candidateNumber = $candidateKamarId ? $candidateKamarId : '-';

        return view('biodata', array_merge(compact('kamar', 'id'), $dates, compact('pajak', 'total', 'candidateNumber')));
    }

    public function storeBiodata(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'booking_untuk_orang_lain' => 'nullable',
            'nama_tamu_lain' => 'required_if:booking_untuk_orang_lain,1|nullable|string|max:255',
            'nik_tamu_lain' => 'required_if:booking_untuk_orang_lain,1|nullable|string|max:255',
            'permintaan_khusus' => 'nullable|string',
        ]);

        $kamar = $this->loadKamar($id);
        $dates = $this->resolveDates($request);
        $pajak = $kamar->harga * 0.10;
        $total = ($kamar->harga * $dates['durasi']) + $pajak;

        // Allocate the first available kamar for the selected dates
        $allocatedKamarId = $this->findAvailableKamar($kamar->nama_tipe, $dates['checkin'], $dates['checkout']);

        if (!$allocatedKamarId) {
            return back()->withInput()->with('error', 'Tidak ada kamar tersedia untuk tipe ini pada tanggal yang dipilih.');
        }

        $allocatedKamar = \App\Models\Kamar::where('id_kamar', $allocatedKamarId)->first();

        $reservation = \App\Models\Reservation::create([
            'user_id' => $request->user()?->id,
            'room_type' => $kamar->nama_tipe,
            'room_number' => $allocatedKamar?->no_kamar ?? $allocatedKamarId,
            'kamar_id' => $allocatedKamarId,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'jumlah_tamu' => $kamar->jumlah_tamu,
            'check_in_out' => $dates['checkin'] . ' to ' . $dates['checkout'],
            // Mark as temporary draft so it is not treated as active reservation
            'status' => 'temporary',
            'total_biaya' => $total,
            'nama_tamu_lain' => $request->nama_tamu_lain,
            'nik_tamu_lain' => $request->nik_tamu_lain,
            'permintaan_khusus' => $request->permintaan_khusus,
        ]);

        return redirect()->route('booking.payment', [
            'reservation_id' => $reservation->id
        ]);
    }

    public function payment(Request $request, $reservation_id)
    {
        $reservation = \App\Models\Reservation::findOrFail($reservation_id);

        // Accept both temporary (just filled biodata) and pending (awaiting payment confirmation)
        if (!in_array($reservation->status, ['temporary', 'pending'])) {
            return redirect()->route('home')->with('error', 'Reservasi ini sudah diproses atau tidak valid.');
        }

        // Expire temporary or pending reservations after 15 minutes
        if ($reservation->created_at->diffInMinutes(now()) >= 15) {
            $reservation->update(['status' => 'cancelled']);
            return redirect()->route('home')->with('error', 'Waktu pembayaran telah habis. Reservasi Anda dibatalkan otomatis.');
        }

        // Parse dates for durasi
        $datesParts = explode(' to ', $reservation->check_in_out);
        $checkin = $datesParts[0];
        $checkout = $datesParts[1] ?? now()->addDay()->format('Y-m-d');

        $start = Carbon::parse($checkin)->startOfDay();
        $end = Carbon::parse($checkout)->startOfDay();
        $durasi = max(1, $start->diffInDays($end));

        $kamar = (object) [
            'nama_tipe' => $reservation->room_type,
            'harga' => ($reservation->total_biaya / 1.1) / $durasi // approximate back
        ];

        $pajak = $reservation->total_biaya - ($reservation->total_biaya / 1.1);
        $total = $reservation->total_biaya;
        $id = $reservation->id;

        return view('payment', compact('kamar', 'id', 'checkin', 'checkout', 'durasi', 'pajak', 'total', 'reservation'));
    }

    public function storePayment(Request $request, $reservation_id)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $reservation = \App\Models\Reservation::findOrFail($reservation_id);

        // Allow uploading payment proof for temporary or previously pending reservations
        if (!in_array($reservation->status, ['temporary', 'pending'])) {
            return redirect()->route('home')->with('error', 'Reservasi ini sudah diproses atau dibatalkan.');
        }

        if ($reservation->created_at->diffInMinutes(now()) >= 15) {
            $reservation->update(['status' => 'cancelled']);
            return redirect()->route('home')->with('error', 'Waktu pembayaran telah habis. Reservasi Anda dibatalkan otomatis.');
        }

        $buktiPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        $reservation->update([
            'payment_method' => $request->payment_method,
            'bukti_pembayaran' => $buktiPath,
            // Mark as pending so receptionist can verify; temporary -> pending on confirmation
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Pembayaran berhasil dikonfirmasi! Menunggu verifikasi resepsionis.');
    }

    public function cancelPayment(Request $request, $reservation_id)
    {
        $reservation = \App\Models\Reservation::findOrFail($reservation_id);
        
        // Allow cancellation/deletion for temporary or pending reservations without payment proof
        if (in_array($reservation->status, ['temporary', 'pending']) && is_null($reservation->bukti_pembayaran)) {
            $reservation->delete();
        } elseif ($reservation->bukti_pembayaran) {
            // If a payment proof exists and cancellation requested, delete the file then delete record
            try {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($reservation->bukti_pembayaran);
            } catch (\Exception $e) {
                // ignore file deletion errors
            }
            $reservation->delete();
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('home')->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
