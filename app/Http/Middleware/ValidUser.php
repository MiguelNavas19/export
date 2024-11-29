<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ValidUser
{

    public function handle(Request $request, Closure $next): Response
    {
        //return $next($request);

        $user = Auth::user(); // Obtener el usuario autenticado

        // Verificar si el usuario está autenticado y su ID es 1, 2 o 3
        if ($user && in_array($user->id, [1, 2, 3])) {
            // Verificar si el usuario tiene permiso para ver el recurso
            if ($user) {

                return $next($request); // Permitir el acceso

            } else {

                return response()->json(['message' => 'Acceso denegado. Permisos insuficientes.'], 403);
            }
        }
        session(['show_button' => false]);

        return response()->json(['message' => 'Acceso denegado. Usuario no autorizado.'], 403);

    }
}
