<?php

namespace App\Http\Middleware;

use Closure;
use Hash;
use Illuminate\Http\Response;

class CheckPassword
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        $currentPassword = $request->input('current_password', null);
        if (!$currentPassword || !Hash::check($currentPassword, $user->password)) {
            return response()->json(['message' => 'Senha atual inválida', 'code' => Response::HTTP_FORBIDDEN], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
