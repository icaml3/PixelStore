@extends('user.layouts.app')

@section('title', 'PixelStore - Profile')

@section('content')
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('/img/bg-img/bg-1.jpg') }});">
        <div class="bradcumbContent">
            <p>Chào mừng bạn!</p>
            <h2>Profile</h2>
        </div>
    </section>

    <section class="section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="profile-content">
                        <h3>Chỉnh sửa thông tin cá nhân</h3>

                        <!-- Hiển thị thông báo -->
                        @if (session('status') === 'profile-updated')
                            <div class="alert alert-success" role="alert">
                                Thông tin cá nhân đã được cập nhật.
                            </div>
                        @endif

                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="full_name">Họ và tên</label>
                                <input type="text"
                                       class="form-control @error('full_name') is-invalid @enderror"
                                       id="full_name"
                                       name="full_name"
                                       value="{{ old('full_name', $user->full_name) }}"
                                       required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone', $user->phone) }}"
                                       pattern="\d{10}"
                                       title="Số điện thoại phải có 10 chữ số"
                                       required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn oneMusic-btn mt-30">Cập nhật</button>
                        </form>

                        <h3 class="mt-5">Xóa tài khoản</h3>
                        <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản?');">
                            @csrf
                            @method('delete')

                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-danger mt-30">Xóa tài khoản</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
