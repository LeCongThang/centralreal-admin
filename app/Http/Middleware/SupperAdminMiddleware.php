<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SupperAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role_id)
            return $next($request);
        return redirect()->back()->with('flash','Bạn không có quyền truy cập');
    }
}
