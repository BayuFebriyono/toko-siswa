<?php

use App\Http\Controllers\AdminController;
use App\Models\Cart;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Market;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MarketDashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MyTransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route Utama
Route::get('/', [HomeController::class, 'index']);

//Route Login
Route::post('/auth', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);

//Route Registrasi
Route::post('/registrasi', [RegisterController::class, 'store']);

//Route Markets
Route::post('/save', [MarketController::class, 'store']);
Route::post('/edit-toko/{market:slug}', [MarketController::class, 'update']);
Route::post('/crop',  [MarketController::class, 'editImage'])->name('crop');
Route::get('/markets', function () {
    return view('market.index');
});
Route::get('/market/show/{market:slug}', [MarketController::class, 'show']);

//Route MiddleWare Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');

    Route::get('/registrasi', [RegisterController::class, 'index']);
});

// Route Middleware Auth
Route::middleware('auth')->group(function () {
    //Route Profil
    Route::get('/myaccount', function () {
        return view('myprofile.index', [
            'carts' =>  Cart::where('user_id', auth()->user()->id)->get(),
            'order' => Order::where('user_id', auth()->user()->id),
            'provinsi' => Province::all()
        ]);
    });
    Route::get('/myaccount/market', [MarketController::class, 'myMarket']);

    //Route CRUD cart
    Route::resource('/cart', CartController::class);
    Route::get('/cart/my/{user:username}', [CartController::class, 'mycart']);

    // Route CRUD user
    Route::resource('/myaccount/user', UserController::class);


    // Route product Photo
    Route::post('/product/addPhoto', [ProductController::class, 'addPhoto'])->name('productPhoto');
    Route::delete('/product/deletePhoto/{photo}', [ProductController::class, 'removePhoto']);

    // Route Transaksi
    Route::get('/checkout/{cart}', [OrderController::class, 'updateCart']);
    Route::get('/transaction/success', function () {
        return view('transaction.success');
    });
    Route::resource('/order', OrderController::class);
    // Route Transaksi User
    Route::get('/mytransaction/not-yet-paid', [MyTransactionController::class, 'belumBayar']);
    Route::get('/mytransaction/proses', [MyTransactionController::class, 'proses']);
    Route::get('/mytransaction/cekResi/{resi}', [MyTransactionController::class, 'cekResi']);
    Route::get('/mytransaction/pay/{order}', [MyTransactionController::class, 'bayar']);
    Route::get('/transaction/pay/{order}', [MyTransactionController::class, 'updateBayar']);

    // Route Market-Dashboard
    Route::get('/mydashboard-konfirmasi', [MarketDashboardController::class, 'konfirmasi']);
    Route::post('/mydashboard-konfirmasi/{order}/{status}', [MarketDashboardController::class, 'acc']);
    Route::get('/mydashboard-kirm', [MarketDashboardController::class, 'pengiriman']);
    Route::post('/mydashboard-kirm/{order}', [MarketDashboardController::class, 'kirim']);

    Route::middleware('admin')->group(function () {
        // Route Admin
        Route::get('/admin-dashboard', [AdminController::class, 'index']);
        // CRUD CATEGORY
        Route::get('/admin-dashboard/add-category',[CategoryController::class,'add']);
        Route::post('/admin-dashboard/store-category',[CategoryController::class,'store']);
        Route::delete('/admin-dashboard/delete-category/{category}',[CategoryController::class,'destroy']);
        Route::get('/admin-dashboard/edit-category/{category}',[CategoryController::class,'edit']);
        Route::put('/admin-dashboard/edit-category/{category}',[CategoryController::class,'update']);
    });

});

//Route ubah foto profile
Route::post('/changeProfile', [MarketController::class, 'editAccountPhoto'])->name('profile');

//Route CRUD product
Route::resource('/product', ProductController::class);

Route::get('/all-products/search', function () {
    return view('product.all_product');
});

Route::get('/category-show/{category:slug}', [CategoryController::class, 'show']);
Route::get('/category-show/', [CategoryController::class, 'sortir']);

// Route Cari Barang
Route::get('/search/product', [HomeController::class, 'search']);

// Route Payment
Route::get('/pay', [PaymentController::class, 'index']);


Route::get('/test', function () {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.binderbyte.com/v1/track?api_key=bc95c7dde613326ce6032d86ccf328e8be2716997c1b21ee2651c7b27df2c45d&courier=jne&awb=8825112045716759",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $response = json_decode($response);
        $response = collect($response);
        dd($response);
    }
});

Route::get('/test2',function(){
    return view('myprofile.transaction.cek-resi');
    
});






// Route AJAX
Route::post('/getKota', function (Request $request) {
    $kota = City::where('province_id', $request->province_id)->get();
    echo '<option selected disabled>' . '--- Pilih Kota/Kabupaten ---' . '</option>';
    foreach ($kota as $k) {
        echo '<option value="' . $k->city_id . '">' . $k->name . '</option>';
    }
});

Route::post('/check-ongkir', function (Request $request) {
    $cost = RajaOngkir::ongkosKirim([
        'origin'        => $request->city_origin, // ID kota/kabupaten asal
        'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
        'weight'        => $request->weight, // berat barang dalam gram
        'courier'       => 'jne' // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
    ])->get();
    // dd(response()->json($cost));
    return response()->json($cost);
});
