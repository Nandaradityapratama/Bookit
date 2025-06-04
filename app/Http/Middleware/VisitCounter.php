<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VisitCounter
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Inisialisasi counter jika belum ada
        if (!Session::has('visit_count')) {
            Session::put('visit_count', 0);
        }

        // Tambah counter
        Session::increment('visit_count');
        
        // Simpan halaman terakhir yang dikunjungi
        Session::put('last_visited', $request->path());

        return $next($request);
    }
}
