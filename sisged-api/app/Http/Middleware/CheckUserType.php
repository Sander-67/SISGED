<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    public function handle(Request $request, Closure $next, string $tipo): Response
    {
        $user = $request->user();

        if (! $user || ! $user->tokenCan($tipo)) {
            return response()->json(['message' => 'Acesso não autorizado para este tipo de usuário'], 403);
        }

        return $next($request);
    }
}