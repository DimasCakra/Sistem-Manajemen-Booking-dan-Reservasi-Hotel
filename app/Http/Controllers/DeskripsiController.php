<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\KatalogController;

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
