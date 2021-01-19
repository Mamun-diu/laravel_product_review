<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $path = substr($request->path(),0,4);
        if($request->path()=='login' && $request->session()->has('user')){
            return Redirect()->back();
        }elseif($path == 'user' && !$request->session()->has('user')){
            return redirect('/login');
        }
        return $next($request);

    }
}
