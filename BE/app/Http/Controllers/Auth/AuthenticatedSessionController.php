<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('user.auth.login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $user = Auth::user();

        if (!$user->isActive()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Tài khoản của bạn đã bị khóa.');
        }

        if (is_null($user->email_verified_at)) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Vui lòng xác thực email trước khi đăng nhập.');
        }

        $request->session()->regenerate();

        if ($user->isAdmin()) {
            return redirect()->route('admin.home');
        }

        return redirect()->route('user.home');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
