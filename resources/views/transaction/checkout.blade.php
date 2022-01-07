@extends('transaction.main')

@section('content')
    <div class="container">
        <h2 class="text-center mb-6">Checkout</h2>
        <div class="row">
            <div class="col-md-4 text-center text-md-start">
                @if ($cart->product->photo->count())
                    <img src="{{ asset('uploads/' . $cart->product->photo[0]->url) }}" alt="" class="img-fluid">
                @else
                    <img src="{{ asset('uploads/product-image/no-pictures.png') }}" alt="" class="img-fluid">
                @endif

            </div>

            <div class="col-md-8 mt-4">
                <form action="/order" method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="market_id" value="{{ $cart->product->market->id }}">
                        <input type="hidden" id="total-akhir" name="total" value="{{ $cart->total }}">
                        <input type="hidden" id="kurir_name" name="kurir_name">
                        <input type="hidden" name="product_id" value="{{ $cart->product->id }}">
                        <input type="hidden" name="qty" value="{{ $cart->qty }}">
                        <input type="hidden" name="cart_id" value="{{ $cart->id }}">



                        <div class="col-md-6">
                            <label for="penerima">Nama Penerima</label>
                            <input type="text" id="penerima" name="nama_penerima" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="handphone">Nomor Hp</label>
                            <input type="number" id="handphone" name="nomor_hp" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class=" mt-4">Price Rp {{ number_format($cart->total, 0, ',', '.') }}</div>
                        <hr class="mt-2">
                        <h5>Ongkos Pengiriman</h5>
                        <div class="col-md-6">
                            <label for="provinsi"></label>
                            <select name="province_id" id="provinsi" class="form-select">
                                <option value="" selected disabled>--- Pilih Provinsi ---</option>
                                @foreach ($provinsi as $pro)
                                    <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="kota"></label>
                            <select name="citiy_id" id="kota" class="form-select">
                                <option value="" selected disabled>--- Pilih Kota/Kabupaten ---</option>
                            </select>
                        </div>
                        <h5 class="mt-4">Pilih Pengiriman</h5>
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="jasa">Jasa Pengiriman</label>
                                    <select name="jasa" id="jasa" class="form-select" required>
                                        <option value="" selected disabled>--- Pilih Pengirim ---</option>
                                        <option value="jne">JNE</option>
                                        <option value="pos">Kantor Pos</option>
                                        <option value="tiki">Tiki</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="pengirim">Layanan Pengiriman</label>
                                    <select name="pengirim" id="pengirim" class="form-select" required>
                                        <option value="" selected disabled>--- Pilih Pengirim ---</option>
                                    </select>
                                    <div class="progress my-3" id="progress" style="display: none;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <p id="ongkir">Ongkos Kirim : Rp. 0</p>
                        <p id="total-bayar">Total : Rp. {{ number_format($cart->total, 0, ',', '.') }}</p>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-6" style="width: 12rem;">Beli Sekarang</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/view-js/checkout-ajax.js') }}"></script>
    <script>
        function rubah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return ribuan;
        }
        $(document).ready(function() {
            //saat pilihan provinsi di pilih, maka akan mengambil data kota
            //di data-wilayah.php menggunakan ajax
            $("#jasa").change(function() {
                let jasa = $(this).val();
                let id_kota = $('#kota').val();
                let kota_asal = '{{ $cart->product->market->city_id }}';
                let berat = '{{ $cart->product->berat * $cart->qty * 1000 }}';
                $("#progress").show();
                $.ajax({
                    url: "/check-ongkir",
                    data: {
                        city_origin: kota_asal,
                        city_destination: id_kota,
                        weight: berat,
                        kurir: jasa
                    },
                    dataType: "JSON",
                    type: "POST",
                    success: function(response) {
                        $('#pengirim').html(
                            '<option selected disabled>--- Pilih Pengirim --- </option>'
                        );

                        if (response) {
                            $.each(response[0]['costs'], function(key, value) {
                                $('#pengirim').append('<option value = "' + value.cost[
                                        0].value + '" data-name="' + response[
                                        0].code.toUpperCase() + value.service +
                                    '">' + response[
                                        0].code.toUpperCase() + " " + value
                                    .service +
                                    ' </option>')
                            });
                            $("#progress").hide();
                        }
                    },
                    error: function(request, status, errorThrown) {
                        $("#progress").hide();
                        alert("Terjadi Masalah Silahkan Coba Lagi")
                    }
                });
            });
            $("#pengirim").change(function() {
                let harga = $(this).val();
                const ongkir = document.getElementById('ongkir');
                const total = document.getElementById('total-bayar');
                const totalAkhir = document.getElementById('total-akhir');
                //Variabel Nama Kurir 
                const namaPengirim = $('#pengirim option:selected').data('name');
                const kurirName = $('#kurir_name');
                kurirName.val(namaPengirim);

                ongkir.innerHTML = "Ongkos Kirim : Rp. " + rubah(harga);
                total.innerHTML = "Total : Rp. " + rubah((Number(harga) + Number({{ $cart->total }})));
                totalAkhir.value = (Number(harga) + Number({{ $cart->total }}));

            });
        });
    </script>
@endsection
