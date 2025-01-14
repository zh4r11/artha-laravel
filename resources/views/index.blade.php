@extends('layouts.app')

@section('content')

<!-- Slider Arae Start -->
<div class="slider-area">
    <div class="slider-active-3 owl-carousel slider-hm8 owl-dot-style">
        <!-- Slider Single Item Start -->
        <div class="slider-height-6 d-flex align-items-start justify-content-start bg-img" style="background-image: url({{ asset('assets/images/slider-image/sample-1.jpg') }});">
            <div class="container">
                <div class="slider-content-1 slider-animated-1 text-left">
                </div>
            </div>
        </div>
        <!-- Slider Single Item End -->
        <!-- Slider Single Item Start -->
        <div class="slider-height-6 d-flex align-items-start justify-content-start bg-img" style="background-image: url({{ asset('assets/images/slider-image/sample-2.jpg') }});">
            <div class="container">
                <div class="slider-content-1 slider-animated-1 text-left">
                </div>
            </div>
        </div>
        <!-- Slider Single Item End -->
    </div>
</div>
<!-- Slider Arae End -->
<!-- Static Area Start -->
<section class="static-area mtb-60px">
    <div class="container">
        <div class="static-area-wrap">
            <div class="row">
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                    <div class="single-static pb-res-md-0 pb-res-sm-0 pb-res-xs-0">
                        <img src="{{ asset('assets/images/icons/static-icons-1.png') }}" alt="" class="img-responsive" />
                        <div class="single-static-meta">
                            <h4>Free Shipping</h4>
                            <p>On all orders over $75.00</p>
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                    <div class="single-static pb-res-md-0 pb-res-sm-0 pb-res-xs-0 pt-res-xs-20">
                        <img src="{{ asset('assets/images/icons/static-icons-2.png') }}" alt="" class="img-responsive" />
                        <div class="single-static-meta">
                            <h4>Free Returns</h4>
                            <p>Returns are free within 9 days</p>
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                    <div class="single-static pt-res-md-30 pb-res-sm-30 pb-res-xs-0 pt-res-xs-20">
                        <img src="{{ asset('assets/images/icons/static-icons-3.png') }}" alt="" class="img-responsive" />
                        <div class="single-static-meta">
                            <h4>100% Payment Secure</h4>
                            <p>Your payment are safe with us.</p>
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
                <!-- Static Single Item Start -->
                <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                    <div class="single-static pt-res-md-30 pb-res-sm-30 pt-res-xs-20">
                        <img src="{{ asset('assets/images/icons/static-icons-4.png') }}" alt="" class="img-responsive" />
                        <div class="single-static-meta">
                            <h4>Support 24/7</h4>
                            <p>Contact us 24 hours a day</p>
                        </div>
                    </div>
                </div>
                <!-- Static Single Item End -->
            </div>
        </div>
    </div>
</section>
<!-- Static Area End -->
<!-- Best Sells Area Start -->
<section class="best-sells-area mb-30px">
    <div class="container">
        <!-- Section Title Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>Best Sellers</h2>
                    <p>Add bestselling products to weekly line up</p>
                </div>
            </div>
        </div>
        <!-- Section Title End -->
        <!-- Best Sell Slider Carousel Start -->
        <div class="best-sell-slider owl-carousel owl-nav-style">
            <!-- Single Item -->
            @foreach($produk as $product)
                @if($product->best_seller)
                    <article class="list-product">
                        <div class="img-block">
                            <a href="#" class="thumbnail">
                                <img class="first-img" src="{{ asset('storage/assets/images/products-images/' . ($product->foto1 ?? 'Image-not-found.png')) }}" alt="" />
                                <img class="second-img" src="{{ asset('storage/assets/images/products-images/' . ($product->foto2 ?? 'Image-not-found.png')) }}" alt="" />
                            </a>
                            <div class="quick-view">
                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal" data-id="{{ $product->id }}">
                                    <i class="ion-ios-search-strong"></i>
                                </a>
                            </div>
                        </div>
                        <ul class="product-flag">
                            <li class="new">Best</li>
                        </ul>
                        <div class="product-decs">
                            <h2><a href="#" class="product-link">{{ $product->nama_produk }}</a></h2>
                            <div class="pricing-meta">
                                <ul>
                                    <li class="old-price not-cut">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="add-to-link">
                            <ul>
                                <li class="cart"><a class="cart-btn" href="#" onclick="addToCart({{ $product->id }}, 1)">ADD TO CART </a></li>
                            </ul>
                        </div>
                    </article>
                @endif
            @endforeach
            <!-- Single Item -->
        </div>
        <!-- Best Sells Carousel End -->
    </div>
</section>
<!-- Best Sells Slider End -->
<!-- Banner Area Start -->
<div class="banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-12">
                <div class="banner-wrapper">
                    <a href="shop-4-column.html"><img src="{{ asset('assets/images/banner-image/1.jpg') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 mt-res-sx-30px">
                <div class="banner-wrapper">
                    <a href="shop-4-column.html"><img src="{{ asset('assets/images/banner-image/2.jpg') }}" alt="" /></a>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 mt-res-sx-30px">
                <div class="banner-wrapper">
                    <a href="shop-4-column.html"><img src="{{ asset('assets/images/banner-image/3.jpg') }}" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Area End -->
<!-- Feature Area Start -->
<section class="feature-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title -->
                <div class="section-title">
                    <h2>Products</h2>
                    <p>Add products to weekly line up</p>
                </div>
                <!-- Section Title -->
            </div>
        </div>
        <!-- Feature Slider Start -->
        <div class="feature-slider owl-carousel owl-nav-style">
            <!-- Single Item -->
            @php
                $head=true;
                $y=0;
            @endphp
            @foreach($produk as $product)
                @if ($head)
                    <div class="feature-slider-item">
                    @php
                        $head=false;
                    @endphp
                @endif
                @if ($y<5)    
                        <article class="list-product">
                            <div class="img-block">
                                <a href="#" class="thumbnail">
                                    <img class="first-img" src="{{ asset('storage/assets/images/products-images/' . ($product->foto1 ?? 'Image-not-found.png')) }}" alt="" />
                                    <img class="second-img" src="{{ asset('storage/assets/images/products-images/' . ($product->foto2 ?? 'Image-not-found.png')) }}" alt="" />
                                </a>
                                <div class="quick-view">
                                    <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal" data-id="{{ $product->id }}">
                                        <i class="ion-ios-search-strong"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-decs">
                                <h2><a href="#" class="product-link">{{ $product->nama_produk }}</a></h2>
                                <div class="pricing-meta">
                                    <ul>
                                        <li class="old-price not-cut">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                        @php
                            $y++;
                        @endphp
                @else
                        <article class="list-product">
                            <div class="img-block">
                                <a href="#" class="thumbnail">
                                    <img class="first-img" src="{{ asset('storage/assets/images/products-images/' . ($product->foto1 ?? 'Image-not-found.png')) }}" alt="" />
                                    <img class="second-img" src="{{ asset('storage/assets/images/products-images/' . ($product->foto2 ?? 'Image-not-found.png')) }}" alt="" />
                                </a>
                                <div class="quick-view">
                                    <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal" data-id="{{ $product->id }}">
                                        <i class="ion-ios-search-strong"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-decs">
                                <h2><a href="#" class="product-link">{{ $product->nama_produk }}</a></h2>
                                <div class="pricing-meta">
                                    <ul>
                                        <li class="old-price not-cut">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </div>
                    @php
                        $head=true;
                        $y=0;
                    @endphp
                @endif
            @endforeach
            <!-- Single Item -->
        </div>
        
        <!-- Feature Slider End -->
    </div>
</section>
<!-- Feature Area End -->
<!-- Banner Area 2 Start -->
<div class="banner-area-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-inner">
                    <a href="{{ url('shop-4-column') }}"><img src="{{ asset('assets/images/banner-image/4.jpg') }}" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Area 2 End -->
<!-- Brand area start -->
<div class="brand-area">
    <div class="container">
        <div class="brand-slider owl-carousel owl-nav-style owl-nav-style-2">
            <div class="brand-slider-item">
                <a href="#"><img src="{{ asset('assets/images/brand-logo/1.jpg') }}" alt="" /></a>
            </div>
            <div class="brand-slider-item">
                <a href="#"><img src="{{ asset('assets/images/brand-logo/2.jpg') }}" alt="" /></a>
            </div>
            <div class="brand-slider-item">
                <a href="#"><img src="{{ asset('assets/images/brand-logo/3.jpg') }}" alt="" /></a>
            </div>
            <div class="brand-slider-item">
                <a href="#"><img src="{{ asset('assets/images/brand-logo/4.jpg') }}" alt="" /></a>
            </div>
            <div class="brand-slider-item">
                <a href="#"><img src="{{ asset('assets/images/brand-logo/5.jpg') }}" alt="" /></a>
            </div>
            <div class="brand-slider-item">
                <a href="#"><img src="{{ asset('assets/images/brand-logo/1.jpg') }}" alt="" /></a>
            </div>
            <div class="brand-slider-item">
                <a href="#"><img src="{{ asset('assets/images/brand-logo/2.jpg') }}" alt="" /></a>
            </div>
        </div>
    </div>
</div>
<!-- Brand area end -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="tab-content quickview-big-img">
                            <div id="pro-1" class="tab-pane fade show active">
                                <img src="{{ asset('assets/images/product-image/Image-not-found.png') }}" alt="" />
                            </div>
                            <div id="pro-2" class="tab-pane fade">
                                <img src="{{ asset('assets/images/product-image/organic/product-9.jpg') }}" alt="" />
                            </div>
                            <div id="pro-3" class="tab-pane fade">
                                <img src="{{ asset('assets/images/product-image/organic/product-20.jpg') }}" alt="" />
                            </div>
                            <div id="pro-4" class="tab-pane fade">
                                <img src="{{ asset('assets/images/product-image/organic/product-19.jpg') }}" alt="" />
                            </div>
                        </div>
                        <!-- Thumbnail Large Image End -->
                        <!-- Thumbnail Image End -->
                        <div class="quickview-wrap mt-15">
                            <div class="quickview-slide-active owl-carousel nav owl-nav-style owl-nav-style-2" role="tablist">
                                <a class="active" data-toggle="tab" href="#pro-1"><img src="{{ asset('assets/images/product-image/Image-not-found.png') }}" alt="" /></a>
                                <a data-toggle="tab" href="#pro-2"><img src="#" alt="" /></a>
                                <a data-toggle="tab" href="#pro-3"><img src="#" alt="" /></a>
                                <a data-toggle="tab" href="#pro-4"><img src="#" alt="" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="product-details-content quickview-content">
                            <h2></h2>

                            <div class="pricing-meta">
                                <ul>
                                    <li class="old-price not-cut"></li>
                                </ul>
                            </div>
                            <p></p>
                            <div class="pro-details-quality">
                                <div class="cart-plus-minus">
                                    <div class="dec qtybutton">-</div>
                                        <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                                    <div class="inc qtybutton">+</div>
                                </div>
                                <div class="pro-details-cart btn-hover">
                                <a href="#" class="add-to-cart-btn" data-product-id=""> + Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<style>
    .custom-modal .modal-dialog {
        max-width: 400px; /* Adjust the width as needed */
    }

    .nav-tabs {
        justify-content: center; /* Center the tabs */
    }
</style>

<!-- Modal login -->
<div class="modal fade custom-modal" id="authModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Login Tab -->
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <form id="loginForm" action="login.php" method="POST">
                            <div class="form-group">
                                <label for="InputEmail1">Email address</label>
                                <input type="email" class="form-control" id="InputEmail" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="InputPassword1">Password</label>
                                <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>

                    <!-- Register Tab -->
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form id="registerForm" action="{{ route('register.buyer') }}" method="POST">
                            <div class="form-group">
                                <label for="RegisterEmail">Email address</label>
                                <input type="email" class="form-control" id="RegisterEmail" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="RegisterPassword">Password</label>
                                <input type="password" class="form-control" id="RegisterPassword" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="RegisterName">Name</label>
                                <input type="name" class="form-control" id="RegisterName" name="name" aria-describedby="nameHelp" placeholder="Enter name">
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->
@endsection
@vite(['resources/css/app.css', 'resources/js/app.js'])

@push('scripts')  
<script>
    $(document).ready(function() {
        // Call the function when the page loads
        // updateCartCount();
        refreshCart();

        $('.quick_view').on('click', function(e) {
            e.preventDefault();
            
            // Get the product ID from the data-id attribute
            var productId = $(this).data('id');
            
            // AJAX request to fetch product data
            var showDetailUrl = '{{ route("produk.detail", ":number") }}'.replace(':number', productId);
            $.ajax({
                url: showDetailUrl,
                type: 'GET',
                success: function(response) {
                    // Parse the JSON response
                    
                    // Populate the modal with the fetched data
                    $('#exampleModal .add-to-cart-btn').attr('data-product-id', productId);
                    $('#exampleModal .modal-body h2').text(response.nama_produk);
                    $('#exampleModal .modal-body .old-price').text('Rp ' + response.harga_produk.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $('#exampleModal .modal-body p').text(response.deskripsi);
                    
                    $image1 = response.foto1 ? '{{ asset('storage/assets/images/products-images/') }}/' + response.foto1 : '{{ asset('storage/assets/images/products-images/Image-not-found.png') }}';
                    $image2 = response.foto2 ? '{{ asset('storage/assets/images/products-images/') }}/' + response.foto2 : '{{ asset('storage/assets/images/products-images/Image-not-found.png') }}';
                    $image3 = response.foto3 ? '{{ asset('storage/assets/images/products-images/') }}/' + response.foto3 : '{{ asset('storage/assets/images/products-images/Image-not-found.png') }}';
                    $image4 = response.foto4 ? '{{ asset('storage/assets/images/products-images/') }}/' + response.foto4 : '{{ asset('storage/assets/images/products-images/Image-not-found.png') }}';

                    // Update product images
                    $('#pro-1 img').attr('src', $image1);
                    $('#pro-2 img').attr('src', $image2);
                    $('#pro-3 img').attr('src', $image3);
                    $('#pro-4 img').attr('src', $image4);
                    
                    // Update thumbnail images
                    $('#exampleModal .quickview-slide-active a').each(function(index) {
                        if (index == 0){
                            $(this).find('img').attr('src', $image1);
                        }else if(index == 1){
                            $(this).find('img').attr('src', $image2);
                        }else if(index == 2) {
                            $(this).find('img').attr('src', $image3);
                        } else {
                            $(this).find('img').attr('src', $image4);
                        }
                    });

                    // Update the "Add to Cart" button's data-product-id attribute
                    $('#exampleModal .add-to-cart-btn').attr('data-product-id', productId);
                    
                    // Show the modal
                    $('#exampleModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product data:', error);
                }
            });
        });
    });

    $('#registerForm').on('submit', function(e) {
        e.preventDefault();

        var email = $('#RegisterEmail').val();
        var password = $('#RegisterPassword').val();
        var name = $('#RegisterName').val();

        var Url = `{{ route('register.buyer') }}`;

        var formData = {
            _token: '{{ csrf_token() }}', // Add CSRF token here
            email: email,
            password: password,
            name: name
        };

        // $.ajaxSetup({
        //     headers: {
        //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        //   });

        $.ajax({
            url: Url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    alert('Registration successful!');
                    $('#authModal').modal('hide');
                    location.reload();
                } else {
                    alert('Registration failed: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error during registration:', xhr.responseText);
                alert('An error occurred. Please try again.' + xhr.responseText);
            }
        });
    });

    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        var email = $('#InputEmail').val();
        var password = $('#InputPassword').val();

        var Url = `{{ route('login-processed') }}`;

        var formData = {
            email: email,
            password: password
        };

        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: Url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    alert('Login successful!');
                    $('#authModal').modal('hide');
                    location.reload();
                } else {
                    alert('Login failed: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error during login:', xhr.responseText);
                alert('An error occurred. Please try again.' + xhr.responseText);
            }
        });
    });

    function addToCart(productId, quantity) {
        // Check if the user is logged in
        if (!{{ Auth::check() ? 'true' : 'false' }}) {
            alert('Please login to add items to the cart.');
            return;
        }

        var Url = `{{ route('cart.store') }}`;

        var data = {
            id_produk: productId,
            qty: quantity
        };

        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Send an AJAX request to add the product to the cart
        $.ajax({
            url: Url,
            type: 'POST',
            data: data,
            success: function(response) {
                console.log(response);
                // const data = JSON.parse(response);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succeded!',
                        text: response.message
                    });
                    refreshCart();
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error adding product to cart:', xhr.responseText);
                alert('An error occurred while adding the product to the cart. ' + xhr.responseText);
            }
        });
    }

    function refreshCart() {
        var Url = "{{ route('cart.index') }}";
        $.ajax({
            url: Url,
            type: 'GET',
            success: function(response) {
                const cartItems = response.cartItems;
                const cartContent = $('.mini-cart-content ul');
                var totalAmount = 0;
                cartContent.empty();

                if (cartItems.length > 0) {
                    cartItems.forEach(item => {
                        const cartItemHtml = `
                            <li class="single-shopping-cart">
                                <div class="shopping-cart-img">
                                    <a href="#"><img src="${item.produk.foto1 ? '{{ asset('assets/images/product-image') }}/${item.foto1}' : '{{ asset('assets/images/product-image/Image-not-found.png') }}'}" alt="${item.produk.nama_produk}" /></a>
                                    <span class="product-quantity">${item.qty}x</span>
                                </div>
                                <div class="shopping-cart-title">
                                    <h4><a href="#">${item.produk.nama_produk}</a></h4>
                                    <span>Rp ${item.produk.harga_produk ? item.produk.harga_produk.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '0'}</span>
                                    <div class="shopping-cart-delete">
                                        <a href="#" onclick="deleteCart(${item.id})"><i class="ion-android-cancel"></i></a>
                                    </div>
                                </div>
                            </li>
                        `;
                        cartContent.append(cartItemHtml);
                        totalAmount += item.produk.harga_produk * item.qty;
                    });
                } else {
                    cartContent.append('<li class="single-shopping-cart"><div class="shopping-cart-title"><h4>No items in cart</h4></div></li>');
                }

                // const totalAmount = response.totalAmount;
                $('.shopping-cart-total span').text(`Rp ${totalAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}`);
                // updateCartCount();
                $('.count-cart').attr('data-count', cartItems.length);
                $('.count-cart span').text(`Rp ${totalAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}`);
            },
            error: function(xhr, status, error) {
                console.error('Error refreshing cart:', error);
            }
        });
    }

    function deleteCart(id)
    {
        Swal.fire({
        icon: 'warning',
        html: `Apakah Anda yakin ingin menghapus barang dalam keranjang?`,
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Hapus',
        customClass: {
          confirmButton: 'swal2-confirm',
          cancelButton: 'swal2-cancel',
          icon: 'swal-icon-custom',
          popup: 'swal2-popup'
        }
      }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Sedang menghapus...',
                allowOutsideClick: false,
                didOpen: () => {
                Swal.showLoading();
                }
            });

            var Url = "{{ route('cart.delete') }}";

            var data = {
                _token: '{{ csrf_token() }}',
                id: id,
            };
            
            $.ajax({
                url: Url,
                type: 'POST',
                data: data,
                success: function(response) {
                    if(response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succeded!',
                            text: response.message
                        });
                        refreshCart();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting cart:', error);
                }
            });
        }
      });
    }
</script>
@endpush