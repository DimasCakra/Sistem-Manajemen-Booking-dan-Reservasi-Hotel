<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Interfaces\Searchable;

class TamuController extends Controller implements Searchable
{
    public function index(Request $request)
    {
        $checkin = $request->query(
            'checkin',
            now()->format('d-m-y')
        );

        $checkout = $request->query(
            'checkout',
            now()->addDay()->format('d-m-y')
        );

        $guests = $request->query(
            'guests',1
        );

        return view('home', compact(
            'checkin',
            'checkout',
            'guests'
        ));
    }


    public function tampilkanDashboard()
    {
        if (Auth::check()) {
            return view('profile.edit');
        }

        return redirect('/login')
            ->with('error', 'Silakan login untuk mengakses halaman ini.');
    }


    public function cariKamar(Request $request)
    {
        $checkin = $request->query('checkin');
        $checkout = $request->query('checkout');
        $guests = $request->query('guests');


        return redirect()->route('katalog.index', [
            'checkin' => $checkin,
            'checkout' => $checkout,
            'guests' => $guests
        ]);
    }


    public function pesanKamar()
    {
        return view('booking.biodata');
    }
}
