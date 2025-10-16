<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->has(['name_ship','tripulation','passengers'])){
            return $next($request);

        }else{
            return response()->json([
                "mensaje"=>"Faltan datos para subir una nave"
            ], 401);
        }
        

        


    }
}
