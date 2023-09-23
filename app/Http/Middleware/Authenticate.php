<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    // Override handle method
    public function handle($request, \Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }

    // Override authentication method
    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        $this->throwUnauthorizedException($request);
    }

    private function throwUnauthorizedException($request): void
    {
        throw new UnauthorizedException();
    }
}
