<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(!Auth::check()) {
            if (Auth::user()->role !== $role) {
                return redirect()->route('index');
            }else {
                return redirect()->route('admin.login');
            }
        }

        // if (!$request->user()->hasRole($role)) {
        //     abort(403, 'Unauthorized');
        // }

        return $next($request);
    }
}