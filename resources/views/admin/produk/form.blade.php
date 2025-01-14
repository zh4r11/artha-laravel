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
    <div class="breadcrumb-item"><a href="{{ route('produk.index') }}">Master Produk</a></div>
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
          <form name="form-example-2" enctype="multipart/form-data">
            <input type="hidden" name="id_produk" id="id_produk" value="{{$produk -> id ?? ''}}">
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
                  <textarea id="input-deskripsi-produk" class="form-control" style="height: 200px" placeholder="Masukan Deskripsi Produk">{{$produk -> deskripsi ?? old('deskripsi')}}</textarea>
                  <div class="invalid-feedback" id="deskripsi-produk-error"></div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Foto Produk</label>
                  <div class="input-images-1" style="padding-top: .5rem;"></div>
                  <input type="hidden" name="deleted_photos" id="deleted-photos">
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
    <?php
      // Transform foto fields into an array
      $existingImages = [];
      if (!empty($produk->foto1)) {
          $existingImages[] = ['url' => $produk->foto1];
      }
      if (!empty($produk->foto2)) {
          $existingImages[] = ['url' => $produk->foto2];
      }
      if (!empty($produk->foto3)) {
          $existingImages[] = ['url' => $produk->foto3];
      }
      if (!empty($produk->foto4)) {
          $existingImages[] = ['url' => $produk->foto4];
      }
    ?>

    let imageCounter = 0;
    function generateImageId() {
      return imageCounter++;
    }
    let existingImages = <?php echo json_encode($existingImages); ?>;
    let baseDomain = "{{ env('APP_URL') }}"; // Pass base domain to JavaScript
    let baseUrl = baseDomain + '/storage/assets/images/products-images/'; // Construct full URL
    let preloadedImages = existingImages.map(image => ({
      id: generateImageId(), // Generate a unique ID for each image
      src: baseUrl + image.url // Construct full URL
    }));

    console.log(preloadedImages);

  $(document).ready(function() {
    
    $('.input-images-1').imageUploader({
      preloaded: preloadedImages,
      imagesInputName: 'photos',
      maxSize: 2 * 1024 * 1024, // 2MB
      maxFiles: 4,
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

    let deletedPhotos = [];

    $('.input-images-1').on('imageDeleted', function(event, image) {
      if (image.id) {
        deletedPhotos.push(image.id); // Track deleted photos
      }
      $('#deleted-photos').val(JSON.stringify(deletedPhotos)); // Update hidden input
    });

    $('form').on('submit', function (event){
      event.preventDefault();
      event.stopPropagation();

      let $form = $(this);
      // Create FormData object
      let formData = new FormData();

      const kode = $('#id_produk').val();
      const namaProduk = $('#input-nama-produk').val();
      const hargaProduk = $('#input-harga-produk').val();
      const hargaDiskon = $('#input-harga-diskon').val();
      const deskripsi = $('#input-deskripsi-produk').val();
      const deletedPhotos = $('#deleted-photos').val();

      console.log(namaProduk, hargaProduk, hargaDiskon, deskripsi, kode, deletedPhotos);

      formData.append('nama_produk', namaProduk);
      formData.append('harga_produk', hargaProduk);
      formData.append('harga_diskon', hargaDiskon);
      formData.append('deskripsi', deskripsi);
      formData.append('kode', kode);
      formData.append('deleted_photos', deletedPhotos);

      // Get the input file
      let $inputImages = $form.find('input[name^="images"]');
      if (!$inputImages.length) {
          $inputImages = $form.find('input[name^="photos"]')
      }

      for (let file of $inputImages.prop('files')) {
        formData.append('photos[]', file);
      }
      
      // Append form fields
      
      console.log(formData);
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

      var storeUrl = "{{ route('produk.store') }}";
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

  function EditBarang(data, kode) {
    if (data) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      console.log(data);
      var updateUrl = `{{ route('produk.update') }}`;
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