@extends('layouts.admin.app')

@section('title', 'Pelanggan')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">
@endpush

@section('content')
<div class="section-header">
  <h1>Order</h1>
</div>
<div class="section-body">
  {{-- <div class="d-flex justify-content-end align-items-center mb-3">
    <a href="{{ route('order.create') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Tambah Order
    </a>
  </div> --}}
  <div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>Action</th>
                  <th>No. Order</th>
                  <th>Nama</th>
                  <th>Telp</th>
                  <th>Tanggal Pesan</th>
                  <th>Tracking Number</th>
                  <th>Total</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
<!-- Modal for Order Details -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderDetailModalLabel">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
          <strong>No. Order:</strong> <span id="orderNo"></span><br>
          <strong>Nama:</strong> <span id="customerName"></span><br>
          <strong>Telp:</strong> <span id="customerPhone"></span><br>
          <strong>Tracking Number:</strong> <span id="trackingNumber"></span><br>
          <strong>Total:</strong> <span id="orderTotal"></span><br>
        </div>
        <table class="table mt-3">
          <thead>
            <tr>
              <th>Nama Produk</th>
              <th>Quantity</th>
              <th>Harga Satuan</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody id="orderDetailsBody">
            <!-- Order details will be populated here -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer" id='modal-footer'>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {{-- <button type="button" id="updateStatusButton" class="btn btn-primary" data-id="" data-status="" onclick="updateStatusButton(this)">Update Status</button> --}}
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>
<script>
  $(document).ready(function() {
    // Initialize DataTable
    var Url = "{{ route('order-list') }}";
    $('#table-1').DataTable({
      language: {
        emptyTable: 'No data available'
      },
      responsive: true,
      scrollX: false,
      columnDefs: [
      {
        targets: [0],
        width:'5%'
      },
      {
        targets: 1,
        width:'15%'
      },
      {
        targets: 2,
        width:'20%'
      },
      {
        targets: 3,
        width:'10%'
      }],
      order: [
        [1, 'asc']
      ],
      ajax: {
        url: Url,
        dataSrc: 'data'
      },
      columns: [
        {
          "data": null,
          "render": function(data, type, row) {
            var buttons = [];
            // buttons.push('<a href="#" data-id="' + row.id + '" onclick="EditOrder(this)">Edit</a>&nbsp;&nbsp;');
            // buttons.push('<a href="#" data-id="' + row.id + '" onclick="UpdateOrder(this)">Update</a>&nbsp;&nbsp;');
            buttons.push('<a href="#" data-id="' + row.id + '" onclick="DetailOrder(this)">Detail</a>&nbsp;&nbsp;');
            return buttons.join(' ');
          }
        },
        {
          data: 'no_order'
        },
        {
          data: 'pelanggan.nama_pelanggan'
        },
        {
          data: 'telepon'
        },
        {
          data: 'created_at',
          render: function(data, type, row) {
            var date = new Date(data);
            var day = date.getDate();
            var month = date.toLocaleString('default', { month: 'long' });
            var year = date.getFullYear();
            return day + ' ' + month + ' ' + year;
          }
        },
        {
          data: 'tracking_number'
        },
        {
          data: 'total',
          render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')
        },
        {
          data: 'status',
          render: function(data, type, row) {
            return data.toUpperCase();
          }
        }
      ]
    });
  });

  function updateStatusButton(button) {
    const orderId = button.getAttribute('data-id'); // Assuming orderNo contains the order ID
    const status = button.getAttribute('data-status'); // Assuming status is a select element
    var Url = `{{ route('order.update-status') }}`;
    if (status == 'processed') { // Check if the new status is 'processed'
        // Use SweetAlert to prompt for the tracking number
        $('#orderDetailModal').modal('hide');
        Swal.fire({
            title: 'Enter Tracking Number',
            input: 'text',
            inputLabel: 'Tracking Number',
            inputPlaceholder: 'Enter tracking number',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel',
            preConfirm: (trackingNumber) => {
                if (!trackingNumber) {
                    Swal.showValidationMessage('You need to enter a tracking number');
                }
                return trackingNumber;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const trackingNumber = result.value; // Get the tracking number from the result
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: Url, // Adjust this URL to match your route
                    method: 'POST',
                    data: {
                        id:orderId,
                        tracking_number: trackingNumber // Include the tracking number in the data
                    },
                    success: function(response) {
                        Swal.fire({
                          title: 'Success!',
                          text: response.message,
                          icon: 'success',
                          confirmButtonText: 'Close'
                        });
                        $('#table-1').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        alert('Error updating status: ' + xhr.responseJSON.message);
                    }
                });
            }
        });
    } else {

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: Url, // Adjust this URL to match your route
        method: 'POST',
        data: {
            id:orderId
        },
        success: function(response) {
            Swal.fire({
              title: 'Success!',
              text: response.message,
              icon: 'success',
              confirmButtonText: 'Close'
            });
            $('#orderDetailModal').modal('hide');
            $('#table-1').DataTable().ajax.reload();
        },
        error: function(xhr) {
            alert('Error updating status: ' + xhr.responseJSON.message);
        }
      });
    }
  }

  function DetailOrder(button) {
      const orderId = button.getAttribute('data-id');
      $.ajax({
        url: `/admin-page/order/${orderId}`, // Adjust this URL to match your route
        method: 'GET',
        success: function(response) {
          // Populate the modal with order response
          response.data.forEach(function(data) {
            $('#orderNo').text(data.no_order);
            $('#customerName').text(data.nama);
            $('#customerPhone').text(data.telepon);
            $('#trackingNumber').text(data.tracking_number);
            $('#updateStatusButton').attr('data-id', data.id);
            $('#updateStatusButton').attr('data-status', data.status);
            const hargaProduk = data.total;

            const formattedHarga = hargaProduk 
                ? `Rp. ${Math.floor(hargaProduk).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}` 
                : 'Rp. 0'; // Fallback if harga_produk is not available

            $('#orderTotal').text(formattedHarga);
            
            // Populate the modal with order details
            $('#orderDetailsBody').empty();
            if (data.order_detail) {
              data.order_detail.forEach(function(detail) {
                $('#orderDetailsBody').append('<tr><td>' + detail.produk.nama_produk + '</td><td>' + detail.qty + '</td><td> Rp. ' + detail.produk.harga_produk.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</td><td> Rp. ' + (detail.qty * detail.produk.harga_produk).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</td></tr>');
              });
            } else {
              $('#orderDetailsBody').append('<tr><td colspan="2">No details available</td></tr>');
            }
            $('#modal-footer').empty();
            if( data.status != 'completed' && data.status != 'canceled' && data.status != 'new' && data.status != 'delivered') {
              $('#modal-footer').append('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
              $('#modal-footer').append('<button type="button" id="updateStatusButton" class="btn btn-primary" data-id="'+data.id+'" data-status="'+data.status+'" onclick="updateStatusButton(this)">Update Status</button>');
            }else {
              $('#modal-footer').append('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
            }
            $('#orderDetailModal').modal('show');
          });
          
            
        }
      });
    }
</script>
@endpush

@section('js-page')
@endsection
