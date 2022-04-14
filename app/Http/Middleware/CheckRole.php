<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,...$roles)
    {
        $result = [];
        foreach($roles as $role){
            $result[] = str_contains($role, '*')?str_contains($request->user()->role, rtrim($role, '*')):$request->user()->role == $role;
        }
        return in_array(true, $result)? $next($request) : back();
    }
}
