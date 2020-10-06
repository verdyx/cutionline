<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 'Admin') {
                return $next($request);
            } elseif ($user->role == 'Pegawai') {
                return $next($request);
            }
        }

        return $next($request);
    }
}
