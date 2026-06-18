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
        $reservations = \App\Models\Reservation::where('user_id', Auth::id())
            ->where('status', 'done')
            ->orderBy('id', 'desc')
            ->get();

        // Ambil review yang sudah diberikan oleh user ini untuk reservasi tersebut
        $reviews = \App\Models\Review::where('user_id', Auth::id())
            ->pluck('id', 'reservation_id')
            ->toArray();

        return view('profile.orders', compact('reservations', 'reviews'));
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $reservation = \App\Models\Reservation::where('user_id', Auth::id())->findOrFail($id);

        if ($reservation->status !== 'done') {
            return redirect()->back()->with('error', 'Reservasi belum selesai.');
        }

        $existingReview = \App\Models\Review::where('reservation_id', $id)->first();
        if ($existingReview) {
            return redirect()->back()->with('error', 'Anda sudah memberikan ulasan untuk pesanan ini.');
        }

        \App\Models\Review::create([
            'user_id' => Auth::id(),
            'reservation_id' => $reservation->id,
            'room_type' => $reservation->room_type,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('profile.orders')->with('success', 'Terima kasih atas ulasan Anda!');
    }

    public function reviews()
    {
        $reviews = \App\Models\Review::where('user_id', Auth::id())
            ->with('reservation')
            ->orderBy('id', 'desc')
            ->get();

        return view('profile.reviews', compact('reviews'));
    }
}
