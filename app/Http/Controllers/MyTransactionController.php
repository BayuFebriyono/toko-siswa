<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
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

    // Cek Resi

    public function cekResi($resi){
        $api_key = env('BINDERBYTE_API_KEY');
        $curl = curl_init();
        $url = 'https://api.binderbyte.com/v1/track?api_key='.$api_key.'&courier=jne&awb='. $resi;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $data=null;
        $summary = null;
        $detail = null;
        $history = null;
    
        curl_close($curl);
    
        if ($err) {
           return redirect()->back()->with('error','Maaf Terjadi Kesa;ahan');
        } else {
            $response = json_decode($response);
            $response = collect($response);
            $data = $response['data'];
            $summary = $data->summary;
            $detail = $data->detail;
            $history = $data->history;
        }
       return view('myprofile.transaction.cek-resi',[
           'summary' => $summary,
           'detail' => $detail,
           'history' => $history
       ]);
    }
}
