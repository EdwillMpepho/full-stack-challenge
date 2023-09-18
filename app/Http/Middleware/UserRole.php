<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        if(Auth::check() && Auth::user()->role == $role)
        {
            return $next($request);
        }
        return response()->json(['message' => 'you are not allowed to access the page'], 401);
    }
}
