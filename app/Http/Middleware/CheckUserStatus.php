<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->use_status == false) {
                return redirect('login')->withErrors(['error' =>
                'Tu cuenta está desactivada. Por favor, contacta al administrador.']);
            }
        }

        return $next($request);
    }
}
