<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PixelStore')</title>
    <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite([
        'resources/css/animate.css',
        'resources/css/audioplayer.css',
        'resources/css/bootstrap.min.css',
        'resources/css/classy-nav.css',
        'resources/css/magnific-popup.css',
        'resources/css/one-music-icon.css',
        'resources/css/owl.carousel.min.css',
        'resources/css/style.css',
        'resources/scss/_fonts.scss',
        'resources/scss/_mixin.scss',
        'resources/scss/_responsive.scss',
        'resources/scss/style.scss',
        'resources/css/header.css',
        'resources/css/font-awesome.min.css'
    ])
</head>
<body>
    @include('partials.header')
        @yield('content')
    @include('partials.footer')

</body>
@vite([
    'bootstrap/jquery/jquery-2.2.4.min.js', // Chọn 1 phiên bản jQuery duy nhấtbootstrap/jquery/
    'resources/js/popper.min.js', // Nếu cần Popper riêng
    'bootstrap/js/bootstrap.bundle.min.js', // Bootstrap 5 với Popper tích hợp
    'resources/js/plugins.js', // File plugins tùy chỉnh
    'resources/js/active.js',
    'resources/js/games.js',
    'resources/js/ajax.js'
])

<script src="https://kit.fontawesome.com/08fe3cf420.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
</html>
