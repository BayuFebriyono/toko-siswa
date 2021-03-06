@extends('myprofile.transaction.main')
@section('content')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link " href="/mytransaction/not-yet-paid">Belum Bayar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/mytransaction/proses">Proses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link bg-dark text-white" href="#">Berhasil</a>
        </li>
        <li class="nav-item">
            <a href="/mytransaction/gagal" class="nav-link">Gagal</a>
        </li>
    </ul>

    @if (session('success'))
        <script>
            Swal.fire(
                'Berhasil',
                "{{ session('success') }}",
                'success'
            )
        </script>
    @endif

    <!-- Modal -->
    <div class="modal fade " id="commentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeader">Ubah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/comments" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="product_id" name="product_id" value="">
                        <input type="hidden" id="order_id" name="order_id" value="">
                        <label for="comment" class="d-block">Review</label>
                        {{-- Bintang --}}
                        <div class="rate">
                            <input type="radio" id="star5" name="rate" value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rate" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rate" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rate" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rate" value="1" />
                            <label for="star1" title="text">1 star</label>
                        </div>
                        {{-- End Bintang --}}
                        <textarea id="comment" name="comment" class="form-control mt-3" rows="2" required></textarea>
                       
                        
                    </div>
                    <div class="modal-footer d-flex justify-content-start">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Box --}}


    {{-- Bagian Kontent --}}
    @if ($orders->count())
        @foreach ($orders as $order)
            <div class="row align-items-center mt-4">
                <div class="col-3 col-md-2">
                    @if ($order->orderDetail[0]->product->photo->count())
                        <img src="{{ asset('uploads/' . $order->orderDetail[0]->product->photo[0]->url) }}" alt="Error"
                            class=" rounded img-fluid">
                    @else
                        <img src="{{ asset('uploads/product-image/no-pictures.png') }}" alt="Error"
                            class=" rounded img-fluid">
                    @endif
                </div>
                <div class="col-9 col-md-8">
                    <div class="row">
                    </div>
                    <p class="fs-1 mt-3">{{ $order->orderDetail[0]->product->name }}</p>
                    <p class="fs-md-1 mt-0">Pesanan Telah Selesai</p>
                    <p class="fs-md-1 mt-0">No Resi : {{ $order->no_resi }}</p>
                    @if (!$order->comment)
                        <a class="btn btn-success"
                            onclick="fillComment({{ $order->id }},{{ $order->orderDetail[0]->product->id }})"
                            data-bs-toggle="modal" data-bs-target="#commentModal">Comment</a>
                    @endif
                </div>
            </div>
            <hr class="hr my-4">
        @endforeach
    @else
        <div class="text-center">
            <img src="{{ asset('assets/img/gallery/no-data.png') }}" alt="No Data" class="img-fluid">
        </div>
    @endif

    <script>
        function fillComment(order_id, product_id) {
            const order = document.getElementById('order_id');
            const product = document.getElementById('product_id');

            order.value = order_id;
            product.value = product_id;

        }
    </script>

@endsection
