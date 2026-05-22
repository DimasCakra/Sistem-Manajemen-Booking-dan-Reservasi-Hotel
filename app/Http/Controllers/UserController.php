<?php

namespace App\Http\Controllers;

use App\Models\User; // Penting untuk mengimpor model User
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan semua data user tanpa tabel.
     */
    public function showUsers()
    {
        // Mengambil semua data dari tabel users
        $users = User::get(); 

        // Mengirimkan variabel $users ke file view bernama 'viewuser.blade.php'
        return view('viewuser', compact('users'));
    }
}