namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MultiAuthBroadcast
{
    public function handle($request, Closure $next)
    {
        if (
            Auth::guard('nurse_middle')->check() ||
            Auth::guard('healthcare_facilities')->check()
        ) {
            return $next($request);
        }

        return response('Unauthorized', 403);
    }
}