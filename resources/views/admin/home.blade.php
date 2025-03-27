@extends('admin.layouts.app')

@section('title', 'DASHMIN - Trang chủ')

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <!-- Số đơn hàng đã hoàn thành trong ngày/tháng -->
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-shopping-cart fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Đơn hàng hôm nay</p>
                        <h6 class="mb-0">150</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-calendar-alt fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Đơn hàng tháng này</p>
                        <h6 class="mb-0">4500</h6>
                    </div>
                </div>
            </div>
            <!-- Doanh thu theo ngày/tháng -->
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-dollar-sign fa-3x text-primary"></i>
                    <div class="ms-5">
                        <p class="mb-2">Doanh thu hôm nay</p>
                        <h6 class="mb-0">$1234</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-calendar-alt fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Doanh thu tháng này</p>
                        <h6 class="mb-0">$45000</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Chart End -->

    <!-- Đánh giá dịch vụ: Khiếu nại/Đánh giá tốt -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-thumbs-down fa-3x text-danger"></i>
                    <div class="ms-3">
                        <p class="mb-2">Khiếu nại khách hàng</p>
                        <h6 class="mb-0">20</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-thumbs-up fa-3x text-success"></i>
                    <div class="ms-3">
                        <p class="mb-2">Đánh giá tốt khách hàng</p>
                        <h6 class="mb-0">200</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loại hàng hóa được giao nhiều nhất -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Loại hàng hóa được giao nhiều nhất</h6>
                <a href="">Xem tất cả</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Loại hàng hóa</th>
                            <th scope="col">Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bánh kẹo</td>
                            <td>500</td>
                        </tr>
                        <tr>
                            <td>Đồ uống</td>
                            <td>300</td>
                        </tr>
                        <tr>
                            <td>Thực phẩm</td>
                            <td>200</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Widgets Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Nhân viên năng xuất</h6>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Họ và Tên</th>
                                <th scope="col">Số đơn hàng đã giao</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>John</td>
                                <td>Doe</td>
                                <td>jhon@email.com</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>mark@email.com</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>jacob@email.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Lịch</h6>
                    </div>
                    <div id="calender"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Widgets End -->
@endsection
