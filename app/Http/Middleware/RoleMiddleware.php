<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== $role) {
            // Kalau role salah, arahkan ke dashboard sesuai role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Anda tidak punya akses ke halaman itu.');
            } elseif (Auth::user()->role === 'kurir') {
                return redirect()->route('kurir.dashboard')
                    ->with('error', 'Anda tidak punya akses ke halaman itu.');
            }

            // fallback
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        // kalau role sesuai, lanjutkan request
        return $next($request);
    }
}
