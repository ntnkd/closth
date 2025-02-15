<header class="header">

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="./index.html"><img src="/template/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-5 col-md-5">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="active"><a href="./index">Home</a></li>
                        <li><a href="./shop.html">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./about.html">About Us</a></li>
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                <li><a href="./checkout.html">Check Out</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="./blog.html">Blog</a></li>
                        <li><a href="./contact.html">Contacts</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-2 col-md-2">
                <div class="header__nav__option">
                    <a href="#" class="search-switch"><img src="/template/img/icon/search.png" alt=""></a>
                    <a href="#"><img src="/template/img/icon/cart.png" alt=""> <span>0</span></a>
                    <div class="price">$0.00</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2">
                <div class="header__menu">
                    <ul>
                        @if (Auth::check())
                            <!-- Hiển thị tên người dùng và dropdown -->
                            <li>
                                <a href="#">{{ Auth::user()->name }}</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                            @csrf
                                            <button type="submit" style="background: none; border: none; color: white; padding: 5px 20px; cursor: pointer; font-size: 14px;">Log Out</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <!-- Hiển thị các nút đăng nhập và đăng ký -->
                            <li><a href="{{ route('login') }}">Sign In</a></li>
                        @endif
                    </ul>
                </div>

            </div>
        </div>

    </div>
</header>

