<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->user_lvl == 4){
                $this->redirectTo = '/procurement/items';
                return $this->redirectTo;   
            }
            if(Auth::user()->user_lvl == 3){
                $this->redirectTo = '/bac/users';
                return $this->redirectTo;   
            }
            if(Auth::user()->user_lvl == 2){
                $this->redirectTo = '/vp/approvals';
                return $this->redirectTo;   
            }
            if(Auth::user()->user_lvl == 5){
                $this->redirectTo = '/budget/submissions';
                return $this->redirectTo;   
            }
            if(Auth::user()->user_lvl == 6){
                $this->redirectTo = '/user/submission';
                return $this->redirectTo;      
            }
            if(Auth::user()->user_lvl == 1){
                $this->redirectTo = '/op/approvals';
                return $this->redirectTo;      
            }
        }

        return $next($request);
    }
}
