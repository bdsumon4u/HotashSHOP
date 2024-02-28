<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\GoogleTagManager\GoogleTagManagerFacade;

class GoogleTagManagerMiddleware
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
        config(['googletagmanager.id' => setting('gtm_id') ?? 'gtm_id']);
        GoogleTagManagerFacade::setId(config('googletagmanager.id'));

        return $next($request);
    }
}
