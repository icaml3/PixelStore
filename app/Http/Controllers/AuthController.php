<?php

namespace App\Http\Controllers;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits_between:10,15|unique:users,phone',
            'role' => 'required|in:0,1',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors(),
            ], 422);
        }
        $user = User::create([
            'full_name' => $input['full_name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'role' => 0,
            'password' => bcrypt($input['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Đăng kí thành công',
            'data' => ['token' => $token],
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !password_verify($request->input('password'), $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Email hoặc mật khẩu không đúng',
                'data' => [],
            ], 401);
        }

        if (!$user->isActive()) {
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản của bạn đã bị khóa',
                'data' => [],
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Đăng nhập thành công',
            'data' => ['token' => $token],
        ], 200);
    }

    public function requestLogin()
    {
        return response()->json([
            'status' => false,
            'message' => 'Vui lòng đăng nhập',
            'data' => [],
        ], 401);
    }

    public function logout(Request $request)
    {
        if (!$request->user()) {
            return response()->json([
                'status' => false,
                'message' => 'Vui lòng đăng nhập',
                'data' => [],
            ], 401);
        }

        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Đăng xuất thành công',
            'data' => [],
        ], 200);
    }
}
