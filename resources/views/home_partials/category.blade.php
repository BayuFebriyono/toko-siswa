@foreach ($categories as $category)
    <div class="swiper-slide">
        <a href="/category-show/{{ $category->slug }}">
            @if ($category->url_photo)
                <img class="img-fluid" src="{{ asset('uploads/' . $category->url_photo) }}" alt="">
            @else
                <img class="img-fluid" src="{{ asset('uploads/product-image/no-pictures.png') }}" alt="">
            @endif
            <p class="fs-md-3 mt-3 fs-1">{{ $category->name }}</p>
        </a>
    </div>
@endforeach
