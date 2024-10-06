<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next

     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {


            if (Auth::user()->role == 'admin') {

                return $next($request);
            }

            abort(403);
        }
        abort(401);
    }
}
