@extends('layouts.admin.app')

@section('title', 'Pelanggan')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" />
<link type="text/css" rel="stylesheet" href="https://christianbayer.github.io/image-uploader/dist/image-uploader.min.css
">
@endpush

@section('content')
<div class="section-header">
  <h1>Pelanggan</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></div>
    <div class="breadcrumb-item active" aria-current="page">{{$isFormEdit ? 'Edit Pelanggan' : 'Tambah Pelanggan'}}</div>
  </div>
</div>
<div class="section-body">
  <div class="row justify-content-center">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card border-primary">
        <div class="card-header bg-primary">
          <h4 class="text-white">{{ $isFormEdit ? 'Edit' : 'Tambah' }} Pelanggan</h4>
        </div>
        <div class="card-body">
          <form name="form-example-2" enctype="multipart/form-data">
            <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="{{$pelanggan -> id ?? ''}}">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Nama Pelanggan*</label>
                  <input type="text" id="input-nama-pelanggan" class="form-control" placeholder="Masukan Nama pelanggan" value="{{$pelanggan -> nama_pelanggan ?? old('nama_pelanggan')}}" required>
                  <div class="invalid-feedback" id="nama-pelanggan-error"></div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label>Email*</label>
                  <input type="email" id="input-email-pelanggan" class="form-control" placeholder="Masukan Email Pelanggan" value="{{$pelanggan -> email ?? old('email')}}" required>
                  <div class="invalid-feedback" id="email-pelanggan-error"></div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label>Telp*</label>
                  <input type="text" id="input-telp-pelanggan" class="form-control" placeholder="Masukan Telp Pelanggan" value="{{$pelanggan -> tlp ?? old('tlp')}}" required>
                  <div class="invalid-feedback" id="telp-pelanggan-error"></div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Alamat*</label>
                  <textarea id="input-alamat-pelanggan" class="form-control" style="height: 200px" placeholder="Masukan Alamat Pelanggan">{{$pelanggan -> alamat_pelanggan ?? old('alamat_pelanggan')}}</textarea>
                  <div class="invalid-feedback" id="alamat-produk-error"></div>
                </div>
              </div>
            </div>
            <div class="card-footer text-right">
              <button class="btn btn-primary" type="submit" id="btn-simpan">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@vite(['resources/css/app.css', 'resources/js/app.js'])


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://christianbayer.github.io/image-uploader/dist/image-uploader.min.js
"></script>
<script>
  $(document).ready(function() {

    $('form').on('submit', function (event){
      event.preventDefault();
      event.stopPropagation();

      let $form = $(this);
      // Create FormData object
      let formData = new FormData();

      const kode = $('#id_pelanggan').val();
      const namaPelanggan = $('#input-nama-pelanggan').val();
      const emailPelanggan = $('#input-email-pelanggan').val();
      const telp = $('#input-telp-pelanggan').val();
      const alamat = $('#input-alamat-pelanggan').val();

      formData.append('nama_pelanggan', namaPelanggan);
      formData.append('email_pelanggan', emailPelanggan);
      formData.append('telp_pelanggan', telp);
      formData.append('alamat', alamat);
      formData.append('kode', kode);
      
      const isFormEdit = <?php echo json_encode($isFormEdit); ?>;
      
      if (isFormEdit) {
        EditBarang(formData, kode); // Call EditBarang for editing
      } else {
        TambahBarang(formData); // Call TambahBarang for adding
      }
    });
  });

  function TambahBarang(data) {
    if (data) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      var storeUrl = "{{ route('pelanggan.store') }}";
      $.ajax({
        url: storeUrl,
        method: 'POST',
        data: data,
        processData: false, // Required for FormData
        contentType: false, // Required for FormData
        success: function(response) {
          if (response.status) {
            $('#btn-simpan').prop('disabled', false).html('Simpan');
            localStorage.setItem('toastMessage', response.message);
            localStorage.setItem('toastType', 'success');
            window.location.href = "{{ route('pelanggan.index') }}";
          } else {
            $('#btn-simpan').prop('disabled', false).html('Simpan');
            toastr.warning(response.message);
          }
        },
        error: function(xhr, status, error) {
          $('#btn-simpan').prop('disabled', false).html('Simpan');
          toastr.warning('Terjadi kesalahan:', error);
        }
      })
    } else {
      $('#btn-simpan').prop('disabled', false).html('Simpan');
      toastr.warning('Terjadi Kesalahan Input Data')
    }
  }

  function EditBarang(data, kode) {
    if (data) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      console.log(data);
      var updateUrl = `{{ route('pelanggan.update') }}`;
      console.log(updateUrl);
      $.ajax({
        url: updateUrl,
        method: 'POST',
        data: data,
        processData: false, // Required for FormData
        contentType: false, // Required for FormData
        success: function(response) {
          if (response.status) {
            $('#btn-simpan').prop('disabled', false).html('Simpan');
            localStorage.setItem('toastMessage', response.message);
            localStorage.setItem('toastType', 'success');
            window.location.href = "{{ route('pelanggan.index') }}";
          } else {
            $('#btn-simpan').prop('disabled', false).html('Simpan');
            toastr.warning(response.message);
          }
        },
        error: function(xhr, status, error) {
          $('#btn-simpan').prop('disabled', false).html('Simpan');
          toastr.warning('Terjadi kesalahan:', error);
        }
      })
    } else {
      $('#btn-simpan').prop('disabled', false).html('Simpan');
      toastr.warning('Terjadi Kesalahan Input')
    }
  }
</script>
@endpush