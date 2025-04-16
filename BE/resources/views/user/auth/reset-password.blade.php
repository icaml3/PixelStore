@extends('user.layouts.app')

@section('title', 'PixelStore - Đặt lại mật khẩu')
@section('content')
<section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('/img/bg-img/bg-1.jpg') }});">
    <div class="bradcumbContent">
        <p>Chào mừng bạn!</p>
        <h2>Đặt lại mật khẩu</h2>
    </div>
</section>

<!-- ##### Login Area Start ##### -->
<section class="login-area section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="login-content">
                    <h3>Đặt lại mật khẩu</h3>
                    <!-- Login Form -->
                    <div class="login-form">
                        <!-- Hiển thị thông báo lỗi chung -->
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email Address -->
                            <div class="form-group">
                                <label for="email">Địa chỉ Email</label>
                                <input id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       type="email"
                                       name="email"
                                       value="{{ old('email', $request->email) }}"
                                       placeholder="Nhập email của bạn"
                                       required
                                       autofocus
                                       autocomplete="username" />
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">Mật khẩu mới</label>
                                <input id="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       type="password"
                                       name="password"
                                       placeholder="Nhập mật khẩu mới"
                                       required
                                       autocomplete="new-password" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="password_confirmation">Xác nhận mật khẩu</label>
                                <input id="password_confirmation"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       type="password"
                                       name="password_confirmation"
                                       placeholder="Xác nhận mật khẩu"
                                       required
                                       autocomplete="new-password" />
                            </div>

                            <button type="submit" class="btn oneMusic-btn mt-30">Đặt Lại Mật Khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
