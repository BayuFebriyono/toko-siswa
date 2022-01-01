<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'categories' => Category::all()
        ]);
    }

    public function pembayaran()
    {
        $orders = Order::with('user', 'market', 'orderDetail')->where('status', 'PAYED')->get();
        return view('admin.pembayaran.index', [
            'orders' => $orders
        ]);
    }

    public function success()
    {
        $orders = Order::with('user', 'market', 'orderDetail')->where('status', 'SUCCESS')->get();
        return view('admin.transaksi-sukses.index', [
            'orders' => $orders
        ]);
    }

    public function acc(Order $order, $status)
    {
        $order->update([
            'status' => $status
        ]);
        $message = '';
        if ($status == 'RECEIVED') {
            $message = 'di konfirmasi';
        } else {
            $message = 'di batalkan';
        }

        return redirect()->back()->with('success', 'pesanan berhasil ' . $message);
    }
}
