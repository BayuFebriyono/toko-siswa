<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyTransactionController extends Controller
{
    public function belumBayar()
    {
        $user = auth()->user();
        $order = Order::where('user_id', $user->id)->where('status', 'PENDING')->get();
        return view('myprofile.transaction.belum_bayar', [
            'orders' => $order
        ]);
    }

    public function proses()
    {
        $user = auth()->user();
        $order = Order::where('user_id', $user->id)->whereNotIn('status', ['PENDING', 'SUCCESS'])->get();
        return view('myprofile.transaction.proses', [
            'orders' => $order
        ]);
    }

    public function bayar(Order $order)
    {
        if ($order->user_id != auth()->user()->id) {
            abort(404);
        }
        return view('myprofile.transaction.bayar', [
            'order' => $order
        ]);
    }

    public function updateBayar(Request $request, Order $order)
    {
        Order::where('id', $order->id)->update([
            'status' => 'PAYED'
        ]);

        return redirect('/mytransaction/not-yet-paid')->with('success', 'Tunggu Penjual Mengkonfirmasi Pesananmu');
    }
}
