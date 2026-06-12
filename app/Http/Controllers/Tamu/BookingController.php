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

        $sessionData = $request->only([
            'nama_lengkap', 'nik', 'whatsapp', 'email', 
            'nama_tamu_lain', 'nik_tamu_lain', 'permintaan_khusus'
        ]);

        $request->session()->put('booking_biodata_' . $id, $sessionData);

        return redirect()->route('booking.payment', [
            'id' => $id, 
            'checkin' => $request->query('checkin'), 
            'checkout' => $request->query('checkout')
        ]);
    }

    public function payment(Request $request, $id)
    {
        $kamar = $this->loadKamar($id);
        $dates = $this->resolveDates($request);

        $pajak = $kamar->harga * 0.10;
        $total = ($kamar->harga * $dates['durasi']) + $pajak;

        // Redirect back if biodata is not filled
        if (!$request->session()->has('booking_biodata_' . $id)) {
            return redirect()->route('booking.biodata', [
                'id' => $id,
                'checkin' => $dates['checkin'],
                'checkout' => $dates['checkout']
            ])->with('error', 'Silakan isi biodata terlebih dahulu.');
        }

        return view('payment', array_merge(compact('kamar', 'id'), $dates, compact('pajak', 'total')));
    }

    public function storePayment(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $kamar = $this->loadKamar($id);
        $dates = $this->resolveDates($request);
        $biodata = $request->session()->get('booking_biodata_' . $id);

        if (!$biodata) {
            return redirect()->route('booking.biodata', $id)->with('error', 'Biodata session expired.');
        }

        $pajak = $kamar->harga * 0.10;
        $total = ($kamar->harga * $dates['durasi']) + $pajak;

        $buktiPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        \App\Models\Reservation::create([
            'user_id' => auth()->id(), // null if not logged in
            'room_type' => $kamar->nama_tipe,
            'room_number' => '-', // Wait for receptionist
            'nama_lengkap' => $biodata['nama_lengkap'],
            'nik' => $biodata['nik'],
            'whatsapp' => $biodata['whatsapp'],
            'email' => $biodata['email'],
            'jumlah_tamu' => $kamar->jumlah_tamu,
            'check_in_out' => $dates['checkin'] . ' to ' . $dates['checkout'],
            'status' => 'ongoing',
            'total_biaya' => $total,
            'nama_tamu_lain' => $biodata['nama_tamu_lain'] ?? null,
            'nik_tamu_lain' => $biodata['nik_tamu_lain'] ?? null,
            'permintaan_khusus' => $biodata['permintaan_khusus'] ?? null,
            'payment_method' => $request->payment_method,
            'bukti_pembayaran' => $buktiPath,
        ]);

        $request->session()->forget('booking_biodata_' . $id);

        return redirect()->route('home')->with('success', 'Pemesanan berhasil dibuat! Menunggu konfirmasi resepsionis.');
    }
}
