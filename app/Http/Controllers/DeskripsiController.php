<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\KatalogController;

class DeskripsiController extends Controller
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