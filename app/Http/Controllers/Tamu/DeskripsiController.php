<?php

namespace App\Http\Controllers\Tamu;

use Illuminate\Http\Request;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\Tamu\KatalogController;

class DeskripsiController extends TamuController
{
    public function show($id)
    {
        $allKamars = KatalogController::$dataKamars;

        if (!isset($allKamars[$id])) {
            abort(404);
        }

        $kamar = (object) $allKamars[$id];

        return view('deskripsikamar', compact('kamar'));
    }
}
