<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class VisitorMiddleware
{
    
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('visitor')->user()){
            return $next($request);
        }
        return redirect('visitor/login');
    }
}
