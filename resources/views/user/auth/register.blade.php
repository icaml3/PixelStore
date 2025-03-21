@extends('user.layouts.app')

@section('title', 'PixelStore - Đăng ký')

@section('content')
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('/img/bg-img/bg-1.jpg') }});">
        <div class="bradcumbContent">
            <p>Chào mừng bạn!</p>
            <h2>Đăng ký</h2>
        </div>
    </section>

    <!-- ##### Register Area Start ##### -->
    <section class="login-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="login-content">
                        <h3>Đăng ký</h3>
                        <!-- Register Form -->
                        <div class="login-form">
                            <!-- Hiển thị thông báo -->
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('register') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="exampleInputEmail1"
                                           name="email"
                                           value="{{ old('email') }}"
                                           aria-describedby="emailHelp"
                                           placeholder="Enter E-mail"
                                           required>
                                    <small id="emailHelp" class="form-text text-muted">
                                        <i class="fa fa-lock mr-2"></i>Chúng tôi sẽ không bao giờ chia sẻ email của bạn với bất kỳ ai khác.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mật khẩu</label>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="exampleInputPassword1"
                                           name="password"
                                           placeholder="Password"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPasswordConfirmation">Xác nhận mật khẩu</label>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="exampleInputPasswordConfirmation"
                                           name="password_confirmation"
                                           placeholder="Xác nhận mật khẩu"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFullName">Họ và tên</label>
                                    <input type="text"
                                           class="form-control @error('full_name') is-invalid @enderror"
                                           id="exampleInputFullName"
                                           name="full_name"
                                           value="{{ old('full_name') }}"
                                           placeholder="Họ và tên"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPhone">Số điện thoại</label>
                                    <input type="tel"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           id="exampleInputPhone"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           placeholder="Số điện thoại"
                                           pattern="\d{10}"
                                           title="Số điện thoại phải có 10 chữ số"
                                           required>
                                </div>

                                <button type="submit" class="btn oneMusic-btn mt-30">Đăng ký</button>
                                <small class="form-text text-muted">
                                    <i class="fa fa-lock mr-2"></i>Bạn đã có tài khoản?
                                    <a href="{{ route('login') }}" class="text-decoration-none">Đăng nhập</a> tại đây
                                </small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
