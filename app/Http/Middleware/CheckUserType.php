<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $type
     * @return mixed
     */
    public function handle($request, Closure $next)
{
    if (Auth::check()) {
        $usertype = Auth::user()->usertype;

        // Kiểm tra nếu người dùng là user và cố truy cập trang dashboard (admin)
        if ($usertype === '0' && $request->is('dashboard')) {
            if ($request->is('dashboard') && $usertype !== '1') {
                return redirect('/home');
            }
        }
    }

    return $next($request);
}
}