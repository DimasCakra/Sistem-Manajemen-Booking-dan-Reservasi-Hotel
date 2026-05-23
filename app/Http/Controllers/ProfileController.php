<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends TamuController
{
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        // Add actual update logic if needed
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function orders()
    {
        return view('profile.orders');
    }

    public function reviews()
    {
        return view('profile.reviews');
    }
}
