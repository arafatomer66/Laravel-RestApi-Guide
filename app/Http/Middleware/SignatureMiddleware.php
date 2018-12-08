<?php

namespace App\Http\Middleware;

use Closure;

class SignatureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $headerName ='X-name')
    {
        // return $next($request);  this is a after execution . we need before execution

        $response =  $next($request);

        $response->headers = set($headerName ,config('app.name'));

        return $response ;
     }
}
