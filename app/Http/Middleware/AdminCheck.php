<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminCheck
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek pakai Auth Laravel, bukan session manual
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak! Anda bukan admin.');
        }

        return $next($request);
    }
}