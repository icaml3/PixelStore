@extends('layouts.app')

@section('title', 'PixelStore - Đăng nhập')

@section('content')
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('/img/bg-img/bg-1.jpg') }});">
        <div class="bradcumbContent">
            <p>Chào mừng bạn!</p>
            <h2>Đăng nhập</h2>
        </div>
    </section>

    <!-- ##### Login Area Start ##### -->
    <section class="login-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="login-content">
                        <h3>Đăng nhập</h3>
                        <!-- Login Form -->
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

                            <form action="{{ route('login') }}" method="post">
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
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="exampleInputPassword1"
                                           name="password"
                                           placeholder="Password"
                                           required>
                                </div>

                                <button type="submit" class="btn oneMusic-btn mt-30">Đăng nhập</button>
                                <small class="form-text text-muted">
                                    <i class="fa fa-lock mr-2"></i>Bạn chưa có tài khoản?
                                    <a href="{{ route('register') }}" class="text-decoration-none">Đăng ký</a> tại đây
                                </small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
