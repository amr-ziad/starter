<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAge
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

        //login middleware

       $age= Auth::user()->age; // Auth::id();
        if ($age < 15){          //($request-> age < 15) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
