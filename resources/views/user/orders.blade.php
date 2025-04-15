@extends('user.layouts.app')
@section('title', 'PixelStore - Đơn Hàng')

@section('content')
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('/img/bg-img/bg-2.jpg') }});">
        <div class="bradcumbContent">
            <h2 class="display-4">Đơn Hàng</h2>
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
                        <h3 class="mb-4">Lịch sử đơn hàng</h3>

                        @if ($orders->count() > 0)
                            <div class="site-blocks-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Ngày đặt</th>
                                            <th>Ghi chú</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>#{{ $order->id }}</td>
                                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                                <td>{{ $order->note }}</td>
                                                <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                                                <td>
                                                    @if ($order->status == 0)
                                                        <span class="badge bg-warning text-dark">Đang xử lý</span>
                                                    @elseif ($order->status == 1)
                                                        <span class="badge bg-success">Hoàn thành</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $order->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('orders.show', $order->id) }}" class="btn-outline-success">Xem chi tiết</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                Bạn chưa có đơn hàng nào. <a href="{{ url('/') }}" class="alert-link">Mua hàng ngay</a>!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
```
