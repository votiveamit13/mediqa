<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class NurseAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('nurse_middle')->check()) {
            if (Auth::guard('nurse_middle')->user()->emailVerified == 0) {
               if(request()->is('nurse/dashboard')){
                    return redirect()->route('nurse.my-profile');
            }
                // return redirect()->route('nurse.email-verification-pending');
                 
            }elseif(Auth::guard('nurse_middle')->user()->user_stage == 1) {
               
                // return redirect()->route('nurse.my-profile');
                // return redirect()->route('nurse.profile-under-reviewed');
            }elseif(Auth::guard('nurse_middle')->user()->status == 2) {
               
                 return redirect()->route('nurse.logout');
            }
        }
        if (!Auth::guard('nurse_middle')->check()) {
            return redirect()->route('nurse.logout');
        } else {
            return $next($request);
        }
    }
}
