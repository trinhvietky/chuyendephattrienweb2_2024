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

        // Nếu user cố truy cập vào trang admin, trả về 404
        if ($request->is('admin/*') && $usertype !== '1') {
            abort(404);
        }

        // Nếu admin cố truy cập vào trang user, trả về 404
        if ($request->is('users/*') && $usertype !== '0') {
            abort(404);
        }
    }

    return $next($request);
}
}