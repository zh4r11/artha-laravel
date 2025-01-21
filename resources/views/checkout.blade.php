@extends('layouts.app')

@section('content')

<div class="checkout-area mt-60px mb-40px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="billing-info-wrap">
                    <h3>Detail Pengiriman</h3>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info mb-20px">
                                <label>Nama Lengkap</label>
                                <input type="text" id="nama" name="nama"/>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20px">
                                <label>Provinsi</label>
                                <input type="text" id="provinsi" name="provinsi"/>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-select mb-20px">
                                <label>Kota / Kabupaten</label>
                                <input type="text" id="kota" name="kota"/>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-select mb-20px">
                                <label>Kecamatan / Distrik</label>
                                <input type="text" id="kecamatan" name="kecamatan"/>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-select mb-20px">
                                <label>Kelurahan</label>
                                <input type="text" id="kelurahan" name="kelurahan"/>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20px">
                                <label>Kode POS</label>
                                <input type="text" id="kodepos" name="kodepos"/>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20px">
                                <label>Telepon</label>
                                <input type="text" id="telepon" name="telepon"/>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-20px">
                                <label>Alamat Lengkap</label>
                                <input class="billing-address" id="alamat" name="alamat" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="additional-info-wrap">
                        <h4>Informasi Tambahan</h4>
                        <div class="additional-info">
                            <label>Catatan</label>
                            <textarea id="catatan" name="catatan"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="your-order-area">
                    <h3>Your order</h3>
                    <div class="your-order-wrap gray-bg-4">
                        <div class="your-order-product-info">
                            <div class="your-order-top">
                                <ul>
                                    <li>Product</li>
                                    <li>Total</li>
                                </ul>
                            </div>
                            <div class="your-order-middle">
                                <ul>
                                </ul>
                            </div>
                            <div class="your-order-bottom">
                                <ul>
                                    <li class="your-order-shipping">Ongkos Kirim</li>
                                    <li>Free</li>
                                </ul>
                            </div>
                            <div class="your-order-total">
                                <ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="Place-order mt-25">
                        <a class="btn-hover" href="#">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@vite(['resources/css/app.css', 'resources/js/app.js'])

@push('scripts')
<script>
    $(document).ready(function() {
        // Fetch products
        var Url = "{{ route('cart.index') }}";
        var total = 0;
        $.ajax({
            type: 'GET',
            url: Url, // Replace with your actual API endpoint
            success: function(response) {
                const cartItems = response.cartItems;
                const cartContent = $('.your-order-middle ul');
                // Populate products in the order summary
                if(cartItems.length > 0) {
                    cartItems.forEach(item => {
                        const cartItemHtml = `
                            <li>
                                <span class="order-middle-left">${item.produk.nama_produk} X ${item.qty}</span>
                                <span class="order-price"> Rp ${(item.produk.harga_produk * item.qty).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</span>
                            </li>
                        `;
                        cartContent.append(cartItemHtml);
                        total += (item.produk.harga_produk * item.qty);
                    });
                    $('.your-order-total ul').append(`
                        <li class="order-total">Total</li>
                        <li>Rp ${total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</li>
                    `);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        // Place Order button click event
        $('.Place-order a').on('click', function(e) {
            e.preventDefault(); // Prevent default anchor click behavior

            // Gather form data
            var orderData = {
                nama: $('#nama').val(),
                telepon:$('#telepon').val(),
                provinsi: $('#provinsi').val(),
                kota: $('#kota').val(),
                kecamatan: $('#kecamatan').val(),
                kelurahan: $('#kelurahan').val(),
                kode_pos: $('#kodepos').val(),
                alamat: $('#alamat').val(),
                catatan: $('#catatan').val(),
                // Add any other necessary fields
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // AJAX request to save order
            $.ajax({
                type: 'POST',
                url: "{{ route('order.store.buyer') }}", // Replace with your actual route
                data: orderData,
                success: function(response) {
                    // Handle success response
                    downloadInvoice(response.id);
                    window.location.href = "{{ route('order.index.buyer') }}";
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error saving order. Please try again.');
                }
            });
        });
    });

    function downloadInvoice(id) {
        const formData = new FormData();
        formData.append('id', id);
        var Url = `{{ route('download-invoice') }}`;
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: Url,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.close();
                if (response.success) {
                    window.open(response.link, '_blank');
                } else {
                    Swal.fire('Error', 'Failed to download invoice', 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.close();
                Swal.fire('Error', 'Failed to generate invoice', 'error');
            }
        });
    }
</script>
@endpush
