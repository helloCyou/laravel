<?php

namespace App\Http\Middleware;

use Closure;

class FindName
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request){
            echo "aaa";
        }
        return $next($request);
    }
}
