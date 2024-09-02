<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        if(session()->has('userdata'))
        {
            $sdata=session()->get('userdata');
           
            if($sdata->role_id===1 || $sdata->role_id===2 || $sdata->role_id === 3 || $sdata->role_id === 5)
            {
                return $next($request);
            }
            else{
                return redirect(route('index'));
            }
            
        }
        else{
            return redirect(route('index'));
        }
    }
    
}
