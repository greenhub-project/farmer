<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfInsecure
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! app()->environment('production')) {
            return $next($request);
        }

        $request->setTrustedProxies([$request->getClientIp()], config('trustedproxy.headers'));
        if (! $request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
