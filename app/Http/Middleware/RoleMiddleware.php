<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // Cek role
        if (Auth::user()->role === $role) {
            return $next($request);
        }

        // Jika role tidak sesuai
        return redirect('/')->with('error', 'Anda tidak memiliki akses.');
    }
}
