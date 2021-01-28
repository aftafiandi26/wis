<?php

namespace App\Http\Middleware\Departments;

use Closure;

class HR
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
         if(auth()->user()->department->id != 4) {
           auth()->logout();
           return  redirect()->route('login')->with('danger', 'Sorry your account can not access !!');
        }
        return $next($request);
    }
}
