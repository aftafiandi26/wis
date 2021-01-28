<?php

namespace App\Http\Middleware\Admin;

use Closure;

class SuperAdmin
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
        if(auth()->user()->roles[0]['name'] != 'superAdmin') {
           auth()->logout();
           return  redirect()->route('login')->with('danger', 'Sorry your account can not access !!');
        }
        return $next($request);
    }
}
