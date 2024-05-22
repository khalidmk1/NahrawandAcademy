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
        if (Auth::check() && (Auth::user()->userRole->role_id == 4 || Auth::user()->userRole->role_id == 3)) {
            Auth::logout();
            return redirect()->route('login.create')->with('faild', 'Désolé vous n\'avez pas la permission pour entrer au backoffice');
        }

        return $next($request);
        
       
    }
}
