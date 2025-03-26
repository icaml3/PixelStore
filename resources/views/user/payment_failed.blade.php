@extends('user.layouts.app')
@section('title', 'PixelStore - Thanh toán thất bại')

@section('content')
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('/img/bg-img/bg-2.jpg') }});">
        <div class="bradcumbContent">
            <h2 class="display-4">Thanh toán thất bại</h2>
        </div>
    </section>
    <section class="album-catagory section-padding-100-0">
        <div class="untree_co-section before-footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Thanh toán không thành công</h3>
                        <p>Đơn hàng #{{ $order->id }} đã bị hủy do thanh toán thất bại.</p>
                        <a href="{{ url('/cart') }}" class="btn btn-primary">Quay lại giỏ hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
