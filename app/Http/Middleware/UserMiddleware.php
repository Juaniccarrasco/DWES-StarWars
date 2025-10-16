<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //put
        if(str_contains($request->path(), 'put')&& $request->route()->hasParameter('id') && $request->has(['user_name','pass','mail'])){
                return $next($request);
                //delete y patch
        }else if($request->route()->hasParameter('id')){
            return $next($request);
            //register
        }else if($request->has(['user_name','pass','mail'])){
            return $next($request);
        }
        else {
            return response()->json([
                "mensaje"=>"Faltan datos del usuario"
            ], 401);
        }
        
    }
}
