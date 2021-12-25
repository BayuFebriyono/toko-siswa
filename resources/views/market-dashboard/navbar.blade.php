<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i data-feather="x"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ Request::is('mydashboard-konfirmasi*') ? 'active' : '' }} ">
                    <a href="/mydashboard-konfirmasi" class='sidebar-link'>
                        <i data-feather="check-circle" class="text-dark"></i>
                        <span>Konfirmasi Pesanan</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('mydashboard-kirm*') ? 'active' : '' }} ">
                    <a href="/mydashboard-kirm" class='sidebar-link'>
                        <i data-feather="package" class="text-dark"></i>
                        <span>Kirimkan Pesanan</span>
                    </a>
                </li>

                <li class="sidebar-item ">
                    <a href="index.html" class='sidebar-link'>
                        <i data-feather="smile" class="text-dark"></i>
                        <span>Pesanan Terkirim</span>
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
