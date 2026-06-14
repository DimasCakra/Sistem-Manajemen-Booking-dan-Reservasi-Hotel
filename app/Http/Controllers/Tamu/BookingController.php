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

        return view('biodata', array_merge(compact('kamar', 'id'), $dates, compact('pajak', 'total')));
    }

    public function storeBiodata(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'booking_untuk_orang_lain' => 'nullable',
            'nama_tamu_lain' => 'nullable|string|max:255',
            'nik_tamu_lain' => 'nullable|string|max:255',
            'permintaan_khusus' => 'nullable|string',
        ]);

        $kamar = $this->loadKamar($id);
        $dates = $this->resolveDates($request);
        $pajak = $kamar->harga * 0.10;
        $total = ($kamar->harga * $dates['durasi']) + $pajak;

        $reservation = \App\Models\Reservation::create([
            'user_id' => auth()->id(),
            'room_type' => $kamar->nama_tipe,
            'room_number' => '-',
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'jumlah_tamu' => $kamar->jumlah_tamu,
            'check_in_out' => $dates['checkin'] . ' to ' . $dates['checkout'],
            'status' => 'pending',
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

        if ($reservation->status !== 'pending') {
            return redirect()->route('home')->with('error', 'Reservasi ini sudah diproses atau tidak valid.');
        }

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

        if ($reservation->status !== 'pending') {
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
            // Keep status pending as receptionist uses it for awaiting verification, 
            // or update it if you have specific status for 'awaiting_verification'. 
            // Here we keep it pending as instructed, but since bukti_pembayaran != null, receptionist can verify.
        ]);

        return redirect()->route('home')->with('success', 'Pembayaran berhasil dikonfirmasi! Menunggu verifikasi resepsionis.');
    }
}
