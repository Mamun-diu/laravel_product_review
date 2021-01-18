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
        if($request->path()=='admin/login' && $request->session()->has('admin')){
            return redirect('/admin');
        }elseif($request->path()=='admin' && !$request->session()->has('admin')){
            return redirect('/admin/login');
        }
        return $next($request);
    }
}
