<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return void
     * @throws UnauthorizedException
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            throw new UnauthorizedException();
        }
    }
}
