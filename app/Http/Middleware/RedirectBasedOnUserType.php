<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectBasedOnUserType
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
        if (auth()->check()) {
            $user = auth()->user();
            
            // If user is admin and trying to access user area, redirect to admin
            if ($user->isAdmin() && $request->is('userform')) {
                return redirect('/admin');
            }
            
            // If user is regular user and trying to access admin area, redirect to userform
            if ($user->isUser() && $request->is('admin*')) {
                return redirect('/userform');
            }
        }
        
        return $next($request);
    }
}
