<?php

namespace App\Http\Controllers\Tamu;

use App\Enums\ReservationStatus;
use App\Models\Kamar;
use App\Models\Reservation;
use App\Models\TipeKamar;
use App\Http\Controllers\TamuController;
use App\Services\AvailabilityService;
use App\Services\ReservationService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends TamuController
{
    public function __construct(
        protected AvailabilityService $availability,
        protected ReservationService $reservationService
    ) {}

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

        $candidateKamarId = $this->availability->findAvailableKamar($kamar->nama_tipe, $dates['checkin'], $dates['checkout']);
        $candidateNumber = $candidateKamarId ? $candidateKamarId : '-';

        return view('biodata', array_merge(compact('kamar', 'id'), $dates, compact('pajak', 'total', 'candidateNumber')));
    }

    public function storeBiodata(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'id_type' => 'required|in:NIK,Paspor',
            'id_number' => [
                'required',
                'string',
                $request->id_type === 'NIK' ? 'numeric' : 'alpha_num',
                $request->id_type === 'NIK' ? 'digits:16' : 'max:9',
            ],
            'whatsapp' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'booking_untuk_orang_lain' => 'nullable',
            'nama_tamu_lain' => 'required_if:booking_untuk_orang_lain,1|nullable|array',
            'nama_tamu_lain.*' => 'string|max:255',
            'id_type_tamu_lain' => 'required_if:booking_untuk_orang_lain,1|nullable|array',
            'id_type_tamu_lain.*' => 'in:NIK,Paspor',
            'id_number_tamu_lain' => 'required_if:booking_untuk_orang_lain,1|nullable|array',
            'id_number_tamu_lain.*' => function ($attribute, $value, $fail) use ($request) {
                $index = explode('.', $attribute)[1];
                $type = $request->id_type_tamu_lain[$index] ?? 'NIK';
                if ($type === 'NIK' && !preg_match('/^[0-9]{16}$/', $value)) {
                    $fail('Nomor Identitas Tamu (NIK) harus 16 digit angka.');
                }
                if ($type === 'Paspor' && (!ctype_alnum($value) || strlen($value) > 9)) {
                    $fail('Nomor Identitas Tamu (Paspor) maksimal 9 karakter huruf/angka.');
                }
            },
            'permintaan_khusus' => 'nullable|string',
        ]);

        $kamar = $this->loadKamar($id);
        $dates = $this->resolveDates($request);
        $pajak = $kamar->harga * 0.10;
        $total = ($kamar->harga * $dates['durasi']) + $pajak;

        $allocatedKamarId = $this->availability->findAvailableKamar($kamar->nama_tipe, $dates['checkin'], $dates['checkout']);

        if (!$allocatedKamarId) {
            return back()->withInput()->with('error', 'Tidak ada kamar tersedia untuk tipe ini pada tanggal yang dipilih.');
        }

        $allocatedKamar = Kamar::where('id_kamar', $allocatedKamarId)->first();

        $reservation = Reservation::create([
            'user_id' => $request->user()?->id,
            'room_type' => $kamar->nama_tipe,
            'room_number' => $allocatedKamar?->no_kamar ?? $allocatedKamarId,
            'kamar_id' => $allocatedKamarId,
            'nama_lengkap' => $request->nama_lengkap,
            'id_type' => $request->id_type,
            'id_number' => $request->id_number,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'jumlah_tamu' => $kamar->jumlah_tamu,
            'check_in_out' => $dates['checkin'] . ' to ' . $dates['checkout'],
            'check_in' => $dates['checkin'],
            'check_out' => $dates['checkout'],
            'status' => ReservationStatus::Temporary->value,
            'total_biaya' => $total,
            'nama_tamu_lain' => $request->has('nama_tamu_lain') && is_array($request->nama_tamu_lain) ? json_encode($request->nama_tamu_lain) : null,
            'id_type_tamu_lain' => $request->has('id_type_tamu_lain') && is_array($request->id_type_tamu_lain) ? json_encode($request->id_type_tamu_lain) : null,
            'id_number_tamu_lain' => $request->has('id_number_tamu_lain') && is_array($request->id_number_tamu_lain) ? json_encode($request->id_number_tamu_lain) : null,
            'permintaan_khusus' => $request->permintaan_khusus,
        ]);

        session(['booking_reservation_id' => $reservation->id]);

        return redirect()->route('booking.payment', [
            'reservation_id' => $reservation->id
        ]);
    }

    public function payment(Request $request, $reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        if (!in_array($reservation->status, ReservationStatus::payableValues(), true)) {
            return redirect()->route('home')->with('error', 'Reservasi ini sudah diproses atau tidak valid.');
        }

        if ($this->reservationService->expireIfTimedOut($reservation)) {
            session()->forget('booking_reservation_id');
            return redirect()->route('home')->with('error', 'Waktu pembayaran telah habis. Reservasi Anda dibatalkan otomatis.');
        }

        $reservation->refresh();

        $dates = $this->availability->parseReservationDates($reservation);
        $checkin = $dates ? $dates['start']->format('Y-m-d') : now()->format('Y-m-d');
        $checkout = $dates ? $dates['end']->format('Y-m-d') : now()->addDay()->format('Y-m-d');

        $start = Carbon::parse($checkin)->startOfDay();
        $end = Carbon::parse($checkout)->startOfDay();
        $durasi = max(1, $start->diffInDays($end));

        $kamar = (object) [
            'nama_tipe' => $reservation->room_type,
            'harga' => ($reservation->total_biaya / 1.1) / $durasi
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

        $reservation = Reservation::findOrFail($reservation_id);

        if (!in_array($reservation->status, ReservationStatus::payableValues(), true)) {
            return redirect()->route('home')->with('error', 'Reservasi ini sudah diproses atau dibatalkan.');
        }

        if ($this->reservationService->expireIfTimedOut($reservation)) {
            session()->forget('booking_reservation_id');
            return redirect()->route('home')->with('error', 'Waktu pembayaran telah habis. Reservasi Anda dibatalkan otomatis.');
        }

        $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $reservation->update([
            'payment_method' => $request->payment_method,
            'bukti_pembayaran' => $buktiPath,
            'status' => ReservationStatus::Pending->value,
        ]);

        $this->reservationService->markKamarTerisi($reservation);

        session()->forget('booking_reservation_id');

        return redirect()->route('home')->with('success', 'Pembayaran berhasil dikonfirmasi! Menunggu verifikasi resepsionis.');
    }

    public function cancelPayment(Request $request, $reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        if (in_array($reservation->status, ReservationStatus::payableValues(), true)) {
            $this->reservationService->cancel($reservation);
        }

        session()->forget('booking_reservation_id');

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('home')->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
