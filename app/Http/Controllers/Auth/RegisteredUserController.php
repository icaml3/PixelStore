<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users,phone', 'regex:/^\d{10}$/'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'full_name.required' => 'Vui lòng nhập họ và tên của bạn.',
            'full_name.string' => 'Họ và tên phải là một chuỗi ký tự.',
            'full_name.max' => 'Họ và tên không được dài quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập email của bạn.',
            'email.email' => 'Email không đúng định dạng, vui lòng kiểm tra lại.',
            'email.unique' => 'Email này đã được đăng ký, vui lòng sử dụng email khác.',
            'email.max' => 'Email không được dài quá 255 ký tự.',
            'phone.required' => 'Vui lòng nhập số điện thoại của bạn.',
            'phone.unique' => 'Số điện thoại này đã được đăng ký, vui lòng sử dụng số khác.',
            'phone.regex' => 'Số điện thoại phải có đúng 10 chữ số.',
            'phone.max' => 'Số điện thoại không được dài quá 255 ký tự.',
            'password.required' => 'Vui lòng nhập mật khẩu của bạn.',
            'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không khớp, vui lòng kiểm tra lại.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự, vui lòng nhập lại.',
        ]);

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 0, // Mặc định là user
            'status' => 1, // Mặc định là active
        ]);

        try {
            event(new Registered($user));
        } catch (\Exception $e) {
            \Log::error('Lỗi gửi email xác thực: ' . $e->getMessage());
        }

        Auth::login($user);

        if (!is_null($user->email_verified_at)) {
            if ($user->isAdmin()) {
                return redirect()->route('admin.home');
            }
            return redirect()->route('home');
        }

        return redirect()->route('dashboard');
    }
}
