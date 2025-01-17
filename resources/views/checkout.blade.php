@extends('layouts.app')

@section('content')

<div class="checkout-area mt-60px mb-40px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="billing-info-wrap">
                    <h3>Billing Details</h3>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20px">
                                <label>First Name</label>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20px">
                                <label>Last Name</label>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-20px">
                                <label>Company Name</label>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-select mb-20px">
                                <label>Country</label>
                                <select class="js-provinsi"></select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-20px">
                                <label>Street Address</label>
                                <input class="billing-address" placeholder="House number and street name" type="text" />
                                <input placeholder="Apartment, suite, unit etc." type="text" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="billing-info mb-20px">
                                <label>Town / City</label>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20px">
                                <label>State / County</label>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20px">
                                <label>Postcode / ZIP</label>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20px">
                                <label>Phone</label>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="billing-info mb-20px">
                                <label>Email Address</label>
                                <input type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="checkout-account mb-50px">
                        <input class="checkout-toggle2" type="checkbox" />
                        <label>Create an account?</label>
                    </div>
                    <div class="checkout-account-toggle open-toggle2 mb-30">
                        <input placeholder="Email address" type="email" />
                        <input placeholder="Password" type="password" />
                        <button class="btn-hover checkout-btn" type="submit">register</button>
                    </div>
                    <div class="additional-info-wrap">
                        <h4>Additional information</h4>
                        <div class="additional-info">
                            <label>Order notes</label>
                            <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="message"></textarea>
                        </div>
                    </div>
                    <div class="checkout-account mt-25">
                        <input class="checkout-toggle" type="checkbox" />
                        <label>Ship to a different address?</label>
                    </div>
                    <div class="different-address open-toggle mt-30">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="billing-info mb-20px">
                                    <label>Name</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-select mb-20px">
                                    <label>Country</label>
                                    <select>
                                        <option>Select a country</option>
                                        <option>Azerbaijan</option>
                                        <option>Bahamas</option>
                                        <option>Bahrain</option>
                                        <option>Bangladesh</option>
                                        <option>Barbados</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-20px">
                                    <label>Street Address</label>
                                    <input class="billing-address" placeholder="House number and street name" type="text" />
                                    <input placeholder="Apartment, suite, unit etc." type="text" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-20px">
                                    <label>Town / City</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>State / County</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>Postcode / ZIP</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>Phone</label>
                                    <input type="text" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>Email Address</label>
                                    <input type="text" />
                                </div>
                            </div>
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
                                    <li><span class="order-middle-left">Product Name X 1</span> <span class="order-price">$329 </span></li>
                                    <li><span class="order-middle-left">Product Name X 1</span> <span class="order-price">$329 </span></li>
                                </ul>
                            </div>
                            <div class="your-order-bottom">
                                <ul>
                                    <li class="your-order-shipping">Shipping</li>
                                    <li>Free shipping</li>
                                </ul>
                            </div>
                            <div class="your-order-total">
                                <ul>
                                    <li class="order-total">Total</li>
                                    <li>$329</li>
                                </ul>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion element-mrg">
                                <div class="panel-group" id="accordion">
                                    <div class="panel payment-accordion">
                                        <div class="panel-heading" id="method-one">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#method1">
                                                    Direct bank transfer
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="method1" class="panel-collapse collapse show">
                                            <div class="panel-body">
                                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel payment-accordion">
                                        <div class="panel-heading" id="method-two">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#method2">
                                                    Check payments
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="method2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel payment-accordion">
                                        <div class="panel-heading" id="method-three">
                                            <h4 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#method3">
                                                    Cash on delivery
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="method3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    $(document).ready(function() {
        //region input dan default wilayah
        (async () => {
            try {
            const response = await fetch('https://zh4r11.github.io/api-wilayah-indonesia/api/provinces.json');
            const jsonData = await response.json();



            const selectElement = $('#provinsi');
            selectElement.empty().append(`<option value="">Pilih Provinsi</option>`);

            jsonData.forEach(province => {
                selectElement.append(`<option value="${province.id}">${province.name}</option>`);
            });

            if (isFormEdit && defaultValueKabkot && $('#provinsi').val()) {
                $('#kabkot').prop('disabled', false);
                try {
                const response = await fetch(`https://zh4r11.github.io/api-wilayah-indonesia/api/regencies/${$('#provinsi').val()}.json`);
                const jsonData = await response.json();
                const selectElement = $('#kabkot');
                $(".js-kabkot").select2({
                    placeholder: "Pilih Kabupaten/Kota",
                    allowClear: true
                });

                selectElement.empty().append(`<option value="" ${!defaultValueKabkot ? 'selected' : ''}>Pilih Kabupaten / Kota</option>`);

                jsonData.forEach(regency => {
                    const isSelected = regency.name === defaultValueKabkot ? 'selected' : '';
                    selectElement.append(`<option value="${regency.id}" ${isSelected}>${regency.name}</option>`);
                });

                } catch (error) {
                console.error('Error fetching data:', error);
                }
            }

            if (isFormEdit && defaultValueKecamatan && $('#kabkot').val()) {
                $('#kecamatan').prop('disabled', false);
                try {
                const response = await fetch(`https://zh4r11.github.io/api-wilayah-indonesia/api/districts/${$('#kabkot').val()}.json`);
                const jsonData = await response.json();
                const selectElement = $('#kecamatan');
                $(".js-kecamatan").select2({
                    placeholder: "Pilih Kecamatan",
                    allowClear: true
                });

                selectElement.empty().append(`<option value="" ${!defaultValueKecamatan ? 'selected' : ''}>Pilih Kecamatan</option>`);

                jsonData.forEach(district => {
                    const isSelected = district.name === defaultValueKecamatan ? 'selected' : '';
                    selectElement.append(`<option value="${district.id}" ${isSelected}>${district.name}</option>`);
                });

                } catch (error) {
                console.error('Error fetching data:', error);
                }
            }


            if (isFormEdit && defaultValueKelurahan && $('#kecamatan').val()) {
                $('#kelurahan').prop('disabled', false);
                try {
                const response = await fetch(`https://zh4r11.github.io/api-wilayah-indonesia/api/villages/${$('#kecamatan').val()}.json`);
                const jsonData = await response.json();
                const selectElement = $('#kelurahan');
                $(".js-kelurahan").select2({
                    placeholder: "Pilih Kelurahan",
                    allowClear: true
                });

                selectElement.empty().append(`<option value="" ${!defaultValueKelurahan ? 'selected' : ''}>Pilih Kelurahan</option>`);

                jsonData.forEach(village => {
                    const isSelected = village.name === defaultValueKelurahan ? 'selected' : '';
                    selectElement.append(`<option value="${village.id}" ${isSelected}>${village.name}</option>`);
                });

                } catch (error) {
                console.error('Error fetching data:', error);
                }
            }
            } catch (error) {
            console.error('Error fetching data:', error);
            }
        })();
    })
@endpush