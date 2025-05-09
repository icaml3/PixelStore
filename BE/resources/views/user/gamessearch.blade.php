@extends('user.layouts.app')
{{-- @if(isset($category_id) && $category_id && !$games->isEmpty())
    @section('title', 'PixelStore - '.($games->first()->category->name))
@else
    @section('title', 'PixelStore - Games')
@endif --}}
@section ('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url('{{ asset('/img/bg-img/bg-1.jpg') }}');">
        <div class="bradcumbContent">
            <p>Từ khóa bạn tìm:</p>
            <h2>
                {{ $search }}
            </h2>

        </div>
    </section>

    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Album Catagory Area Start ##### -->
    <section class="album-catagory section-padding-100-0">
        <div class="container">
            <div class="row">
                <div class="col-12">

                </div>
            </div>
            <div class="row oneMusic-albums">

                <!-- Single Album -->
                @if($games->isEmpty())
                        <p>Không tìm thấy game nào phù hợp với từ khóa {{ $query }}.</p>
                        @else
                        @foreach($games as $game)
                        <div class="col-12 col-sm-4 col-md-3 col-lg-2 single-album-item {{ $game->tags }}">
                            <div class="single-album">
                                <img class="img-cover" style='object-fit:cover' src="{{ asset('img/bg-img/' . $game->image) }}" alt="{{ $game->name }}">
                                <div class="album-info">
                                    <a href="{{ url('/game-detail/'.$game->id) }}">
                                        <h5 class="game-name" data-full-name="{{ $game->name }}">{{ $game->name }}</h5>
                                    </a>
                                    <p>Giá: {{ number_format($game->price - $game->sale, 0, ',', '.')}} VNĐ</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                </div>
                <div class="no-products-message" style="display: none; text-align: center; padding: 20px;">
                    <p>Không có sản phẩm nào phù hợp.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- ##### Album Catagory Area End ##### -->

    <!-- ##### Buy Now Area Start ##### -->

    <!-- ##### Buy Now Area End ##### -->

    <!-- ##### Add Area Start ##### -->
    <div class="add-area mb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="adds">
                        <a href="#"><img src="{{ asset('img/bg-img/add3.jpg')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ##### Contact Area Start ##### -->
    <section class="contact-area section-padding-100 bg-img bg-overlay bg-fixed has-bg-img" style="background-image: url('{{ asset('/img/bg-img/bg-1.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading white">
                        <p>See what’s new</p>
                        <h2>Get In Touch</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- Contact Form Area -->
                    <div class="contact-form-area">
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" placeholder="E-mail">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn oneMusic-btn mt-30" type="submit">Send <i class="fa fa-angle-double-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Contact Area End ##### -->
@endsection
