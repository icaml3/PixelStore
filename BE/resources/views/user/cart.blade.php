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
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (!empty($cart))
                        @php
                            $total = 0;
                        @endphp
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
                                                {{ number_format($item['price'] ?? 0, 0, ',', '.') }} VNĐ</td>
                                            <td>
                                                <form method="POST" action="{{ url('/cart/remove/' . $id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-success">x</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $price = isset($item['price']) ? $item['price'] : 0;
                                            $total += $price;
                                        @endphp
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
                                        <strong class="text-black cart-total">{{ number_format($total ?? 0, 0, ',', '.') }} VNĐ</strong>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{ route('vnpay_payment') }}" method="POST">
                                            @csrf
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="text-black h4" for="note">Ingame</label>
                                                    <p>Nhập ingame của bạn!</p>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <input type="text" class="form-control py-3" id="note" name="note" placeholder="Hãy nhập ingame của bạn!" required value="{{ old('note') }}">
                                                    @error('note')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" name="total" value="{{ $total }}">
                                            <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Mua hàng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
