<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class sessionCounter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->session < 3) {
            User::where('username', auth()->user()->username)->update(['session' => '0']);
            return $next($request);
        }

        auth()->logout();
        Alert::error('Oopss.. Sorry!', 'You have 5 times wrong passwords, the system was forced to block your account, please contact the administrator to restore it back :(');
        return to_route('login');
    }
}
