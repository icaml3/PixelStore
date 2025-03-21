@extends('user.layouts.app')
@section('title', 'PixelStore - Cart')

@section('content')
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('/img/bg-img/bg-2.jpg') }});">
        <div class="bradcumbContent">
            <h2 class="display-4">Giỏ hàng</h2>
        </div>
    </section>
    <section class="album-catagory section-padding-100-0">
        <div class="untree_co-section before-footer-section">
            <div class="container">
                <div class="row mb-5">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (!empty($cart))
                            @csrf
                            <div class="site-blocks-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Hình ảnh</th>
                                            <th class="product-name">Game</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-total">Tổng tiền</th>
                                            <th class="product-remove">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $id => $item)
                                            <tr>
                                                <td class="product-thumbnail">
                                                    @if (!empty($item['image']))
                                                        <img src="{{ asset('/img/bg-img/' . $item['image']) }}" style="width:300px" alt="{{ $item['name'] }}" class="img-fluid">
                                                    @else
                                                        <img src="{{ asset('/img/default.png') }}" alt="Image" class="img-fluid">
                                                    @endif
                                                </td>
                                                <td class="product-name">
                                                    <h2 class="h5 text-black">{{ $item['name'] }}</h2>
                                                </td>
                                                <td>{{ number_format($item['price'] ?? 0, 0, ',', '.') }} VNĐ</td>
                                                <td class="cart-total">
                                                    {{ number_format($item['price'] ?? 0, 0, ',', '.') }} VNĐ
                                                </td>
                                                <td>
                                                    <form method="POST" action="{{ url('/cart/remove/' . $id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-success">x</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    @else
                        <div class="col-md-12">
                            <p>Giỏ hàng trống!</p>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <a href="{{ url('/') }}" class="btn btn-outline-black btn-sm btn-block">Tiếp tục mua hàng</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-black h4" for="coupon">Voucher</label>
                                <p>Nhập mã giảm giá</p>
                            </div>
                            <div class="col-md-8 mb-3 mb-md-0">
                                <input type="text" class="form-control py-3" id="coupon" placeholder="Mã Voucher">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-black">Sử dụng voucher</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Tổng giỏ hàng</h3>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Giá ban đầu</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black cart-total">{{ number_format($total, 0, ',', '.') }} VNĐ</strong>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Tổng</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black cart-total">{{ number_format($total, 0, ',', '.') }} VNĐ</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='{{ url('/order') }}'">Mua hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
