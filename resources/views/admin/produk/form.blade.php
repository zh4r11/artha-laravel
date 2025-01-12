@extends('layouts.admin.app')

@section('title', 'Master Produk')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" />
<link type="text/css" rel="stylesheet" href="https://christianbayer.github.io/image-uploader/dist/image-uploader.min.css
">
@endpush

@section('content')
<div class="section-header">
  <h1>Master Produk</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item"><a href="{{ route('produk-list') }}">Master Produk</a></div>
    <div class="breadcrumb-item active" aria-current="page">{{$isFormEdit ? 'Edit Produk' : 'Tambah Produk'}}</div>
  </div>
</div>
<div class="section-body">
  <div class="row justify-content-center">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card border-primary">
        <div class="card-header bg-primary">
          <h4 class="text-white">{{ $isFormEdit ? 'Edit' : 'Tambah' }} Barang</h4>
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Nama Produk*</label>
                  <input type="text" id="input-nama-produk" class="form-control" placeholder="Masukan Nama produk" value="{{$produk -> nama_produk ?? old('nama_produk')}}" required>
                  <div class="invalid-feedback" id="nama-produk-error"></div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label>Harga Produk*</label>
                  <input type="number" id="input-harga-produk" class="form-control" placeholder="Masukan Harga Produk" value="{{$produk -> harga_produk ?? old('harga_produk')}}" required>
                  <div class="invalid-feedback" id="harga-produk-error"></div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <label>Harga Diskon*</label>
                  <input type="number" id="input-harga-diskon" class="form-control" placeholder="Masukan Harga Diskon" value="{{$produk -> harga_diskon ?? old('harga_diskon')}}" required>
                  <div class="invalid-feedback" id="harga-diskon-error"></div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Deskripsi Produk*</label>
                  <textarea id="input-deskripsi-produk" class="form-control" placeholder="Masukan Deskripsi Produk">{{$produk -> deskripsi ?? old('deskripsi')}}</textarea>
                  <div class="invalid-feedback" id="deskripsi-produk-error"></div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Foto Produk</label>
                  <div class="input-images-1" style="padding-top: .5rem;"></div>
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
{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://christianbayer.github.io/image-uploader/dist/image-uploader.min.js
"></script>
<script>
  $(document).ready(function() {
    let isKodeBarangValid = true;
    let isNamaBarangValid = true;
    let isQtyValid = true;
    $('.input-images-1').imageUploader({
      imagesInputName: 'photos',
      maxSize: 2 * 1024 * 1024, // 2MB
      maxFiles: 10,
      extensions: ['.jpg', '.jpeg', '.png'],
      resize: 1000,
      label: 'Drag and drop images or click to select',
      labelDragged: 'Drag and drop or click to select',
      labelChanged: 'Image selected',
      labelErrorSize: 'Size exceeded: ',
      labelErrorExtension: 'Invalid extension: ',
      labelErrorMaxFiles: 'Maximum number of files exceeded: ',
      labelErrorMaxSize: 'Maximum size exceeded: ',
      language: 'en',
      allowedExtensions: ['.jpg', '.jpeg', '.png']
    });

    $('#input-satuan').on('input', function() {
      const inputValue = $(this).val();
      const $input = $(this);
      const $textError = $('#satuan-error');
      if (inputValue.length == 0) {
        $input.addClass('is-invalid');
        $textError.text('Satuan harus di isi!');
        isNamaBarangValid = false;
      } else if (inputValue.includes("'")) {
        $input.addClass('is-invalid');
        $textError.text(`Karakter apostrof (') tidak diizinkan.`);
        isNamaBarangValid = false;
      } else {
        $input.removeClass('is-invalid');
        isNamaBarangValid = true;
      }
    });

    $('#btn-simpan').click((e) => {
      e.preventDefault();
      $('#btn-simpan').prop('disabled', true).html('Loading...');

      const formData = new FormData();
      const images = $('.input-images-1').imageUploader('getImages');

      // Check if images is an array and has items
      if (Array.isArray(images) && images.length > 0) {
          images.forEach((image, index) => {
              formData.append('photos[]', image.file);
          });
      } else {
          console.log('No images uploaded.');
      }

      // Append other form data
      formData.append('nama_produk', $('#input-nama-produk').val());
      formData.append('harga_produk', $('#input-harga-produk').val());
      formData.append('harga_diskon', $('#input-harga-diskon').val());
      formData.append('deskripsi', $('#input-deskripsi-produk').val());
      console.log(formData);

      const isFormEdit = <?php echo json_encode($isFormEdit); ?>;
      isFormEdit ? EditBarang(formData) : TambahBarang(formData);
      $('#btn-simpan').prop('disabled', false).html('Simpan');
    });
  });

  function TambahBarang(data) {
    if (data) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      var storeUrl = "{{ route('produk.store') }}";
      $.ajax({
        url: storeUrl,
        method: 'POST',
        data: data,
        success: function(response) {
          if (response.status) {
            $('#btn-simpan').prop('disabled', false).html('Simpan');
            localStorage.setItem('toastMessage', response.message);
            localStorage.setItem('toastType', 'success');
            window.location.href = "{{ route('produk.index') }}";
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

  function EditBarang(data) {
    if (data) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      var updateUrl = `{{ route('produk.update', ':kode') }}`.replace(':kode', data.kode);
      $.ajax({
        url: updateUrl,
        method: 'PUT',
        data: data,
        success: function(response) {
          if (response.status) {
            $('#btn-simpan').prop('disabled', false).html('Simpan');
            localStorage.setItem('toastMessage', response.message);
            localStorage.setItem('toastType', 'success');
            window.location.href = "{{ route('produk.index') }}";
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