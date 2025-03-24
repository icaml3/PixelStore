@extends('user.layouts.app')

@section('title', 'PixelStore - Quên mật khẩu')

@section('content')
<section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('/img/bg-img/bg-1.jpg') }});">
    <div class="bradcumbContent">
        <p>Chào mừng bạn!</p>
        <h2>Quên mật khẩu</h2>
    </div>
</section>

<!-- ##### Login Area Start ##### -->
<section class="login-area section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="login-content">
                    <h3>Quên mật khẩu</h3>
                    <!-- Login Form -->
                    <div class="login-form">
                        <!-- Thông báo hướng dẫn -->
                        <div class="mb-4 text-muted">
                            {{ __('Quên mật khẩu của bạn? Không có gì. Chỉ cần cho chúng tôi biết địa chỉ email của bạn và chúng tôi sẽ gửi email cho bạn một liên kết đặt lại mật khẩu cho phép bạn chọn một địa chỉ mới.') }}
                        </div>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success mb-4" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Hiển thị thông báo lỗi chung -->
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ Email</label>
                                <input id="exampleInputEmail1"
                                       class="form-control @error('email') is-invalid @enderror"
                                       type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="Nhập email của bạn"
                                       required
                                       autofocus />
                                <small class="form-text text-muted">
                                    <i class="fa fa-lock mr-2"></i>Chúng tôi sẽ không bao giờ chia sẻ email của bạn với bất kỳ ai khác.
                                </small>
                            </div>

                            <button type="submit" class="btn oneMusic-btn mt-30">
                                {{ __('Gửi đến Email của bạn!') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
