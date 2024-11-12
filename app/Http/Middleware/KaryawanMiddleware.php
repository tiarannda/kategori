<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class KaryawanMiddleware
{
    public function handle($request, Closure $next)
    {
        // Periksa apakah pengguna sudah login dan memiliki role 'karyawan'
        if (Auth::check() && Auth::user()->role === 'karyawan') {
            return $next($request);
        }

        // Jika pengguna bukan 'karyawan', arahkan ke halaman lain atau tampilkan pesan error
        return redirect('/unauthorized')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
