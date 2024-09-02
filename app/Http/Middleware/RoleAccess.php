<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class RoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */




    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // return $next($request);
        if (session()->has('userdata')) {
            $userRoles = session('userdata')->role_id;
            // echo "<pre>";
            // print_r($roles);
            // die();
            foreach ($roles as $role) {
                if ($userRoles == $role) {
                    return $next($request);
                }
            }
        }

        return redirect(route('index'))->with('error', 'Unauthorized Access');
    }


}


