<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Interfaces\Searchable;

class TamuController extends Controller implements Searchable
{
    public function index(Request $request)
    {
        return view('home');
    }

    public function tampilkanDashboard()
    {
        if (Auth::check()) {
            return view('profile.edit');
        }
        return redirect('/login')->with('error', 'Silakan login untuk mengakses halaman ini.');
    }

    public function cariKamar(Request $request)
    {
        $checkin = $request->query('checkin');
        $checkout = $request->query('checkout');

        return redirect()->route('katalog.index', compact('checkin', 'checkout'));
    }

    public function pesanKamar()
    {
        return view('booking.biodata'); // Contoh halaman pemesanan
    }
}
