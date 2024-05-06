<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isSpeaker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->userRole->role_id == 4 ||  Auth::user()->userRole->role_id == 3){
            Auth::logout();
            return redirect()->back()->with('faild' , 'Désolé vous n\'avez la permission pour entre a le backofice');

        }else
        {
            return $next($request);
          
        }
        
       
    }
}
