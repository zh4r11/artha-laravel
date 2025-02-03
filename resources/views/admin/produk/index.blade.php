@extends('layouts.admin.app')

@section('title', 'Master Produk')

@push('css')
<!-- DataTables CSS from CDN -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.bootstrap4.min.css"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">
@endpush

@section('content')
<div class="section-header">
  <h1>Master Produk</h1>
</div>
<div class="section-body">
  <div class="d-flex justify-content-end align-items-center mb-3">
    <a href="{{ route('produk.create') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Tambah Produk
    </a>
  </div>
  <div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>Action</th>
                  <th>Kode Produk</th>
                  <th>Nama Produk</th>
                  <th>Harga Produk</th>
                  <th>Harga Diskon</th>
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
</div>
@endsection
@vite(['resources/css/app.css', 'resources/js/app.js'])

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>
<script>
  $(document).ready(function() {
    var Url = "{{ route('produk-list') }}";
    $('#table-1').DataTable({
      language: {
        emptyTable: 'No data available'
      },
      responsive: true,
      scrollX: false,
      columnDefs: [
     {
        width: '5%',
        targets: [5]
      },
      {
        targets: [1],
        visible: false
      },
      {
        targets: [0],
        width:'10%'
      },
      {
        targets: [3,4],
        width:'15%'
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
          // Define a custom column for buttons
          "data": null,
          "render": function(data, type, row) {
            // Create buttons dynamically
            var buttons = [];
            buttons.push('<a href="#" data-id="' + row.id + '" onclick="EditBarang(this)">Edit</a>&nbsp;&nbsp;');
            buttons.push('<a href="#" data-id="' + row.id + '" onclick="HapusBarang(this)">Hapus</a>');
            return buttons.join(' ');
          }
        },
        {
          data: 'id'
        },
        {
          data: 'nama_produk'
        },
        {
            data: 'harga_produk',
            render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')
        },
        {
          data: 'harga_diskon',
          render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')
        },
      ]
    });

    var toastMessage = localStorage.getItem('toastMessage');
    var toastType = localStorage.getItem('toastType');

    if (toastMessage) {
      if (toastType === 'success') {
        toastr.success(toastMessage);
      }
      localStorage.removeItem('toastMessage');
      localStorage.removeItem('toastType');
    }
  });

  function EditBarang(button) {
    const kode = button.getAttribute('data-id');
    if (kode != null) {
      window.location.href = `/admin-page/produk/${kode}/edit`
    }
  }

  function HapusBarang(button) {
    const kode = button.getAttribute('data-id');

    if (kode) {
      Swal.fire({
        icon: 'warning',
        html: `Apakah Anda yakin ingin menghapus barang?`,
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
          
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          var deleteUrl = `{{ route('produk.destroy', ':kode') }}`.replace(':kode', kode);
          $.ajax({
            url: deleteUrl,
            method: 'DELETE',
            success: function(response) {
              if (response.status) {
                // Reload DataTables on success
                var table = $('#table-1').DataTable();
                table.ajax.reload();

                Swal.fire({
                  icon: 'success',
                  title: 'Sukses!',
                  text: response.message
                });
              } else {
                Swal.fire('Error', response.message, 'error');
              }
            },
            error: function(xhr, status, error) {
              toastr.error('Terjadi kesalahan : ' + error);
            }
          });
        }
      });
    } else {
      toastr.warning('Kode barang tidak ditemukan.');
    }
  }
</script>
@endpush

@section('js-page')
<!-- <script src="{{ asset('admin/assets/js/page/index-0.js') }}"></script> -->
<!-- <script src="../assets/js/page/index-0.js"></script> -->
@endsection