<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureStaffRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $staff = Auth::guard('staff')->user();

        if (!$staff || $staff->role !== $role) {
            abort(403, 'Akses ditolak untuk role Anda.');
        }

        return $next($request);
    }
}
