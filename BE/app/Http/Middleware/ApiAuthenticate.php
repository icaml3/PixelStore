<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class ApiAuthenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if ($request->expectsJson()) {
            // Don't redirect for API requests
            return null;
        }

        return route('login');
    }

    // Optionally override the handle method for custom JSON response
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            return parent::handle($request, $next, ...$guards);
        } catch (\Illuminate\Auth\AuthenticationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vui lòng đăng nhập',
                    'data' => [],
                ], 401);
            }
            throw $e;
        }
    }
}
