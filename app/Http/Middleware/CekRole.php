<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!session('login')) {
            return redirect('/login');
        }

        if (session('role') != $role) {
            return back();
        }

        return $next($request);
    }
}
