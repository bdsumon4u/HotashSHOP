<?php

namespace App\Http\Middleware;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Where to redirect unauthenticated users.
     *
     * @var string
     */
    protected $redirectModelNameTo = null;

    protected $redirectAdminTo = '/';
    protected $redirectUserTo = '/auth';

    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->shouldRedirectTo($request, $guards)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param array $guards
     * @return string|null
     */
    protected function shouldRedirectTo($request, array $guards)
    {
        if (! $request->expectsJson()) {
            $redirectTo = 'redirect'.Str::studly(Arr::get($guards, 0)).'To';

            if(!isset($this->$redirectTo) || is_null($this->$redirectTo)):
                $this->$redirectTo = route(Arr::get($guards, 0).'.login');
            endif;

            return $this->$redirectTo;
        }
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('/');
        }
    }
}
