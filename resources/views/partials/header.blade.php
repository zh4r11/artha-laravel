<header class="main-header">
    <div class="header-top-nav" style="background-color: #c1680e;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="left-text">
                        @if (Auth::check())
                            <p>Welcome {{ Auth::user()->name }} to Artha Kreasi store! </p>
                        @else
                            <p>Welcome you to Artha Kreasi store!</p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 text-right">
                    <div class="header-right-nav">
                        <ul class="res-xs-flex">
                            <li class="after-n">
                                {{-- <a class="angle-icon" href="#">Settings</a> --}}
                                @if (Auth::check())
                                    <a href="{{ route('logout') }}">Logout</a>
                                @else
                                    <a href="#" data-toggle="modal" data-target="#authModal">Login</a>
                                @endif
                            </li>
                        </ul>
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
                        <a href="{{ url('/') }}"><img src="{{ asset('storage/assets/images/logo/logoh.png') }}" alt="logo.jpg" /></a>
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
                                <a href="javascript:void(0)" class="count-cart" data-count="0"><span>Rp 0</span></a>
                                <div class="mini-cart-content" style="max-height: 500px; overflow-y: auto;">
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
