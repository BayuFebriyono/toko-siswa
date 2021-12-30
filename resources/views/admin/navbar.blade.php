<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('assets/img/gallery/laravel-logo.svg') }}" alt="Logo"
                            srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i data-feather="x"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ Request::is('admin-dashboard*') ? 'active' : '' }} ">
                    <a href="/admin-dashboard" class='sidebar-link'>
                        <i data-feather="package" class="text-dark"></i>
                        <span>Data Kategori</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('mydashboard-kirm*') ? 'active' : '' }} ">
                    <a href="/mydashboard-kirm" class='sidebar-link'>
                        <i data-feather="credit-card" class="text-dark"></i>
                        <span>Lihat Pembayaran</span>
                    </a>
                </li>

                <li class="sidebar-item ">
                    <a href="index.html" class='sidebar-link'>
                        <i data-feather="user" class="text-dark"></i>
                        <span>Data Admin</span>
                    </a>
                </li>

                <li class="sidebar-item ">
                    <a href="/" class='sidebar-link'>
                        <i data-feather="log-out" class="text-dark"></i>
                        <span>Kembali</span>
                    </a>
                </li>

            </ul>
        </div>
        {{-- <button class="sidebar-toggler btn x"><i data-feather="x"></i></button> --}}
    </div>
</div>
