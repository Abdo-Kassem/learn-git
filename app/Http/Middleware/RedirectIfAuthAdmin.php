<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthAdmin
{
   
    public function handle(Request $request, Closure $next)
    {
        if( auth()->guard('admin')->check() ){
            return redirect()->route('admin.index');
        }

        return $next($request);
    }
}
