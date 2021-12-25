<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Province;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->kurir_name);
        $data = [
            'user_id' => auth()->user()->id,
            'market_id' => $request->market_id,
            'nama_penerima' => $request->nama_penerima,
            'nomor_hp' => $request->nomor_hp,
            'alamat' => $request->alamat,
            'kurir_name' => $request->kurir_name,
            'total' => ($request->total + mt_rand(000, 999)),
            'qty' => $request->qty,
            'kode' => 'TRAN-' . mt_rand(00000000, 99999999)
        ];

        $order = Order::create($data);

        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $request->product_id,
            'qty'   => $request->qty
        ]);

        Cart::where('id', $request->cart_id)->delete();
        return redirect('/transaction/success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function updateCart(Cart $cart)
    {
        return view('transaction.checkout', [
            'cart' => $cart,
            'provinsi' => Province::all(),
            'kota' => City::all()
        ]);
    }
}
