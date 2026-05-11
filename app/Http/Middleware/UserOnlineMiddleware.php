<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\UserOnlineStatus;

class UserOnlineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('nurse_middle')->check() ? Auth::guard('nurse_middle')->user() :
                (Auth::guard('healthcare_facilities')->check() ? Auth::guard('healthcare_facilities')->user() :
                (Auth::check() ? Auth::user() : null));

        if ($user) {
            // Update user's online status in cache
            cache()->set("user_{$user->id}_online", true, now()->addMinutes(5));

            // Broadcast online status to all relevant channels
            try {
                broadcast(new UserOnlineStatus($user->id, true, null));
            } catch (\Exception $e) {
                \Log::error('Failed to broadcast online status: ' . $e->getMessage());
            }
        }

        return $next($request);
    }
}
