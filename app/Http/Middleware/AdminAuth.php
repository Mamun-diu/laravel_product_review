<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
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
        $path = substr($request->path(), 0, 5);
        if($request->path()=='super/login' && $request->session()->has('admin')){
            return redirect('/admin');
        }elseif($path=='admin' && !$request->session()->has('admin')){
            return redirect('/super/login');
        }
        return $next($request);
    }
}
