<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthenticatePeserta
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
        if (!Session::has('peserta_logged_in')) {
            return redirect()->route('login')->withErrors(['auth_error' => 'Silakan login untuk melanjutkan.']);
        }

        return $next($request);
    }
}
