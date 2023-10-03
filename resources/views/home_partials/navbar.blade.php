<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-info">
    <div class="container">
        <a class="navbar-brand" href="/">{{ $identitas->judul }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li>
                    <form class="d-flex" method="GET" action="/search/product">
                        <input class="form-control ms-0 ms-md-4 me-2" type="search" placeholder="Cari Barang"
                            name="name">
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
                            @if (auth()->user()->is_admin)
                                <li><a class="dropdown-item" href="/admin-dashboard">Admin Area</a></li>
                            @endif
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
