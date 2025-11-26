<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards)
{
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {

            $role = Auth::user()->role;

            if ($role === 'super_admin') {
                return redirect('/superadmin/dashboard');
            } 
            elseif ($role === 'agent') {
                return redirect('/agent/dashboard');
            } 
            elseif ($role === 'student') {
                return redirect('/student/dashboard');
            }
            else{
                return redirect('/student/dashboard');
            }
        }
    }

    return $next($request);
}

}
