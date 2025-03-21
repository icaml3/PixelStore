@extends('user.layouts.app')

@section('title', 'PixelStore - Dashboard')

@section('content')
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('/img/bg-img/bg-1.jpg') }});">
        <div class="bradcumbContent">
            <p>Chào mừng bạn!</p>
            <h2>Dashboard</h2>
        </div>
    </section>

    <section class="section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="dashboard-content">
                        @if (is_null(Auth::user()->email_verified_at))
                            <!-- Hiển thị thông báo xác thực email nếu chưa xác thực -->
                            <h3>Xác thực Email</h3>
                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success" role="alert">
                                    Một liên kết xác thực mới đã được gửi đến địa chỉ email của bạn.
                                </div>
                            @endif

                            <p>Trước khi tiếp tục, vui lòng kiểm tra email của bạn để tìm liên kết xác thực.</p>
                            <p>Nếu bạn không nhận được email, <a href="{{ route('verification.send') }}" onclick="event.preventDefault(); document.getElementById('resend-verification').submit();">nhấn vào đây để yêu cầu gửi lại</a>.</p>

                            <form id="resend-verification" method="POST" action="{{ route('verification.send') }}">
                                @csrf
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn oneMusic-btn mt-30">Đăng xuất</button>
                            </form>
                        @else
                            <!-- Hiển thị nội dung dashboard nếu đã xác thực -->
                            <h3>Xin chào, {{ Auth::user()->full_name }}!</h3>
                            <p>Đây là trang dashboard của bạn.</p>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn oneMusic-btn mt-30">Đăng xuất</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
