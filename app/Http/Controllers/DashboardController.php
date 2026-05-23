<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('staff')->user();

        // Polymorphism berdasarkan role
        if ($user->role === 'admin') {
            return $this->adminDashboard();
        }

        elseif ($user->role === 'receptionist') {
            return $this->receptionistDashboard();
        }

        abort(403, 'Role tidak dikenali');
    }

    // Dashboard Admin
    protected function adminDashboard()
    {
        return redirect()->route('admin.kamar');
    }

    // Dashboard Resepsionis
    protected function receptionistDashboard()
    {
        return redirect()->route('receptionist.index');
    }
}