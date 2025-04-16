<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class RoleAdmin
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Vui lòng đăng nhập',
                'status' => false,
            ], 401);
        }

        $user = Auth::user();

        if ($role === 'admin' && !$user->isAdmin()) {
            return response()->json([
                'message' => 'Bạn không có quyền truy cập. Chỉ admin mới có thể truy cập.',
                'status' => false,
            ], 403);
        }

        if ($role === 'user' && !$user->isUser()) {
            return response()->json([
                'message' => 'Bạn không có quyền truy cập. Chỉ người dùng thường mới có thể truy cập.',
                'status' => false,
            ], 403);
        }

        return $next($request);
    }
}
