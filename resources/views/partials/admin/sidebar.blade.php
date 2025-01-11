<!-- resources/views/partials/sidebar.blade.php -->
<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('dashboard') }}">Prestige</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('dashboard') }}">Pst</a>
    </div>
    <ul class="sidebar-menu">
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('dashboard') }}">Dashboard Penjualan</a></li>
          <!-- <li><a class="nav-link" href="#">Ecommerce Dashboard</a></li> -->
        </ul>
      </li>

      {{-- <li><a class="nav-link" href="{{ route('pesanan.index') }}"><i class="fas fa-shopping-basket"></i> <span>Pesanan</span></a></li> --}}

      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-basket"></i><span>Order</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('pesanan.index') }}"><span>Pesanan</span></a></li>
          <li><a class="nav-link" href="{{ route('invoice.index') }}"><span>Invoice</span></a></li>
          <li><a class="nav-link" href="{{ route('rekap.masak') }}"><span>Rekap Masak</span></a></li>
          <li><a class="nav-link" href="{{ route('rekap.potong') }}"><span>Rekap Potong</span></a></li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-boxes"></i><span>Barang</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('manage.barang.index') }}"><span>Barang</span></a></li>
          <li><a class="nav-link" href="{{route('transactions.index',['type' => 'masuk'])}}"><span>Transaksi Masuk</span></a></li>
          <li><a class="nav-link" href="{{route('transactions.index',['type' => 'keluar'])}}"><span>Transaksi Keluar</span></a></li>
          <li><a class="nav-link" href="{{ route('opname.index') }}"><span>Stok Opname</span></a></li>
          {{-- <li><a class="nav-link" href="#"><span>Pindah Gudang</span></a></li> --}}
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-tags"></i><span>Penjualan</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="#"><span>Invoice</span></a></li>
          <li><a class="nav-link" href="#"><span>Retur</span></a></li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-credit-card"></i><span>Pembelian</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="#"><span>Aset</span></a></li>
          <li><a class="nav-link" href="{{ route('kambingtransaksi.index') }}"><span>Kambing</span></a></li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-sliders-h"></i><span>Master</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('master-barang.index') }}"><span>Barang</span></a></li>
          <li><a class="nav-link" href="{{ route('master-dapur.index') }}"><span>Dapur</span></a></li>
          <li><a class="nav-link" href="{{ route('master-kategori.index') }}"><span>Kategori</span></a></li>
          <li><a class="nav-link" href="{{ route('master-kambing.index') }}"><span>Kambing</span></a></li>
          <li><a class="nav-link" href="{{ route('master-masakan.index') }}"><span>Masakan</span></a></li>
          <li><a class="nav-link" href="{{ route('master-paket.index') }}"><span>Paket</span></a></li>
          <li><a class="nav-link" href="{{ route('master-user.index') }}"><span>Pengguna</span></a></li>
          <li><a class="nav-link" href="{{route('master-role.index')}}"><span>Role</span></a></li>
          <li><a class="nav-link" href="{{route('master-sourceleads.index')}}"><span>Source Leads</span></a></li>
          <li><a class="nav-link" href="{{route('master-potong.index')}}"><span>Tempat Potong</span></a></li>
        </ul>
      </li>
    </ul>
  </aside>
</div>