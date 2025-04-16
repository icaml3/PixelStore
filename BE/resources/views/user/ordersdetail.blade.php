@extends('user.layouts.app')
@section('title', 'PixelStore - Chi tiết đơn hàng')

@section('content')
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('/img/bg-img/bg-2.jpg') }});">
        <div class="bradcumbContent">
            <h2 class="display-4">Chi tiết đơn hàng #{{ $order->id }}</h2>
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

                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Thông tin đơn hàng</h5>
                                    <a href="{{ route('orders') }}" class="btn btn-outline-primary btn-sm">Quay lại</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
                                        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                                        <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Trạng thái:</strong>
                                            @if ($order->status == 0)
                                                <span class="badge bg-warning text-dark">Đang xử lý</span>
                                            @elseif ($order->status == 1)
                                                <span class="badge bg-success">Hoàn thành</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $order->status }}</span>
                                            @endif
                                        </p>
                                        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</p>
                                        <p><strong>Ingame:</strong> {{ $order->note }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Chi tiết sản phẩm</h5>
                            </div>
                            <div class="card-body">
                                <div class="site-blocks-table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Hình ảnh</th>
                                                <th>Game</th>
                                                <th>Giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderDetails as $item)
                                                <tr>
                                                    <td class="product-thumbnail">
                                                        @if ($item->game && $item->game->image)
                                                            <img src="{{ asset('/img/bg-img/' . $item->game->image) }}" style="width:150px" alt="{{ $item->game->name }}" class="img-fluid">
                                                        @else
                                                            <img src="{{ asset('/img/default.png') }}" style="width:150px" alt="Default Image" class="img-fluid">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <h5>{{ $item->game ? $item->game->name : 'Game không tồn tại' }}</h5>
                                                    </td>
                                                    <td>{{ number_format($item->game->price, 0, ',', '.') }} VNĐ</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
```
