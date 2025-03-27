<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'DASHMIN - Admin')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Vite CSS -->
    @vite([
        'resources/lib/owlcarousel/assets/owl.carousel.min.css',
        'resources/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css',
        'resources/css/bootstrapp.min.css',
        'resources/css/stylee.css'
    ])
</head>
<body>
    @include('admin.partials.header')
    @yield('content')
    @include('admin.partials.footer')

    <!-- Vite JS -->
    @vite([
        'resources/js/jquery.min.js', // Thêm jQuery trước
        'resources/lib/chart/chart.min.js',
        'resources/lib/easing/easing.min.js',
        'resources/lib/waypoints/waypoints.min.js',
        'resources/lib/owlcarousel/owl.carousel.min.js',
        'resources/lib/tempusdominus/js/moment.min.js',
        'resources/lib/tempusdominus/js/moment-timezone.min.js',
        'resources/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js',
        'resources/js/main.js'
    ])

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
