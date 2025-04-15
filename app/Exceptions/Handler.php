<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // protected function unauthenticated($request, AuthenticationException $exception)
    // {
    //     return response()->json([
    //         'message' => 'Vui lòng đăng nhập',
    //         'status' => false,
    //     ], 401);
    // }
    public function render($request, Throwable $exception)
    {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vui lòng đăng nhập',
                    'data' => [],
                ], 401);
            }

        return parent::render($request, $exception);
    }

}
