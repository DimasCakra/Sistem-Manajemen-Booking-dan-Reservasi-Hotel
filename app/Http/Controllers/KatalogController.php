<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $checkin=$request->query('checkin', '01/04/2026');
        $checkout=$request->query('checkout', '02/04/2026');
        $guests=$request->query('guests', '2');

        $kamars = [
            (object)[
                'nama_tipe' => 'Standard Room',
                'harga' => 250000,
                'available' => 3,
                'rating' => 4.5,
                'fasilitas' => '1 Kasur, Shower, Ac, TV, Free Wifi.',
                'gambar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS1NqXfc76NEgfHnuMvMW0SDWcVo5R7eYHQew&s'
            ],
            (object)[
                'nama_tipe' => 'Deluxe Room',
                'harga' => 500000,
                'available' => 2,
                'rating' => 4.7,
                'fasilitas' => 'King Bed, Shower, Ac, TV, Free Wifi, City View,Breakfast',
                'gambar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtw7XVmGsO3uxNQV4B5Ma0UKNUE8k6iO_qAA&s'
            ],
            (object)[
                'nama_tipe' => 'Suite Room',
                'harga' => 750000,
                'available' => 1,
                'rating' => 4.9,
                'fasilitas' => 'Luxury Bed, Bathtub, Ac, TV, Free Wifi, Breakfast',
                'gambar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZb0u93Q8KlnMglct75zu5YAq_0veVnKch1Q&s'
            ],
        ];
        return view('katalog', compact('kamars', 'checkin', 'checkout', 'guests'));
    }
}