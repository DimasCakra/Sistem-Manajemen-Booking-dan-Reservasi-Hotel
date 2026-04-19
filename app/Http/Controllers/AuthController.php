<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'whatsapp' => 'required|string|max:20',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'password' => Hash::make($request->password),
        ]);

        // Simpan id user ke session untuk proses set username
        $request->session()->put('registered_user_id', $user->id);

        return redirect()->route('username');
    }

    public function showUsername(Request $request)
    {
        // Pastikan ada user yang baru registrasi di session
        if (!$request->session()->has('registered_user_id')) {
            return redirect()->route('register');
        }
        return view('username');
    }

    public function processUsername(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
        ]);

        $userId = $request->session()->get('registered_user_id');
        
        if (!$userId) {
            return redirect()->route('register');
        }

        $user = User::find($userId);
        if ($user) {
            $user->username = $request->username;
            $user->save();
        }

        // Hapus session setelah berhasil set username
        $request->session()->forget('registered_user_id');

        return redirect()->route('login')->with('success', 'Username berhasil disimpan. Silakan login.');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function processResepsionisLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('receptionist')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('receptionist');
        }

        return back()->withErrors([
            'email' => 'Email atau password resepsionis salah.',
        ])->onlyInput('email');
    }
}
