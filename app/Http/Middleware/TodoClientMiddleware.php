<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TodoClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->hasRole("Client") && !auth()->user()->hasApp("app_todo")) {
            abort(401, 'This action is unauthorized.');
        }
        return $next($request);
    }
}
