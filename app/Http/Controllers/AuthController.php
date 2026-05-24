<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Interfaces\Authenticable;

class AuthController extends Controller implements Authenticable
{
    public function login()
    {
        return redirect()->route('login');
    }

    public function logout()
    {
        return redirect()->route('login');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER USER
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('register');
    }

    public function processRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'whatsapp' => 'required|string|max:20',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'whatsapp' => $validatedData['whatsapp'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $request->session()->put('registered_user_id', $user->id);

        return redirect()->route('username');
    }

    /*
    |--------------------------------------------------------------------------
    | USERNAME SETUP
    |--------------------------------------------------------------------------
    */

    public function showUsername(Request $request)
    {
        if (!$request->session()->has('registered_user_id')) {
            return redirect()->route('register');
        }

        return view('username');
    }

    public function processUsername(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
        ]);

        $userId = $request->session()->get('registered_user_id');

        if (!$userId) {
            return redirect()->route('register');
        }

        $user = User::find($userId);

        if ($user) {
            $user->username = $validatedData['username'];
            $user->save();
        }

        $request->session()->forget('registered_user_id');

        return redirect()->route('login')
            ->with('success', 'Username berhasil disimpan. Silakan login.');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN USER / GUEST
    |--------------------------------------------------------------------------
    */

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
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN STAFF
    |--------------------------------------------------------------------------
    */

    public function showStaffLogin()
    {
        return view('admin.stafflogin');
    }

    public function processStaffLogin(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|string|in:admin,receptionist',
        ]);

        $loginData = $request->only('name', 'password');

        if (Auth::guard('staff')->attempt($loginData, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $staff = Auth::guard('staff')->user();

            if ($staff->role === 'admin' || $staff->role === 'receptionist') {
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'name' => 'Nama akun, password, atau role salah.',
        ])->onlyInput('name');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logoutGuest(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function logoutStaff(Request $request)
    {
        Auth::guard('staff')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('staff.login');
    }
}
