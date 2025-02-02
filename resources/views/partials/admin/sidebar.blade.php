<!-- resources/views/partials/sidebar.blade.php -->
<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('dashboard') }}">Artha Kreasi</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('dashboard') }}">ATK</a>
    </div>
    <ul class="sidebar-menu">
      <li><a class="nav-link" href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>

      <li><a class="nav-link" href="{{ route('order.index') }}"><i class="fas fa-shopping-basket"></i> <span>Pesanan</span></a></li>
      <li><a class="nav-link" href="{{ route('pelanggan.index') }}"><i class="fas fa-user"></i> <span>Pelanggan</span></a></li>

      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-sliders-h"></i><span>Master</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('produk.index') }}"><span>Produk</span></a></li>
        </ul>
      </li>
    </ul>
  </aside>
</div>