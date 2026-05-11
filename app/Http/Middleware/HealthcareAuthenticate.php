<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class HealthcareAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('healthcare_facilities')->check()) {
            if (Auth::guard('healthcare_facilities')->user()->emailVerified == 0) {
               
                    return redirect()->route('medical-facilities.email-verification-pending');
            
                // return redirect()->route('nurse.email-verification-pending');
                 
            }elseif(Auth::guard('healthcare_facilities')->user()->user_stage == 1) {
               
                // return redirect()->route('nurse.my-profile');
                // return redirect()->route('nurse.profile-under-reviewed');
            }elseif(Auth::guard('healthcare_facilities')->user()->status == 2) {
               
                 return redirect()->route('medical-facilities.logout');
            }
        }
        if (!Auth::guard('healthcare_facilities')->check()) {
            return redirect()->route('medical-facilities.logout');
        } else {
            return $next($request);
        }
    }
}
