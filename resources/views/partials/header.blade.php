<header class="header-area">
    <!-- Navbar Area -->
    <div class="oneMusic-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="oneMusicNav">
                    <!-- Nav brand -->
                    <a href="{{ url('/') }}" class="nav-brand">
                        <img src="{{ asset('img/core-img/favicon.ico') }}" alt="PixelStore">
                    </a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('games') }}">Games</a></li>
                                <li><a href="#">Thể loại</a>
                                    <ul class="dropdown">
                                        @foreach ($categories as $cate)
                                            <li><a href="{{ url('category', $cate->id) }}">{{ $cate->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ url('event') }}">Sự kiện</a></li>
                                <li><a href="{{ url('contact') }}">Liên hệ</a></li>
                            </ul>

                            <!-- Login/Register & Cart Button -->
                            <div class="login-register-cart-button d-flex align-items-center">
                                <div class="login-register-btn mr-50">
                                    @auth
                                        <a href="{{ url('dashboard') }}" class="btn btn-outline-danger btn-sm logout-btn">
                                            ({{ Auth::user()->full_name }})
                                        </a>
                                    @else
                                        <a href="{{ url('dashboard') }}" id="loginBtn">Đăng nhập / Đăng ký</a>
                                    @endauth
                                </div>

                                <!-- Cart Button -->
                                <div class="cart-btn">
                                    <p><a href="{{ url('cart') }}"><i class="fa-solid fa-cart-shopping"></i></a></p>
                                </div>
                            </div>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
