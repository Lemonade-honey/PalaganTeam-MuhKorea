<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        // $roles = explode(",", $role);
        if(!$request->user() || !Auth::user()){
            abort(403, "Undefine User");
        }else if(!in_array(Auth::user()->role, $role)){
            abort(403, 'Access Denied');
            // echo $role;
        }
        return $next($request);
    }
}
