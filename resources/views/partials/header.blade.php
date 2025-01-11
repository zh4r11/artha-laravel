<header class="main-header">
    <div class="header-top-nav" style="background-color: #4fb68d;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="left-text">
                        @if (Auth::check())
                            Welcome {{ Auth::user()->name }} to Artha Kreasi store!
                        @else
                            Welcome you to Artha Kreasi store!
                        @endif
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 text-right">
                    <div class="header-right-nav">
                        <div class="dropdown-navs">
                            <ul>
                                <li class="dropdown xs-after-n">
                                    <a class="angle-icon" href="#">Settings</a>
                                    <ul class="dropdown-nav">
                                        @if (Auth::check())
                                            <li><a href="{{ route('logout') }}">Logout</a></li>
                                        @else
                                            <li><a href="#" data-toggle="modal" data-target="#authModal">Login</a></li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-navigation sticky-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-sm-2">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo/logo.jpg') }}" alt="logo.jpg" /></a>
                    </div>
                </div>
                <div class="col-md-10 col-sm-10">
                    <div class="main-navigation d-none d-lg-block">
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="header_account_area">
                        <div class="cart-info d-flex">
                            <div class="mini-cart-warp">
                                <a href="#" onclick="refreshCart()" class="count-cart" data-count="0"><span>Rp 0</span></a>
                                <div class="mini-cart-content">
                                    <ul>
                                        
                                    </ul>
                                    <div class="shopping-cart-total">
                                        <h4>Subtotal : <span>Rp 0</span></h4>
                                    </div>
                                    <div class="shopping-cart-btn text-center">
                                        <a class="default-btn" href="{{ url('checkout') }}">checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('contact') }}">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
