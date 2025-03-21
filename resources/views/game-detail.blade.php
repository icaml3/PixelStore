@extends('layouts.app')
@section('title', 'PixelStore - ' . e($game->name))
@section('content')
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url('{{ asset('/img/bg-img/'.$game->image) }}');">
        <div class="bradcumbContent">
            <p>Tên sản phẩm</p>
            <h2 class="display-4">{{ $game->name }}</h2>
        </div>
    </section>
    <div class="contact-area section-padding-100-0">
        <div class="row">
            <div class="embed-responsive-16by9 col-md-6">
                <iframe class="embed-responsive-item" width="560" height="315"
                    src="https://www.youtube.com/embed/{{ $game->video }}?autoplay=1&controls=0"
                    title="YouTube video player"
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen>
                </iframe>
            </div>
            <div class="col-md-6">
                <p class="lead">Giá: <span class="text-danger">{{ number_format($game->price - $game->sale, 0, ',', '.') }} VNĐ</span></p>
                @if ($game->sale)
                    <p class="lead">Giá sale: <span class="text-success">{{ number_format($game->sale, 0, ',', '.') }} VNĐ</span></p>
                @endif
                <p class="mt-4">Chi tiết game: {{ $game->short_description }}</p>
                <p class="mt-4">Danh mục: <a href="{{ url('/category/'.$game->category->id)}}">{{ $game->category->name }}</a></p>
                <form method="POST" action="{{ url('/cart/add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $game->id }}">
                    <input type="hidden" name="product_name" value="{{ $game->name }}">
                    <input type="hidden" name="product_price" value="{{ $game->price - $game->sale}}">
                    <input type="hidden" name="product_image" value="{{ $game->image }}">
                    <button type="submit" class="btn btn-outline-success mt-2">Thêm vào giỏ hàng</button>
                </form>
                <h1 style="height:300px"></h1>
            </div>
        </div>
    </div>
@endsection
