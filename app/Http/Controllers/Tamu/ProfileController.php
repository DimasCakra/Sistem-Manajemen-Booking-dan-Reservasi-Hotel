<?php

namespace App\Http\Controllers\Tamu;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TamuController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends TamuController
{
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:50',
        'username' => 'nullable|string|max:30|unique:users,username,' . $user->id,
        'email' => 'required|string|email|max:30|unique:users,email,' . $user->id,
        'whatsapp' => 'nullable|string|max:18',
        'tanggal_lahir' => 'nullable|date',

        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // upload foto baru
    if ($request->hasFile('photo')) {

        // hapus foto lama
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $photoPath = $request->file('photo')->store('foto_profil', 'public');

        $user->photo = $photoPath;
    }

    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->whatsapp = $request->whatsapp;
    $user->tanggal_lahir = $request->tanggal_lahir;

    // update password kalau diisi
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('profile.edit')
        ->with('success', 'Profil berhasil diperbarui.');
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
