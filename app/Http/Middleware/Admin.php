<?php

namespace App\Http\Middleware;

use Closure;
//include Auth class
use Illuminate\Support\Facades\Auth;

class Admin
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

        //check if the user is logged in
        if (Auth::check()) {
            //call the isAdmin() function in the User model
            if (Auth::user()->isAdmin()) {
                
                //excute next request
                return $next($request);
            }
            
        }//close if (Auth::check()) {

        return redirect('/'); 
    }
}
