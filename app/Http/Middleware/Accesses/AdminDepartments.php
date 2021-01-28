<?php

namespace App\Http\Middleware\Accesses;

use Closure;

class AdminDepartments
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
        if(auth()->user()->department->id === 1) {
            auth()->logout();
            return  redirect()->route('login')->with('danger', 'Sorry your account can not access !!');           
        }
        elseif(auth()->user()->department->id === 2) {
            auth()->logout();
            return  redirect()->route('login')->with('danger', 'Sorry your account can not access !!');           
        }
        elseif(auth()->user()->department->id === 3) {
            auth()->logout();
            return  redirect()->route('login')->with('danger', 'Sorry your account can not access !!');           
        }
        elseif(auth()->user()->department->id === 4) {
            return  redirect()->route('admin.hrd.home.index');         
        }
        elseif(auth()->user()->department->id === 5) {
            auth()->logout();
            return  redirect()->route('login')->with('danger', 'Sorry your account can not access !!');           
        }
        elseif(auth()->user()->department->id === 6) {
            auth()->logout();
            return  redirect()->route('login')->with('danger', 'Sorry your account can not access !!');           
        }
        elseif(auth()->user()->department->id === 7) {
            auth()->logout();
            return  redirect()->route('login')->with('danger', 'Sorry your account can not access !!');           
        }
        elseif(auth()->user()->department->id === 8) {
            auth()->logout();
            return  redirect()->route('login')->with('danger', 'Sorry your account can not access !!');           
        }
        elseif(auth()->user()->department->id === 9) {
            auth()->logout();
            return  redirect()->route('login')->with('danger', 'Sorry your account can not access !!');           
        }

        return $next($request);
    }
}
