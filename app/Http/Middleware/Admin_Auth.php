<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin_Auth
{
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(Auth::user())){
            if(url()->current()==route('auth#login')|| url()->current()==route('auth#register')){
                return back();
            }

            if(Auth::user()->role=='user'){
                return back();
            }
            return $next($request);
        }

        return $next($request);
    }
}