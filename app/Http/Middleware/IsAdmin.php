<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        // if (Auth::check() && Auth::user()->is_admin) {
            // return $next($request);
        // }
        $user = Auth::user();
        if ($user) {
            $roles = $user->roles;
            foreach ($roles as $role) {
                if($role->id == 1){
                    return $next($request);
                }
            }
            
        }else{
            return redirect('/login')->with('error', 'You are not authorised to access admin pages.');
        }
        
    }
}
