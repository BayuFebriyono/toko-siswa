<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CartController extends Controller
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
        $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $request->id_product)->first();
        if ($cart) {
            $current = $cart->qty;
            $data = [
                'product_id' => $request->id_product,
                'user_id'   => auth()->user()->id,
                'qty'       => $request->jumlah + $current,
                'total'     => $request->jumlah * $request->price
            ];
            Cart::where('id', $cart->id)->update($data);
        } else {
            $data = [
                'product_id' => $request->id_product,
                'user_id'   => auth()->user()->id,
                'qty'       => $request->jumlah,
                'total'     => $request->jumlah * $request->price
            ];

            Cart::create($data);
        }
        return redirect()->back()->with('success', 'Ditambahkan ke cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $price = $cart->product->price;
        $qty = $request->qty;
        $total = $qty * $price;

        $data = [
            'qty' => $qty,
            'total' => $total
        ];

        Cart::where('id', $cart->id)->update($data);
        return redirect('/checkout/'.$cart->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        Cart::where('id', $cart->id)->delete();
        return redirect()->back()->with('success', 'Berhasil dihapus');
    }

    public function mycart(User $user)
    {
        $cart = Cart::where('user_id', $user->id)->get();
        $cart->load('user', 'product');
        if (auth()->guest() || auth()->user()->username != $user->username) {
            abort(403);
        }

        return view('cart.index', [
            'carts' => $cart
        ]);
    }
}
