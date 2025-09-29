<ul class="menu-inner py-1">

{{-- hak akses admin --}}
@if(auth()->check() && auth()->user()->role === 'admin')
    <!-- Dashboard -->
    <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <a href="{{route('admin.dashboard')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <!-- Components -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengiriman</span></li>
    <!-- Cards -->

    <li class="menu-item {{ request()->is('admin/pengiriman') ? 'active' : '' }}">
        <a href="{{route('admin.pengiriman.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-package"></i>
            <div data-i18n="Analytics">pengiriman</div>
        </a>
    </li>

    <li class="menu-item {{ request()->is('admin/area') ? 'active' : '' }}">
        <a href="{{route('admin.area.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-map"></i>
            <div data-i18n="Analytics">Set Area</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Akun</span>
    </li>

    <li class="menu-item {{ request()->is('admin/pelanggan') ? 'active' : '' }}">
        <a href="{{route('admin.pelanggan.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Analytics">Pelanggan</div>
        </a>
    </li>
    <li class="menu-item {{ request()->is('admin/kurir') ? 'active' : '' }}">
        <a href="{{route('admin.kurir.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx  bx-cycling"></i>
            <div data-i18n="Analytics">Kurir</div>
        </a>
    </li>

@endif

{{-- hak akses kurir --}}
@if(auth()->check() && auth()->user()->role === 'kurir')
    <!-- Dashboard -->
    <li class="menu-item {{ request()->is('kurir/dashboard') ? 'active' : '' }}">
        <a href="{{route('kurir.dashboard')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>



    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pengiriman</span>
    </li>

    <!-- Cards -->
    <li class="menu-item {{ request()->is('kurir/pengiriman') ? 'active' : '' }}">
        <a href=" {{route('kurir.pengiriman.index')}} " class="menu-link">
            <i class="menu-icon tf-icons bx bx-collection"></i>
            <div data-i18n="Basic">Tugas</div>
        </a>
    </li>
    <li class="menu-item {{ request()->is('kurir/pengiriman/riwayat') ? 'active' : '' }}">
        <a href=" {{route('kurir.pengiriman.riwayat')}} " class="menu-link">
            <i class="menu-icon tf-icons bx bx-collection"></i>
            <div data-i18n="Basic">Riwayat</div>
        </a>
    </li>

    <!-- Forms & Tables -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Akun</span></li>
    <li class="menu-item {{ request()->is('kurir/profile') ? 'active' : '' }}">
        <a href=" {{route('kurir.profile')}} " class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Basic">Profile</div>
        </a>
    </li>

@endif

</ul>
