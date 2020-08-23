<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param    $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        if (! $request->user()->hasRole($role)) {
            redirect('/home');
        }

        if($request->user()->isAdmin){
            redirect('/admin/dashboard');
        }

        return $next($request);
    }
}
