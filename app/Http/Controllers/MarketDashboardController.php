<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class MarketDashboardController extends Controller
{
    public function konfirmasi()
    {

        $user = auth()->user();


        $orders = Order::with('user', 'market', 'orderDetail')->where('market_id', $user->market->id)->where('status', 'RECEIVED')->get();
        return view('market-dashboard.konfirmasi', [
            'orders' => $orders
        ]);
    }

    public function pengiriman()
    {

        $user = auth()->user();


        $orders = Order::with('user', 'market', 'orderDetail')->where('market_id', $user->market->id)->where('status', 'CONFIRMED')->get();
        return view('market-dashboard.kirim', [
            'orders' => $orders
        ]);
    }

    public function acc(Order $order, $status)
    {
        $order->update([
            'status' => $status
        ]);
        $message = '';
        if ($status == 'CONFIRMED') {
            $message = 'di konfirmasi';
        } else {
            $message = 'di batalkan';
        }

        return redirect()->back()->with('success', 'pesanan berhasil ' . $message);
    }
    public function kirim(Request $request, Order $order)
    {
        $order->update([
            'no_resi' => $request->no_resi,
            'status' => 'SENDING'
        ]);
        return redirect()->back()->with('success', 'Status Diubah Menjadi Dikirim');
    }
}
