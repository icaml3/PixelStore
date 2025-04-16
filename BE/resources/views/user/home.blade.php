@extends('user.layouts.app')

@section('title', 'PixelStore - Trang chủ')

@section('content')
<!-- ##### Hero Area Start ##### -->
 <section class="hero-area">
    <div class="hero-slides owl-carousel">
        <!-- Single Hero Slide -->
        <div class="single-hero-slide d-flex align-items-center justify-content-center">
            <!-- Slide Img -->
            <div class="slide-img bg-img" style="background-image: url('{{ asset('/img/bg-img/bg-1.jpg') }}');"></div>
            <!-- Slide Content -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-slides-content text-center">
                            <h6 data-animation="fadeInUp" data-delay="100ms">Truy cập sớm</h6>
                            <h2 data-animation="fadeInUp" data-delay="300ms">Back Myth: Wukong <span>Back Myth: Wukong</span></h2>
                            <a data-animation="fadeInUp" data-delay="500ms" href="#" class="btn oneMusic-btn mt-50">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Hero Slide -->
        <div class="single-hero-slide d-flex align-items-center justify-content-center">
            <!-- Slide Img -->
            <div class="slide-img bg-img" style="background-image: url('{{ asset('/img/bg-img/bg-2.jpg') }}');"></div>
            <!-- Slide Content -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-slides-content text-center">
                            <h6 data-animation="fadeInUp" data-delay="100ms">Truy cập sớm</h6>
                            <h2 data-animation="fadeInUp" data-delay="300ms">ELDEN RING Shadow of the Erdtree <span>ELDEN RING Shadow of the Erdtree</span></h2>
                            <a data-animation="fadeInUp" data-delay="500ms" href="#" class="btn oneMusic-btn mt-50">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Hero Area End ##### -->

<!-- ##### Latest Albums Area Start ##### -->
<section class="latest-albums-area section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading style-2">
                    <p>Về chúng tôi</p>
                    <h2>PixelStore</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9">
                <div class="ablums-text text-center mb-70">
                    <p>PixelStore tự hào là điểm đến hàng đầu dành cho các game thủ yêu thích game bản quyền chất lượng. Chúng tôi sở hữu kho tàng game đa dạng, chính hãng, đáp ứng mọi nhu cầu giải trí, từ thể thao, hành động đến phiêu lưu.
                    Với cam kết mang đến trải nghiệm đỉnh cao, PixelStore không chỉ là nơi mua sắm, mà còn là cộng đồng kết nối đam mê của bạn. Hãy khám phá thế giới game bản quyền chính hãng tại PixelStore ngay hôm nay!
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="albums-slideshow owl-carousel">
                    <!-- Single Album -->
                    @if($games->isEmpty())
                        <p>Không có game nào để hiển thị.</p>
                    @else
                    @foreach($games as $game)
                    <div class="single-album">
                        <img class="img-cover" src="{{ asset('img/bg-img/' . $game->image) }}" alt="{{ $game->name }}">
                        <div class="album-info">
                            <a href="{{ url('/game-detail/'.$game->id) }}">
                                <h5 class="game-name" data-full-name="{{ $game->name }}">{{ $game->name }}</h5>
                            </a>
                            <p>Giá: {{ number_format($game->price - $game->sale, 0, ',', '.')}} VNĐ</p>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Latest Albums Area End ##### -->

<!-- ##### Buy Now Area Start ##### -->
<section class="oneMusic-buy-now-area has-fluid bg-gray section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-heading style-2">
                    <p>Xem có gì mới</p>
                    <h2>Các games mới</h2>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Single Album Area -->
            <!-- Single Album Area -->
                @if($games->isEmpty())
                    <p>Không có game nào để hiển thị.</p>
                @else
                    @php $count = 0; @endphp
                    @foreach($games as $game)
                        @if ($game->created_at ->addDays(5) > now())
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <div class="single-album-area wow fadeInUp" data-wow-delay="200ms">
                                    <div class="album-thumb">
                                        <img class="img-cover" src="{{ asset('img/bg-img/' . $game->image) }}" alt="{{ $game->name }}">
                                    </div>
                                    <div class="album-info">
                                        <a href="{{ url('/game-detail/'.$game->id) }}">
                                            <h5 class="game-name" data-full-name="{{ $game->name }}">{{ $game->name }}</h5>
                                        </a>
                                        <p>Giá: {{ number_format($game->price - $game->sale, 0, ',', '.') }} VNĐ - <span style="color: red;">Mới</span></p>
                                    </div>
                                </div>
                            </div>
                            @php $count++; @endphp
                            @if($count == 12)
                                @break
                            @endif
                        @endif
                    @endforeach
                @endif


            <!-- Single Album Area -->


        </div>

        <div class="row">
            <div class="col-12">
                <div class="load-more-btn text-center wow fadeInUp" data-wow-delay="300ms">
                    <a href="{{ url('/games') }}" class="btn oneMusic-btn">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Buy Now Area End ##### -->

<!-- ##### Featured Artist Area Start ##### -->
<section class="featured-artist-area section-padding-100 bg-img bg-overlay bg-fixed" style="background-image: url({{asset('/img/bg-img/bg-4.jpg')}});">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="featured-artist-thumb">
                    <img src="{{asset('/img/bg-img/fa.jpg')}}" alt="">
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-8">
                <div class="featured-artist-content">
                    <!-- Section Heading -->
                    <div class="section-heading white text-left mb-30">
                        <p>Sản phẩm mới</p>
                        <h2>Cyberpunk 2077</h2>
                    </div>
                    <p>Cyberpunk 2077 là một tựa game nhập vai hành động thế giới mở, được phát triển bởi CD Projekt Red, hãng nổi tiếng với loạt game The Witcher. Lấy bối cảnh trong một tương lai đen tối ở thành phố Night City, nơi công nghệ, bạo lực, và tham nhũng thống trị, trò chơi mang đến một trải nghiệm sống động và đầy cảm xúc trong thế giới cyberpunk.</p>
                    <div class="song-play-area">
                        <div class="song-name">
                            <p>Never Fade Away</p>
                        </div>
                        <audio preload="auto" controls>
                            <source src="{{ asset('/audio/Cyberpunk 2077.mp3') }}">
                        </audio>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ##### Contact Area Start ##### -->
<section class="contact-area section-padding-100 bg-img bg-overlay bg-fixed has-bg-img" style="background-image: url('{{ asset('/img/bg-img/bg-2.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading white wow fadeInUp" data-wow-delay="100ms">
                    <!-- <p>Sản phẩm mới</p> -->
                    <h2>PixelStore</h2>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- ##### Contact Area End ##### -->
@endsection
