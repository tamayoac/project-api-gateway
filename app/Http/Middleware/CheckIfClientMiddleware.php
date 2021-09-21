<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class CheckIfClientMiddleware
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
        
        $user = User::where('email',$request->username)->first();

        if(!is_null($user)) {
            if($user->hasRole("client")) {
                
                return $next($request);
            }   
        }
        abort(400, 'Bad Request');    
       
    }
}
