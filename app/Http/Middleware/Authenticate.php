<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    // Override handle method
    public function handle($request, \Closure $next, ...$guards)
    {
        try {
            $this->authenticate($request, $guards);
        } catch (UnauthorizedException $e) {
            if ($request->expectsJson()) {
                throw $e;
            }

            if (Str::contains($request->url(), '/app')) {
                return redirect()->route('login');
            }

            // avoid loop
            if (! Str::contains($request->url(), 'admin/login')) {
                return redirect()->route('filament.admin.auth.login');
            }
        }

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
