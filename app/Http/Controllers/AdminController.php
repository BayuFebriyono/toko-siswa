<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use App\Models\Identitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function identitas()
    {
        $identitas =  Identitas::first();

        return view('admin.identitas.index', [
            'identitas' => $identitas
        ]);
    }

    public function ubahIdentitas(Request $request)
    {
        $identitas = Identitas::first();

        $identitas->judul = $request->judul;

        if ($request->file('foto')) {
            $url_foto = Storage::disk('public_uploads')->put('identitas',  $request->file('foto'));
            $identitas->foto = $url_foto;
        }
        $identitas->save();

        return back()->with('success', 'Data berhasil diubah');
    }
}
