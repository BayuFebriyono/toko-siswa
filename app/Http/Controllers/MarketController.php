<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Market;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarketController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:markets|min:4',
            'no_rekening' => 'required|unique:markets|min:8',
            'bank' => 'required'
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['slug'] = Str::slug($request->name, '-');
        $validatedData['city_id'] = $request->city_id;
        Market::create($validatedData);


        return redirect('/myaccount');
    }

    public function update(Market $market, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:markets|min:4'
        ]);
        $validatedData['slug'] = Str::slug($request->name, '-');
        Market::where('id', $market->id)->update($validatedData);


        return redirect('/myaccount/market');
    }

    //detail Market
    public function show(Market $market)
    {
        $produk = Product::where('market_id', $market->id)->latest()->get();
        return view('market.show', [
            'market' => $market,
            'products' => $produk
        ]);
    }

    public function editImage(Request $request)
    {
        $validatedData = $request->validate([
            'url_photo' => 'mimes:png,jpg,jpeg|max:10240'
        ]);



        $validatedData['url_photo'] = Storage::disk('public_uploads')->put('profile-image', $request->file('url_photo'));
        if (auth()->user()->market->url_photo) {
            $file_path = 'uploads/' . auth()->user()->market->url_photo;
            unlink($file_path);
        }

        Market::where('id', auth()->user()->market->id)->update($validatedData);
        if ($validatedData) {
            return response()->json(['status' => 1, 'msg' => 'Gambar Berhasil DIperbarui', '']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }
    }

    //Titip untuk uplod pp Profile
    public function editAccountPhoto(Request $request)
    {
        $validatedData = $request->validate([
            'url_photo' => 'required|mimes:png,jpg,jpeg|max:10240'
        ]);

        $validatedData['url_photo'] = Storage::disk('public_uploads')->put('profile-image', $request->file('url_photo'));
        if (auth()->user()->url_photo) {
            $file_path = 'uploads/' . auth()->user()->url_photo;
            unlink($file_path);
        }

        User::where('id', auth()->user()->id)->update($validatedData);
        if ($validatedData) {
            return response()->json(['status' => 1, 'msg' => 'Gambar Berhasil DIperbarui', '']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }
    }

    //titip mymarket
    public function myMarket()
    {
        $market = auth()->user()->market;
        $produk = Product::where('market_id', $market->id)->latest()->get();
        return view('myprofile.market', [
            'market' => $market,
            'products' => $produk,
            'categories' => Category::all()->sortBy('name')
        ]);
    }
}
