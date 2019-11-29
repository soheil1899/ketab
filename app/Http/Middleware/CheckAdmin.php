<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Permissions;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{


    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            $userid = auth()->user()->id;
            if ($userid == 1){
                return $next($request);
            }else{
                return redirect('/');
            }

        } else {
            return redirect('/');

        }
    }
}
