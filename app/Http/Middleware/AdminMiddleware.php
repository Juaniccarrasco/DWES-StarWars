<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        $admin_name = $request->input("admin_name");
        $admin_pass = $request->input("admin_pass");
        if (!$admin_name || !$admin_pass) {
            return response()->json([
                "mensaje"=>"Faltan datos de credenciales del administrador"
            ], 401);
        }
        return $next($request);
    }
}
