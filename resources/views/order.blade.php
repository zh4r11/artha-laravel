@extends('layouts.app')

@section('content')
<div class="cart-main-area mtb-60px">
    <div class="container">
        <h3 class="cart-page-title">Your orders</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>No. Order</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Nomor Resi</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="product-name"><a href="#">{{ $order->no_order }}</a></td>
                                        <td class="product-name"><a href="#">{{ $order->created_at->format('d-m-Y') }}</a></td>
                                        <td class="product-name"><a href="#">{{ $order->tracking_number }}</a></td>
                                        <td class="product-price-cart"><span class="amount">Rp. {{ number_format($order->total, 0, ',', '.') }}</span></td>
                                        <td class="product-name"><a href="#">{{ $order->status == 'new' ? 'WAITING FOR PAYMENT' : strtoupper($order->status) }}</a></td>
                                        <td class="product-remove">
                                            @if ($order->status != 'canceled')
                                                <a href="#" onclick="downloadInvoice({{ $order->id }})"><i class="fa fa-download"></i></a>
                                            @endif
                                            @if ($order->status == 'new')
                                                <a href="#" onclick="uploadInvoice({{ $order->id }})"><i class="fa fa-upload"></i></a>
                                                <a href="#" onclick="cancelOrder({{ $order->id }})"><i class="fa fa-times"></i></a>
                                            @elseif ($order->status == 'delivered')
                                                <a href="#" onclick="completeOrder({{ $order->id }})"><i class="fa fa-check"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@vite(['resources/css/app.css', 'resources/js/app.js'])
@push('scripts')
<script>
    function uploadInvoice(id) {
        Swal.fire({
            title: 'Upload Bukti Bayar',
            html: '<input type="file" id="document" class="swal2-input">',
            confirmButtonText: 'Upload',
            showCancelButton: true,
            preConfirm: () => {
                Swal.showLoading();
                const file = document.getElementById('document').files[0];
                if (!file) {
                    Swal.showValidationMessage('Please select a file');
                    return;
                }
                const formData = new FormData();
                formData.append('document', file);
                formData.append('id', id);
                var Url = `{{ route('upload-bukti') }}`;
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
                            Swal.fire('Success', 'Document uploaded successfully', 'success');
                            location.reload();
                        } else {
                            Swal.fire('Error', 'Failed to upload document', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        Swal.fire('Error', 'Failed to upload document', 'error');
                    }
                });
            }
        });
    }

    function downloadInvoice(id) {
        const formData = new FormData();
        formData.append('id', id);
        var Url = `{{ route('download-invoice') }}`;
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.showLoading();
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
                Swal.fire('Error', 'Failed to upload document', 'error');
            }
        });
    }

    function completeOrder(id) {
        const formData = new FormData();
        formData.append('id', id);
        var Url = `{{ route('complete-order') }}`;
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.showLoading();
        $.ajax({
            type: 'POST',
            url: Url,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.close();
                if (response.success) {
                    location.reload();
                } else {
                    Swal.fire('Error', 'Update Order Status', 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.close();
                Swal.fire('Error', 'Update Order Status', 'error');
            }
        });
    }

    function cancelOrder(id) {
        const formData = new FormData();
        formData.append('id', id);
        var Url = `{{ route('cancel-order') }}`;
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.showLoading();
        $.ajax({
            type: 'POST',
            url: Url,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.close();
                if (response.success) {
                    location.reload();
                } else {
                    Swal.fire('Error', 'Update Order Status', 'error');
                }
            },
            error: function(xhr, status, error) {
                Swal.close();
                Swal.fire('Error', 'Update Order Status', 'error');
            }
        });
    }
</script>
@endpush