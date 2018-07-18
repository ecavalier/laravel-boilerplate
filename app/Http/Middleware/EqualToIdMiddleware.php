<?php

namespace App\Http\Middleware;

use Closure;

class EqualToIdMiddleware
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
        if ($request->user()->id === (integer) $request->route()->parameter('id')) {
            return $next($request);
        }
        abort(404);
    }
}
