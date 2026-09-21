<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    /**
     * Bloqueia o acesso ao restante da API se o usuário autenticado
     * ainda estiver com a senha padrão (deve_trocar_senha = true).
     * A rota de trocar senha e a de logout continuam liberadas mesmo
     * nesse estado, senão o usuário ficaria travado sem conseguir
     * trocar a própria senha.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        $rotasLiberadas = ['auth/trocar-senha', 'auth/logout'];

        if ($user
            && in_array('deve_trocar_senha', $user->getFillable())
            && $user->deve_trocar_senha
            && ! $request->is(...array_map(fn ($r) => 'api/v1/'.$r, $rotasLiberadas))
        ) {
            return response()->json([
                'message' => 'Você precisa trocar sua senha padrão antes de continuar.',
                'deve_trocar_senha' => true,
            ], 403);
        }

        return $next($request);
    }
}
