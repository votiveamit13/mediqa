<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AgencyAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('agencies')->check()) {
            if (Auth::guard('agencies')->user()->emailVerified == 0) {
              
                return redirect()->route('agencies.email-verification-pending');
                 
            }elseif(Auth::guard('agencies')->user()->user_stage == 1) {
               
                // return redirect()->route('nurse.my-profile');
                // return redirect()->route('nurse.profile-under-reviewed');
            }elseif(Auth::guard('agencies')->user()->status == 2) {
               
                 return redirect()->route('agencies.logout');
            }
        }
        if (!Auth::guard('agencies')->check()) {
            return redirect()->route('agencies.logout');
        } else {
            return $next($request);
        }
    }
}
