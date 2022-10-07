<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param null|string              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return response()->json(['message' => 'Usuário está logado.', 'code' => Response::HTTP_FORBIDDEN], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
