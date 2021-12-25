{{-- <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand d-inline-flex" href="/"><span
                class="text-1000 fs-0 fw-bold ms-2">Example</span></a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item px-2"><a class="nav-link fw-medium" href="#collection">Collection</a></li>
                <li class="nav-item px-2"><a class="nav-link fw-medium" href="/markets">Toko</a></li>
            </ul>

            @auth
                <form class="d-flex" method="POST" action="/logout">
                    @csrf
                    <a class="text-1000" href="/cart/my/{{ auth()->user()->username }}">
                        <svg class="feather feather-shopping-cart me-3" xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </a>

                    <div class="dropdown d-inline">
                        <span class="dropdown-toggle" data-bs-toggle="dropdown"> <a href="#">Welcome Back
                                {{ auth()->user()->name }}</a></span>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/myaccount">Profile</a></li>
                            <button class="dropdown-item">Logout</button>
                        </ul>
                    </div>
                </form>
            @else
                <form class="d-flex">
                    <a class="text-1000 btn btn-dark text-white " href="/login">
                        Masuk
                    </a>
                </form>
            @endauth
        </div>
    </div>
</nav> --}}


<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-info">
    <div class="container">
        <a class="navbar-brand" href="/">UD Barokah</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li>
                    <form class="d-flex" method="GET" action="/search/product">
                        <input class="form-control ms-0 ms-md-4 me-2" type="search" placeholder="Cari Barang" name="name">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                </li>

            </ul>

            @auth
                <form class="d-flex text-white" method="POST" action="/logout">
                    @csrf
                    <a class="text-1000 text-white" href="/cart/my/{{ auth()->user()->username }}">
                        <svg class="feather feather-shopping-cart me-3" xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </a>

                    <div class="dropdown d-inline">
                        <span class="dropdown-toggle" data-bs-toggle="dropdown"> <a href="#" class="text-white">Welcome
                                Back
                                {{ auth()->user()->name }}</a></span>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/myaccount">Profile</a></li>
                            <button class="dropdown-item">Logout</button>
                        </ul>
                    </div>
                </form>
            @else
                <div class="text-center mt-md-0 mt-4">
                    <a href="/login" class="btn btn-outline-light ">Masuk</a>
                </div>
            @endauth


        </div>
    </div>
</nav>
