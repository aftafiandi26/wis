<?php

namespace App\Http\Middleware\Admin;

use Closure;

class Admin
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
        if(auth()->user()->roles[0]['name'] != 'admin') {
           auth()->logout();
           return  redirect()->route('login')->with('danger', 'Sorry your account can not access !!');
        }
        return $next($request);
    }
}
