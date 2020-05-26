<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use Session;

use Illuminate\Http\Response;


class ProcurementMiddleware
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
        if (Auth::user()) {
            if($request->user()->user_lvl !==4){
                Session::flash('fail', 'Unauthorized Access');
                return new Response(view('unauthorized'));
            }
        } 

        return $next($request);
    }
}
