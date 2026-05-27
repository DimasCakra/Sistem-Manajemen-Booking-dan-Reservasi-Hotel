<?php

namespace App\Http\Interfaces;
use Illuminate\Http\Request;

interface Searchable
{
    public function cariKamar(Request $request);
}
