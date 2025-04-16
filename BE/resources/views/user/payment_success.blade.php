@extends('user.layouts.app')
@section('title', 'PixelStore - Thanh toán thành công')

@section('content')
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('/img/bg-img/bg-2.jpg') }});">
        <div class="bradcumbContent">
            <h2 class="display-4">Thanh toán thành công</h2>
        </div>
    </section>
    <section class="album-catagory section-padding-100-0">
        <div class="untree_co-section before-footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Cảm ơn bạn đã mua hàng!</h3>
                        <p>Đơn hàng #{{ $order->id }} đã được thanh toán thành công.</p>
                        <p>Tổng tiền: {{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</p>
                        <a href="{{ url('/orders') }}" class="btn btn-primary">Xem đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
