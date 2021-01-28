<?php

namespace App\Http\Middleware;

use Closure;

class AuthActived
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->actived != 1) {
           auth()->logout();
           return  redirect()->route('login')->with('danger', 'Inactive account !!');
        }

        return $next($request);
    }
}
