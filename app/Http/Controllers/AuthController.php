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
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'whatsapp' => 'required|string|max:20|unique:users,whatsapp',
            'password' => 'required|string|min:8',
        ]);

        $registrationData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'whatsapp' => $validatedData['whatsapp'],
            'password' => Hash::make($validatedData['password']),
        ];

        $request->session()->put('registration_data', $registrationData);

        return redirect()->route('id_number');
    }

    /*
    |--------------------------------------------------------------------------
    | Nomor Identitas SETUP
    |--------------------------------------------------------------------------
    */

    public function showNik(Request $request)
    {
        if (!$request->session()->has('registration_data')) {
            return redirect()->route('register');
        }

        return view('id_number');
    }

    public function processNik(Request $request)
    {
        $validatedData = $request->validate([
            'id_type' => 'required|in:NIK,Paspor',
            'id_number' => [
                'required',
                'string',
                $request->id_type === 'NIK' ? 'numeric' : 'alpha_num',
                $request->id_type === 'NIK' ? 'digits:16' : 'max:9',
                'unique:users,id_number'
            ],
        ]);

        $registrationData = $request->session()->get('registration_data');

        if (!$registrationData) {
            return redirect()->route('register');
        }

        User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'whatsapp' => $registrationData['whatsapp'],
            'password' => $registrationData['password'],
            'id_type' => $validatedData['id_type'],
            'id_number' => $validatedData['id_number'],
        ]);

        $request->session()->forget('registration_data');

        return redirect()->route('login')
            ->with('success', 'Pendaftaran berhasil! Silakan masuk dengan akun Anda.');
    }

    public function cancelRegister(Request $request)
    {
        $request->session()->forget('registration_data');

        return redirect()->route('register');
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

        $loginData = $request->only('name', 'password', 'role');

        if (Auth::guard('staff')->attempt($loginData, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
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
