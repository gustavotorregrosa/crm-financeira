<?php

namespace App\Http\Middleware;

use Closure;

class VerificaPerfil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $perfilnecessario)
    {

        $usuario = \Auth::user();
        $perfil = $usuario->perfilUsuario->nome;
        $perfilnecessario = strtolower($perfilnecessario);

        if($perfil != $perfilnecessario){
            \Session::put('erro', 'usuario sem perfil necessario');
            return redirect('/mensagens');
        }

        return $next($request);
    }
}
