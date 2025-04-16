<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($role === 'admin' && !$user->isAdmin()) {
            return redirect()->route('user.home')->with('error', 'Bạn không có quyền truy cập khu vực Admin.');
        }

        if ($role === 'user' && !$user->isUser()) {
            return redirect()->route('admin.home')->with('error', 'Bạn không có quyền truy cập khu vực User.');
        }

        return $next($request);
    }
}
